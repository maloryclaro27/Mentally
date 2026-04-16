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
            'ollama' => $this->callOllama($payload),
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
}
