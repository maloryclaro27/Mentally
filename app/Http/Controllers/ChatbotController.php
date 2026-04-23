<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Services\Chatbot\EmotionalChatbotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chatbot.index', compact('messages'));
    }

    public function send(Request $request, EmotionalChatbotService $chatbot)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $user = Auth::user();
        $message = trim($request->message);

        $detectedEmotion = $this->detectEmotion($message);
        $detectedTopic = $this->detectTopic($message);

        $previousMessages = ChatMessage::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->reverse()
            ->map(function ($msg) {
                return [
                    'role' => $msg->sender === 'user' ? 'user' : 'assistant',
                    'content' => $msg->message,
                ];
            })
            ->values()
            ->all();

        ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'user',
            'message' => $message,
            'emotion' => $detectedEmotion,
        ]);

        try {
            if ($this->isShortNegativeReply($message)) {
                $reply = $this->softNoReply();
                $botEmotion = $detectedEmotion;
            } else {
                $result = $chatbot->respond([
                    'message' => $message,
                    'emotion' => $detectedEmotion,
                    'topic' => $detectedTopic,
                    'previous_messages' => $previousMessages,
                ]);

                \Log::info('Chatbot result', ['result' => $result]);

                $reply = filled($result['reply'] ?? null)
                    ? $result['reply']
                    : $this->fallbackReply($detectedEmotion, $detectedTopic);

                $reply = $this->sanitizeReply($reply, $detectedEmotion, $detectedTopic);

                $lastBotMessage = collect($previousMessages)
                    ->reverse()
                    ->first(fn($msg) => ($msg['role'] ?? null) === 'assistant');

                if ($lastBotMessage && $this->isTooSimilar($reply, $lastBotMessage['content'] ?? '')) {
                    $reply = $this->fallbackReply($detectedEmotion, $detectedTopic);
                }

                $botEmotion = $detectedEmotion;
            }
        } catch (\Throwable $e) {
            \Log::error('Chatbot controller error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $reply = 'Lo siento, el asistente no está disponible en este momento.';
            $botEmotion = 'error';
        }

        ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'bot',
            'message' => $reply,
            'emotion' => $botEmotion,
        ]);

        return response()->json([
            'reply' => $reply,
            'emotion' => $botEmotion,
        ]);
    }

    protected function detectEmotion(string $text): ?string
    {
        $text = mb_strtolower($text);

        $map = [
            'ansiedad' => ['ansioso', 'ansiosa', 'ansiedad', 'nervioso', 'nerviosa', 'preocupado', 'preocupada'],
            'depresion' => ['triste', 'vacío', 'vacio', 'deprimido', 'deprimida', 'sin sentido', 'solo', 'sola'],
            'estres' => ['estres', 'estrés', 'agotado', 'agotada', 'abrumado', 'abrumada', 'presión', 'presion'],
            'feliz' => ['feliz', 'contento', 'contenta', 'alegre', 'buena noticia', 'emocionado', 'emocionada'],
        ];

        foreach ($map as $emotion => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($text, $keyword)) {
                    return $emotion;
                }
            }
        }

        return 'neutral';
    }

    protected function detectTopic(string $text): string
    {
        $text = mb_strtolower($text);

        $topics = [
            'universidad' => ['universidad', 'materia', 'nota', 'examen', 'parcial', 'semestre', 'clase'],
            'soledad' => ['solo', 'sola', 'soledad', 'incomprendida', 'incomprendido', 'vacío', 'vacio'],
            'familia' => ['mamá', 'mama', 'papá', 'papa', 'familia', 'casa', 'padres'],
            'relaciones' => ['novio', 'novia', 'pareja', 'amor', 'relación', 'relacion'],
            'salud' => ['medicamento', 'medicación', 'medicacion', 'dormir', 'insomnio', 'salud'],
            'general' => [],
        ];

        foreach ($topics as $topic => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($text, $keyword)) {
                    return $topic;
                }
            }
        }

        return 'general';
    }

    protected function isShortNegativeReply(string $text): bool
    {
        $text = trim(mb_strtolower($text));

        $variants = [
            'no',
            'nop',
            'nope',
            'nah',
            'prefiero no',
            'no quiero',
            'no deseo',
            'mejor no',
        ];

        return in_array($text, $variants, true);
    }

    protected function softNoReply(): string
    {
        $options = [
            'Está bien, no tienes que hablar de eso ahora.',
            'No pasa nada, podemos dejarlo hasta ahí por el momento.',
            'Está bien, no hace falta que lo expliques más.',
            'No hay problema, podemos cambiar de tema si te hace sentir más cómodo.',
            'Está bien, a veces no es fácil ponerlo en palabras.',
        ];

        return $options[array_rand($options)];
    }



    protected function sanitizeReply(string $reply, ?string $emotion, string $topic): string
    {
        $reply = trim($reply);

        $brokenPatterns = [
            '¿Qué te hay acerca de',
            '¿Qué te hay',
            '¿qué te hay',
            'te hay acerca de',
        ];

        foreach ($brokenPatterns as $pattern) {
            if (str_contains(mb_strtolower($reply), mb_strtolower($pattern))) {
                return $this->fallbackReply($emotion, $topic);
            }
        }

        if (mb_strlen($reply) < 12) {
            return $this->fallbackReply($emotion, $topic);
        }

        return $reply;
    }

    protected function fallbackReply(?string $emotion, string $topic): string
    {
        $responses = [
            'ansiedad' => [
                'universidad' => 'Eso suena bastante pesado. ¿Sientes que lo que más te está afectando es la presión académica o el miedo a no poder recuperarte?',
                'general' => 'Eso puede sentirse muy abrumador. ¿Qué es lo que más te está pesando en este momento?',
            ],
            'depresion' => [
                'soledad' => 'Sentirse solo puede pesar muchísimo. ¿Es algo que has venido sintiendo desde hace tiempo o se te ha hecho más fuerte últimamente?',
                'general' => 'Eso se siente bastante pesado. ¿Lo que más notas es tristeza, vacío o ganas de aislarte?',
            ],
            'estres' => [
                'general' => 'Parece que has estado cargando muchas cosas al mismo tiempo. ¿Qué es lo que más te está agotando ahora?',
            ],
            'feliz' => [
                'general' => 'Me alegra leer eso. ¿Qué pasó hoy que te hizo sentir así?',
            ],
            'neutral' => [
                'general' => 'Te leo. ¿Qué ha sido lo que más te ha marcado hoy?',
            ],
        ];

        return $responses[$emotion][$topic]
            ?? $responses[$emotion]['general']
            ?? 'Te leo. ¿Qué es lo que más te gustaría expresar ahora?';
    }

    protected function isTooSimilar(string $a, string $b): bool
    {
        $a = trim(mb_strtolower($a));
        $b = trim(mb_strtolower($b));

        if ($a === '' || $b === '') {
            return false;
        }

        similar_text($a, $b, $percent);

        return $percent >= 85;
    }
}
