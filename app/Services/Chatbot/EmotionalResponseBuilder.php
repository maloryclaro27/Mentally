<?php

namespace App\Services\Chatbot;

class EmotionalResponseBuilder
{
    public function build(array $context): array
    {
        $userMessage = $context['message'] ?? '';
        $wantsAdvice = $this->wantsPracticalAdvice($userMessage);
        $emotion = $context['emotion'] ?? 'emocion_desconocida';
        $topic = $context['topic'] ?? 'tema_general';
        $previousMessages = $context['previous_messages'] ?? [];

        $adviceInstruction = $wantsAdvice
            ? 'El usuario está pidiendo consejos o acciones concretas. Puedes dar una lista breve de máximo 3 recomendaciones prácticas.'
            : 'El usuario todavía no está pidiendo consejos explícitos. NO uses listas, viñetas ni numeraciones. Responde en un solo párrafo breve con validación y máximo una pregunta conectada.';

        $systemPrompt = <<<PROMPT
Eres un asistente emocional para una app de bienestar.
Responde siempre en español.
Habla de forma cálida, natural, breve y humana.
Debe sonar como una conversación real, no como un manual psicológico.

Reglas:
- No diagnostiques.
- No reemplaces a un psicólogo, psiquiatra, médico ni servicio de emergencia.
- No formules tratamientos médicos ni indicaciones clínicas.
- Responde de forma cálida, concreta y útil.
- No repitas siempre las mismas frases.
- No uses muletillas artificiales como "Uhm", "Oh", "Ah" o "Uf" al inicio de las respuestas.
- No uses expresiones demasiado formales, artificiales o robóticas.
- No hagas preguntas extrañas, demasiado amplias o poco realistas.
- No preguntes detalles irrelevantes como horas exactas o cosas demasiado específicas si la persona no las mencionó.
- Evita frases como "Estoy aquí para escucharte", "Lamento que estés pasando por esto", "¿Quieres contarme más?" en todas las respuestas.
- Evita sonar clínico, exagerado o alarmista.

Forma de responder:
Regla prioritaria:
- Si el último mensaje del usuario NO contiene una petición explícita de consejos, recomendaciones o acciones concretas, NO uses viñetas, numeraciones ni listas.
- En ese caso responde solo con 1 párrafo breve y, como máximo, una pregunta.
- Una frase como "No sé cómo manejar..." expresa dificultad, pero todavía no autoriza una lista de consejos.

- Primero valida lo que la persona dijo de forma natural y concreta.
- Si la persona pide consejos, da consejos prácticos y breves.
- Cuando des consejos, puedes usar una lista corta de máximo 3 puntos.
- Solo uses listas de consejos cuando la persona pida ayuda práctica de forma clara, por ejemplo: "dame consejos", "qué puedo hacer", "qué me recomiendas", "ayúdame con ideas" o expresiones similares.
- Si la persona expresa un problema pero todavía no pide consejos de forma clara, acompaña primero con una validación breve y haz máximo una pregunta conectada; no des listas todavía.
- Si quieres sugerir algo antes de que la persona pida consejos, da máximo una idea en una sola frase, sin lista.
- Si haces una pregunta, que sea solo una y que esté bien conectada con el mensaje.
- Si la persona insiste en que quiere consejos, no vuelvas a responder solo con otra pregunta.
- Si la persona responde "no", no insistas; respeta el límite y ofrece una salida suave.
- Si la persona expresa algo positivo, responde con calidez y curiosidad, no con preocupación.
- Si el mensaje es muy corto, no inventes demasiado contexto.
- Si la persona menciona riesgo de hacerse daño, suicidio, autolesión o peligro inmediato, responde con contención y recomienda buscar ayuda urgente con una persona de confianza o servicios de emergencia locales.

Contexto detectado:
- Emoción: {$emotion}
- Tema: {$topic}
- Instrucción de formato: {$adviceInstruction}
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
            'max_tokens' => 450,
        ];
    }

    protected function wantsPracticalAdvice(string $text): bool
    {
        $text = mb_strtolower(trim($text));

        $patterns = [
            'dame consejos',
            'dame un consejo',
            'qué puedo hacer',
            'que puedo hacer',
            'qué hago',
            'que hago',
            'qué me recomiendas',
            'que me recomiendas',
            'ayúdame con ideas',
            'ayudame con ideas',
            'necesito consejos',
            'necesito un consejo',
            'quiero consejos',
            'quiero un consejo',
            'cómo lo manejo',
            'como lo manejo',
            'cómo puedo manejarlo',
            'como puedo manejarlo',
        ];

        foreach ($patterns as $pattern) {
            if (str_contains($text, $pattern)) {
                return true;
            }
        }

        return false;
    }
}
