<?php

namespace App\Services\Chatbot;

class EmotionalChatbotService
{
    public function __construct(
        protected EmotionalResponseBuilder $builder,
        protected ChatProviderManager $providerManager
    ) {
    }

    public function respond(array $context): array
    {
        $payload = $this->builder->build($context);

        $result = $this->providerManager->generate($payload);

        return [
            'reply' => $result['text'] ?? '',
            'provider' => $result['provider'] ?? null,
            'payload' => $payload,
            'raw' => $result['raw'] ?? [],
        ];
    }
}