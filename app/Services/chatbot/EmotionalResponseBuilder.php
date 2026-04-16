<?php

namespace App\Services\Chatbot;

class EmotionalResponseBuilder
{
    public function build(array $context): array
    {
        $userMessage = $context['message'] ?? '';
        $emotion = $context['emotion'] ?? 'emocion_desconocida';
        $topic = $context['topic'] ?? 'tema_general';
        $previousMessages = $context['previous_messages'] ?? [];

        $systemPrompt = <<<PROMPT
Eres un asistente emocional para una app de bienestar.
Responde siempre en español.
Habla de forma cálida, natural, breve y humana.
Debe sonar como una conversación real, no como un manual psicológico.

Reglas:
- No diagnostiques.
- No uses listas.
- No repitas siempre las mismas frases.
- No uses expresiones demasiado formales o artificiales.
- No hagas preguntas extrañas, demasiado amplias o poco realistas.
- No preguntes detalles irrelevantes como horas exactas o cosas demasiado específicas si la persona no las mencionó.
- No des demasiados consejos de inmediato.
- Evita frases como "Estoy aquí para escucharte", "Lamento que estés pasando por esto", "¿Quieres contarme más?" en todas las respuestas.
- Evita sonar clínico, exagerado o robótico.

Forma de responder:
- Primero valida lo que la persona dijo de forma natural y concreta.
- Menciona el tema principal si aparece claramente.
- Después haz solo una pregunta breve y bien conectada con el mensaje.
- Si la persona responde "no", no insistas; respeta el límite y ofrece una salida suave.
- Si la persona expresa algo positivo, responde con calidez y curiosidad, no con preocupación.
- Si el mensaje es muy corto, no inventes demasiado contexto.

Contexto detectado:
- Emoción: {$emotion}
- Tema: {$topic}
PROMPT;

        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt,
            ],
        ];

        foreach ($previousMessages as $message) {
            if (! empty($message['role']) && ! empty($message['content'])) {
                $messages[] = [
                    'role' => $message['role'],
                    'content' => $message['content'],
                ];
            }
        }

        $messages[] = [
            'role' => 'user',
            'content' => $userMessage,
        ];

        return [
            'messages' => $messages,
            'temperature' => 0.8,
            'max_tokens' => 220,
        ];
    }
}
