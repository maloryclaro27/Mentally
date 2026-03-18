from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route("/health", methods=["GET"])
def health():
    return jsonify({"status": "ok", "service": "chatbot"})

@app.route("/get_response", methods=["POST"])
def get_response():
    data = request.get_json(silent=True) or {}
    message = data.get("message", "")

    return jsonify({
        "reply": f"Mensaje recibido: {message}",
        "emotion": "neutral"
    })

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)