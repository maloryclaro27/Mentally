<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $user = Auth::user();

        ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'user',
            'message' => $request->message,
            'emotion' => null,
        ]);

        $response = Http::post('http://chatbot:5000/get_response', [
            'message' => $request->message,
        ]);

        if (!$response->successful()) {
            ChatMessage::create([
                'user_id' => $user->id,
                'sender' => 'bot',
                'message' => 'Lo siento, el asistente no está disponible en este momento.',
                'emotion' => 'error',
            ]);

            return response()->json([
                'reply' => 'Lo siento, el asistente no está disponible en este momento.',
                'emotion' => 'error',
            ], 500);
        }

        $data = $response->json();

        ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'bot',
            'message' => $data['reply'] ?? 'Sin respuesta',
            'emotion' => $data['emotion'] ?? null,
        ]);

        return response()->json([
            'reply' => $data['reply'] ?? 'Sin respuesta',
            'emotion' => $data['emotion'] ?? null,
        ]);
    }
}