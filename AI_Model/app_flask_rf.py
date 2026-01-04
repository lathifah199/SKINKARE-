import pandas as pd
import joblib, os
from flask import Flask, request, jsonify

app = Flask(__name__)

# ===================== 1️⃣ LOAD MODEL (TANPA TRAINING) =====================
MODEL_PATH = "model_rf_stunting.pkl"
ENCODER_PATH = "label_encoder.pkl"

model = None
le = None

print("✅ Model RF & LabelEncoder berhasil di-load")

# ===================== 2️⃣ BACA DATA WHO Z-SCORE =====================
file_path = 'dataset_rf_stunting.xlsx'

z_laki = None
z_perempuan = None

for zdf in [z_laki, z_perempuan]:
    zdf.rename(columns=lambda c: str(c).strip(), inplace=True)

# ==================== Fungsi Loader ==========================
def load_rf_assets():
    global model, le, z_laki, z_perempuan, assets_loaded

    if assets_loaded:
        return

    # === Load model & encoder ===
    if not os.path.exists(MODEL_PATH) or not os.path.exists(ENCODER_PATH):
        raise FileNotFoundError("Model RF atau LabelEncoder tidak ditemukan")

    model = joblib.load(MODEL_PATH)
    le = joblib.load(ENCODER_PATH)

    # === Load dataset Z-score ===
    if not os.path.exists(file_path):
        raise FileNotFoundError("Dataset Z-score tidak ditemukan")

    df = pd.read_excel(file_path)

    z_laki = df[df['Jenis_Kelamin'].str.lower().str.contains('laki')].copy()
    z_perempuan = df[df['Jenis_Kelamin'].str.lower().str.contains('perempuan')].copy()

    for zdf in [z_laki, z_perempuan]:
        zdf.rename(columns=lambda c: str(c).strip(), inplace=True)

    assets_loaded = True
    print("✅ RF assets loaded successfully")

# ===================== 3️⃣ HITUNG Z-SCORE =====================
def hitung_zscore(umur, tinggi, jenis_kelamin):
    ref = z_laki if 'laki' in jenis_kelamin else z_perempuan
    usia_terdekat = ref.iloc[(ref['USIA'] - umur).abs().argsort()[:1]]

    if usia_terdekat.empty:
        return None

    row = usia_terdekat.iloc[0]
    batas = {
        -3: row['-SD 3'],
        -2: row['-SD 2'],
        -1: row['-SD 1'],
         0: row['Median'],
         1: row['+SD 1'],
         2: row['+SD 2'],
         3: row['+SD 3']
    }

    tinggi = float(tinggi)

    if tinggi <= batas[-3]:
        return -3.5
    elif tinggi >= batas[3]:
        return 3.5

    keys = sorted(batas.keys())
    for i in range(len(keys) - 1):
        k1, k2 = keys[i], keys[i + 1]
        v1, v2 = batas[k1], batas[k2]
        if v1 <= tinggi <= v2:
            z = k1 + (tinggi - v1) * (k2 - k1) / (v2 - v1)
            return round(z, 2)

    return None

# ===================== 4️⃣ INTERPRETASI Z-SCORE =====================
def interpretasi_zscore(z):
    if z is None:
        return "Tidak Diketahui", 0, "Data tidak mencukupi untuk interpretasi Z-score."

    if z >= -2:
        return "Normal", 10, (
            "Anak memiliki tinggi badan sesuai umur dan termasuk kategori normal "
            "berdasarkan Standar Antropometri Anak (PMK No. 2 Tahun 2020)."
        )
    elif z >= -3:
        return "Stunted", 65, (
            "Anak termasuk kategori pendek (stunted) "
            "menurut PMK No. 2 Tahun 2020."
        )
    else:
        return "Severely Stunted", 90, (
            "Anak tergolong sangat pendek (severely stunted) "
            "sesuai PMK No. 2 Tahun 2020."
        )

# ===================== 5️⃣ SARAN OTOMATIS =====================
def get_saran_otomatis(status, z, risiko):
    if status == "Normal":
        warna = "#7DDCD3"
    elif status == "Stunted":
        warna = "#F2A5C4"
    elif status == "Severely Stunted":
        warna = "#F26B6B"
    else:
        warna = "#B0B0B0"

    saran = f"Risiko Stunting: {risiko}% | Z-Score: {z}"
    return saran, warna

# ===================== 6️⃣ ENDPOINT PREDIKSI =====================
@app.route('/predict_rf', methods=['POST'])
def predict_rf():
    try:
        load_rf_assets()
        data = request.get_json()

        umur = float(data.get('umur', 0))
        tinggi = float(data.get('tinggi_badan', 0))
        berat = float(data.get('berat_badan', 0))
        jenis_kelamin = data.get('jenis_kelamin', '').lower()

        if not all([umur, tinggi, berat, jenis_kelamin]):
            return jsonify({'error': 'Data input tidak lengkap!'}), 400

        # --- Z-SCORE ---
        z = hitung_zscore(umur, tinggi, jenis_kelamin)
        status_z, risiko, penjelasan = interpretasi_zscore(z)

        # --- RF PREDICTION ---
        jk_encoded = 1 if 'laki' in jenis_kelamin else 0
        data_baru = pd.DataFrame({
            'Usia_Bulan': [umur],
            'Jenis_Kelamin': [jk_encoded],
            'Tinggi_Badan_cm': [tinggi],
            'Berat_Badan_kg': [berat]
        })

        probas = model.predict_proba(data_baru)[0]
        pred_idx = probas.argmax()
        pred_label = le.inverse_transform([pred_idx])[0]
        prob_rf = probas[pred_idx] * 100

        saran, warna = get_saran_otomatis(status_z, z, risiko)

        return jsonify({
            'status_prediksi': status_z,
            'zscore': z,
            'risiko_persen': round(risiko, 1),
            'kategori_risiko': status_z,
            'warna_risiko': warna,
            'hasil': saran,
            'model_rf': pred_label,
            'probabilitas_rf': round(prob_rf, 1)
        })

    except Exception as e:
        return jsonify({'error': str(e)}), 500

def register_rf_routes(main_app):
    main_app.add_url_rule(
        '/predict_rf',
        view_func=predict_rf,
        methods=['POST']
    )
