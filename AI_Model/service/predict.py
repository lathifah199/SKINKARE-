import cv2
import numpy as np
import os
import mediapipe as mp

# Coba load model TensorFlow jika ada
try:
    import tensorflow as tf
    MODEL_PATH = "model/model_height.keras"
    
    if os.path.exists(MODEL_PATH):
        model = tf.keras.models.load_model(MODEL_PATH, compile=False)
        USE_ML_MODEL = True
        print("✅ Model TensorFlow loaded successfully")
    else:
        print(f"⚠️ Model tidak ditemukan di {MODEL_PATH}")
        print("💡 Menggunakan metode kalkulasi MediaPipe sebagai fallback")
        USE_ML_MODEL = False
except Exception as e:
    print(f"⚠️ TensorFlow Error: {e}")
    print("💡 Menggunakan metode kalkulasi MediaPipe sebagai fallback")
    USE_ML_MODEL = False

# Setup MediaPipe untuk fallback
mp_pose = mp.solutions.pose
pose = mp_pose.Pose(static_image_mode=True, min_detection_confidence=0.5)

def predict_height_with_model(image):
    """Prediksi menggunakan ML Model"""
    try:
        img = cv2.resize(image, (224, 224))
        img = img / 255.0
        img = np.expand_dims(img, axis=0)
        tinggi = model.predict(img, verbose=0)[0][0]
        return round(float(tinggi), 1)
    except Exception as e:
        print(f"❌ Model prediction error: {e}")
        return None

def predict_height_with_mediapipe(image):
    """Prediksi menggunakan MediaPipe (fallback)"""
    try:
        h, w = image.shape[:2]
        image_rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
        results = pose.process(image_rgb)
        
        if not results.pose_landmarks:
            print("❌ Pose tidak terdeteksi")
            return None
        
        lm = results.pose_landmarks.landmark
        
        # Hitung dari hidung ke ankle
        nose = lm[mp_pose.PoseLandmark.NOSE]
        left_ankle = lm[mp_pose.PoseLandmark.LEFT_ANKLE]
        right_ankle = lm[mp_pose.PoseLandmark.RIGHT_ANKLE]
        
        # Ambil rata-rata ankle
        ankle_y = (left_ankle.y + right_ankle.y) / 2
        
        # Hitung pixel height
        pixel_height = abs(ankle_y - nose.y) * h
        
        # Konversi ke cm
        # Asumsi: body ratio 0.75 (75% frame) = 150cm anak rata-rata
        # Atau gunakan formula: tinggi_cm = pixel_height * calibration_factor
        body_ratio = pixel_height / h
        
        if body_ratio < 0.5:
            tinggi_cm = 80  # Terlalu jauh
        elif body_ratio > 0.9:
            tinggi_cm = 85  # Terlalu dekat
        else:
            # Formula kalibrasi sederhana
            tinggi_cm = (body_ratio / 0.75) * 110  # Asumsi tinggi rata-rata 110cm
        
        return round(tinggi_cm, 1)
    
    except Exception as e:
        print(f"❌ MediaPipe prediction error: {e}")
        return None

def predict_height(image):
    """Main function untuk prediksi tinggi"""
    if image is None:
        return 0
    
    # Coba dengan ML model dulu
    if USE_ML_MODEL:
        tinggi = predict_height_with_model(image)
        if tinggi is not None and tinggi > 0:
            return tinggi
        print("⚠️ Model prediction failed, using MediaPipe fallback")
    
    # Fallback ke MediaPipe
    tinggi = predict_height_with_mediapipe(image)
    
    if tinggi is None or tinggi <= 0:
        print("❌ All prediction methods failed")
        return 0
    
    return tinggi