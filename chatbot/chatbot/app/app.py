from flask import Flask, request, jsonify
from chat_service import get_bot_response

app = Flask(__name__)

@app.route("/health", methods=["GET"])
def health():
    return jsonify({"status": "ok", "service": "chatbot"})

@app.route("/get_response", methods=["POST"])
def get_response():
    data = request.get_json(silent=True) or {}
    message = data.get("message", "")

    result = get_bot_response(message)

    return jsonify({
        "reply": result.get("reply", "Sin respuesta"),
        "emotion": result.get("emotion", "neutral")
    })

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)