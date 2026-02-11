import json
import sys
from transformers import pipeline

MODEL_NAME = "ignacio-ave/beto-sentiment-analysis-spanish"

# Cargamos pipeline (BETO)
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

def predict(text: str):
    out = clf(text)

    # Normalizamos a: scores = list[{"label":..., "score":...}]
    # out puede ser:
    # 1) [[{...}, {...}, {...}]]
    # 2) [{...}, {...}, {...}]
    # 3) [{"label": "...", "score": ...}] (sin all_scores)
    if isinstance(out, list) and len(out) > 0 and isinstance(out[0], list):
        scores = out[0]
    elif isinstance(out, list):
        scores = out
    else:
        # caso extremo: dict
        scores = [out]

    # Asegurar que scores sea lista de dicts
    if not (isinstance(scores, list) and len(scores) > 0 and isinstance(scores[0], dict)):
        raise ValueError(f"Unexpected pipeline output format: {type(out)} -> {out}")

    best = max(scores, key=lambda x: x.get("score", 0.0))
    best_label = LABEL_MAP.get(best.get("label"), best.get("label"))

    meta_scores = [
        {"label": LABEL_MAP.get(s.get("label"), s.get("label")), "score": float(s.get("score", 0.0))}
        for s in scores
    ]

    return {
        "label": best_label,
        "score": float(best.get("score", 0.0)),
        "meta": {
            "model": MODEL_NAME,
            "scores": meta_scores
        }
    }


if __name__ == "__main__":
    text = " ".join(sys.argv[1:]).strip()
    if not text:
        print(json.dumps({"ok": False, "error": "No text provided"}, ensure_ascii=False))
        sys.exit(1)

    out = predict(text)
    print(json.dumps({"ok": True, **out}, ensure_ascii=False))
