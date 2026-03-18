from pathlib import Path
from typing import Optional

import torch
from transformers import AutoModelForSequenceClassification, AutoTokenizer

MODEL_DIR = Path("/app/model")
_tokenizer: Optional[AutoTokenizer] = None
_model: Optional[AutoModelForSequenceClassification] = None


def load_model():
    global _tokenizer, _model

    if _tokenizer is not None and _model is not None:
        return _tokenizer, _model

    if not MODEL_DIR.exists():
        return None, None

    try:
        _tokenizer = AutoTokenizer.from_pretrained(MODEL_DIR)
        _model = AutoModelForSequenceClassification.from_pretrained(MODEL_DIR)
        _model.eval()
        return _tokenizer, _model
    except Exception as e:
        print(f"[chat_service] Error cargando modelo: {e}")
        _tokenizer = None
        _model = None
        return None, None


def predict_emotion(message: str) -> str:
    tokenizer, model = load_model()

    if tokenizer is None or model is None:
        return "neutral"

    try:
        inputs = tokenizer(
            message,
            return_tensors="pt",
            truncation=True,
            padding=True,
            max_length=128
        )

        with torch.no_grad():
            outputs = model(**inputs)
            predicted_class = torch.argmax(outputs.logits, dim=1).item()

        # Mapeo temporal. Luego lo ajustamos al modelo real.
        label_map = {
            0: "felicidad",
            1: "neutral",
            2: "depresion",
            3: "ansiedad",
            4: "estres",
            5: "emergencia",
            6: "confusion",
            7: "ira",
            8: "miedo",
            9: "sorpresa",
            10: "disgusto",
        }

        return label_map.get(predicted_class, "neutral")

    except Exception as e:
        print(f"[chat_service] Error en inferencia: {e}")
        return "neutral"


def build_reply(message: str, emotion: str) -> str:
    base = (message or "").strip()

    if not base:
        return "No recibí ningún mensaje. ¿Quieres contarme cómo te sientes?"

    replies = {
        "ansiedad": "Gracias por contármelo. Parece que podrías estar sintiendo ansiedad. ¿Quieres decirme qué ha estado pasando hoy?",
        "depresion": "Lamento que estés pasando por esto. Estoy aquí para escucharte. ¿Quieres contarme un poco más sobre cómo te has sentido?",
        "estres": "Entiendo. Suena a que has tenido mucha carga últimamente. ¿Qué es lo que más te está pesando en este momento?",
        "felicidad": "Me alegra leer eso. ¿Qué ha contribuido a que te sientas así hoy?",
        "miedo": "Gracias por compartirlo. El miedo puede sentirse muy intenso. ¿Hay algo específico que lo haya desencadenado?",
        "ira": "Entiendo. Parece que hay una emoción fuerte detrás de lo que dices. ¿Quieres contarme qué ocurrió?",
        "confusion": "Gracias por expresarlo. A veces ponerlo en palabras ayuda a aclarar las cosas. ¿Qué es lo que más te está confundiendo?",
        "sorpresa": "Entiendo. Parece que algo inesperado pasó. ¿Quieres contarme un poco más?",
        "disgusto": "Gracias por decírmelo. Parece que algo te generó mucho malestar. ¿Qué fue lo que pasó?",
        "emergencia": "Lo que cuentas puede ser serio. Busca apoyo inmediato de una persona de confianza o de un servicio de emergencia de tu país.",
        "neutral": f"Gracias por compartirlo conmigo. Dijiste: {base}. ¿Quieres contarme un poco más?",
    }

    return replies.get(emotion, replies["neutral"])


def get_bot_response(message: str) -> dict:
    message = (message or "").strip()

    if not message:
        return {
            "reply": "No recibí ningún mensaje. ¿Quieres contarme cómo te sientes?",
            "emotion": "neutral"
        }

    emotion = predict_emotion(message)
    reply = build_reply(message, emotion)

    return {
        "reply": reply,
        "emotion": emotion
    }