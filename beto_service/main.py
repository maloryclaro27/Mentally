from fastapi import FastAPI
from pydantic import BaseModel
from transformers import pipeline

MODEL_NAME = "ignacio-ave/beto-sentiment-analysis-spanish"

app = FastAPI(title="BETO Sentiment Service")

# Cargar modelo una sola vez al iniciar el contenedor
clf = pipeline(
    "text-classification",
    model=MODEL_NAME,
    tokenizer=MODEL_NAME,
    return_all_scores=True
)

LABEL_MAP = {
    "LABEL_0": "negative",
    "LABEL_1": "neutral",
    "LABEL_2": "positive",
    "NEG": "negative",
    "NEU": "neutral",
    "POS": "positive",
    "negative": "negative",
    "neutral": "neutral",
    "positive": "positive",
}

class PredictIn(BaseModel):
    text: str

@app.get("/health")
def health():
    return {"ok": True}

@app.post("/predict")
def predict(inp: PredictIn):
    out = clf(inp.text)

    # Normalizar formato de salida
    if isinstance(out, list) and len(out) > 0 and isinstance(out[0], list):
        scores = out[0]
    elif isinstance(out, list):
        scores = out
    else:
        scores = [out]

    best = max(scores, key=lambda x: x.get("score", 0.0))
    best_label = LABEL_MAP.get(best.get("label"), best.get("label"))

    meta_scores = [
        {"label": LABEL_MAP.get(s.get("label"), s.get("label")), "score": float(s.get("score", 0.0))}
        for s in scores
    ]

    return {
        "ok": True,
        "label": best_label,
        "score": float(best.get("score", 0.0)),
        "meta": {
            "model": MODEL_NAME,
            "scores": meta_scores
        }
    }
