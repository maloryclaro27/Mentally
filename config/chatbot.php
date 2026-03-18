<?php

return [

    'provider' => env('CHAT_PROVIDER', 'openai'),
    'fallback_provider' => env('CHAT_FALLBACK_PROVIDER', 'ollama'),

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'model' => env('OPENAI_MODEL', 'gpt-5-mini'),
    ],

    'ollama' => [
        'base_url' => env('OLLAMA_BASE_URL', 'http://host.docker.internal:11434/v1'),
        'model' => env('OLLAMA_MODEL', 'qwen3:8b'),
        'api_key' => env('OLLAMA_API_KEY', 'ollama'),
    ],

];