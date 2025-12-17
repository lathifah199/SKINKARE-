import cv2
import mediapipe as mp
import numpy as np

mp_pose = mp.solutions.pose
pose = mp_pose.Pose(static_image_mode=True, min_detection_confidence=0.5)

def precheck_image(image):
    """Validasi kondisi gambar sebelum prediksi"""
    try:
        if image is None:
            return False, "Gambar tidak terbaca", {}

        image_rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
        results = pose.process(image_rgb)

        if not results.pose_landmarks:
            return False, "Pose anak tidak terdeteksi", {}

        lm = results.pose_landmarks.landmark
        h, w = image.shape[:2]

        nose = lm[mp_pose.PoseLandmark.NOSE]
        l_sh = lm[mp_pose.PoseLandmark.LEFT_SHOULDER]
        r_sh = lm[mp_pose.PoseLandmark.RIGHT_SHOULDER]
        l_ankle = lm[mp_pose.PoseLandmark.LEFT_ANKLE]

        # CAHAYA - Cek dulu
        brightness = np.mean(cv2.cvtColor(image, cv2.COLOR_BGR2GRAY))
        if brightness < 50:
            return False, "Cahaya terlalu gelap, tambahkan pencahayaan", {}
        if brightness > 200:
            return False, "Cahaya terlalu terang, kurangi pencahayaan", {}

        # POSISI TENGAH
        avg_x = (nose.x + l_sh.x + r_sh.x) / 3
        if avg_x < 0.4:
            return False, "Geser anak ke kanan", {}
        if avg_x > 0.6:
            return False, "Geser anak ke kiri", {}

        # TEGAP (Bahu sejajar)
        if abs(l_sh.y - r_sh.y) > 0.05:
            return False, "Posisikan bahu sejajar (tegak lurus)", {}

        # JARAK (±2 meter dari anak)
        body_ratio = abs((l_ankle.y - nose.y) * h) / h
        if body_ratio < 0.6:
            return False, "Jarak terlalu jauh, dekatkan kamera hingga ±2 meter dari anak", {}
        if body_ratio > 0.85:
            return False, "Jarak terlalu dekat, jauhkan kamera hingga ±2 meter dari anak", {}

        # TINGGI KAMERA (±1 meter dari lantai)
        nose_y_pos = nose.y * h
        if nose_y_pos < h * 0.15:
            return False, "Naikkan kamera hingga setinggi ±1 meter dari lantai", {}
        if nose_y_pos > h * 0.85:
            return False, "Turunkan kamera hingga setinggi ±1 meter dari lantai", {}

        return True, "Posisi ideal, siap scan", {}
    
    except Exception as e:
        print(f"❌ Precheck exception: {str(e)}")
        return False, f"Error precheck: {str(e)}", {}