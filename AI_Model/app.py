from flask import Flask, request, jsonify
from flask_cors import CORS
import tensorflow as tf
import numpy as np
import cv2

app = Flask(__name__)
CORS(app)  # <-- dipindahkan ke sini

# load model
model = tf.keras.models.load_model("model/model_height.keras", compile=False)

@app.route("/predict", methods=["POST"])
def predict():
    if "file" not in request.files:
        return jsonify({"error": "No file"}), 400

    file = request.files["file"]

    # bytes → image
    img_bytes = np.frombuffer(file.read(), np.uint8)
    img = cv2.imdecode(img_bytes, cv2.IMREAD_COLOR)

    # preprocessing
    img = cv2.resize(img, (224, 224))
    img = img / 255.0
    img = np.expand_dims(img, 0)

    # prediction
    tinggi_pred = model.predict(img)[0][0]

    return jsonify({
        "tinggi": round(float(tinggi_pred), 1)
    })

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
