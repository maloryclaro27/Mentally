<?php

namespace App\Services\Chatbot;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ChatProviderManager
{
    public function generate(array $payload): array
    {
        $primary = config('chatbot.provider');
        $fallback = config('chatbot.fallback_provider');

        try {
            return $this->callProvider($primary, $payload);
        } catch (Throwable $e) {
            \Log::warning('Proveedor principal del chatbot falló, intentando fallback.', [
                'primary' => $primary,
                'fallback' => $fallback,
                'error' => $e->getMessage(),
            ]);

            if (request()->query('debug_openai') == 1) {
                throw $e;
            }

            return $this->callProvider($fallback, $payload);
        }
    }

    protected function callProvider(string $provider, array $payload): array
    {
        return match ($provider) {
            'openai' => $this->callOpenAI($payload),
            'gemini' => $this->callGemini($payload),
            'ollama' => $this->callOllama($payload),
            'local_api' => $this->callLocalApi($payload),
            default => throw new \InvalidArgumentException("Proveedor no soportado: {$provider}"),
        };
    }

    protected function callOpenAI(array $payload): array
    {
        $response = Http::withToken(config('chatbot.openai.api_key'))
            ->timeout(45)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('chatbot.openai.model'),
                'messages' => $payload['messages'] ?? [],
                'temperature' => $payload['temperature'] ?? 0.7,
                'max_tokens' => $payload['max_tokens'] ?? 250,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Error OpenAI: ' . $response->body());
        }

        $data = $response->json();

        return [
            'provider' => 'openai',
            'text' => data_get($data, 'choices.0.message.content', ''),
            'raw' => $data,
        ];
    }

    protected function callGemini(array $payload): array
    {
        $apiKey = config('chatbot.gemini.api_key');
        $model = config('chatbot.gemini.model');
        $baseUrl = rtrim(config('chatbot.gemini.base_url'), '/');

        if (empty($apiKey)) {
            throw new \RuntimeException('Gemini API key no configurada.');
        }

        $messages = $payload['messages'] ?? [];

        $systemInstruction = collect($messages)
            ->where('role', 'system')
            ->pluck('content')
            ->filter()
            ->implode("\n\n");

        $contents = collect($messages)
            ->filter(fn($message) => in_array($message['role'] ?? '', ['user', 'assistant']))
            ->map(function ($message) {
                $role = ($message['role'] ?? '') === 'assistant' ? 'model' : 'user';

                return [
                    'role' => $role,
                    'parts' => [
                        [
                            'text' => $message['content'] ?? '',
                        ],
                    ],
                ];
            })
            ->values()
            ->all();

        if (empty($contents)) {
            throw new \RuntimeException('No hay mensajes válidos para enviar a Gemini.');
        }

        $requestBody = [
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => $payload['temperature'] ?? 0.7,
                'maxOutputTokens' => max((int) ($payload['max_tokens'] ?? 300), 800),
            ],
        ];

        if (! empty($systemInstruction)) {
            $requestBody['systemInstruction'] = [
                'parts' => [
                    [
                        'text' => $systemInstruction,
                    ],
                ],
            ];
        }

        $response = Http::withHeaders([
            'x-goog-api-key' => $apiKey,
        ])
            ->timeout(45)
            ->post($baseUrl . '/models/' . $model . ':generateContent', $requestBody);

        if (! $response->successful()) {
            throw new \RuntimeException('Error Gemini: ' . $response->body());
        }

        $data = $response->json();
        $text = data_get($data, 'candidates.0.content.parts.0.text', '');

        return [
            'provider' => 'gemini',
            'text' => $text,
            'raw' => $data,
        ];
    }

    protected function callOllama(array $payload): array
    {
        $baseUrl = rtrim(config('chatbot.ollama.base_url'), '/');

        $response = Http::withToken(config('chatbot.ollama.api_key'))
            ->timeout(60)
            ->post($baseUrl . '/chat/completions', [
                'model' => config('chatbot.ollama.model'),
                'messages' => $payload['messages'] ?? [],
                'temperature' => $payload['temperature'] ?? 0.7,
                'max_tokens' => $payload['max_tokens'] ?? 250,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Error Ollama: ' . $response->body());
        }

        $data = $response->json();

        return [
            'provider' => 'ollama',
            'text' => data_get($data, 'choices.0.message.content', ''),
            'raw' => $data,
        ];
    }

    protected function callLocalApi(array $payload): array
    {
        $baseUrl = rtrim(config('chatbot.local_api.base_url'), '/');
        $messages = $payload['messages'] ?? [];

        $lastUserMessage = collect($messages)
            ->reverse()
            ->firstWhere('role', 'user');

        $messageText = $lastUserMessage['content'] ?? '';

        $response = Http::timeout(60)->post($baseUrl . '/get_response', [
            'message' => $messageText,
        ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Error Local API: ' . $response->body());
        }

        $data = $response->json();

        return [
            'provider' => 'local_api',
            'text' => data_get($data, 'reply', ''),
            'raw' => $data,
        ];
    }
}
