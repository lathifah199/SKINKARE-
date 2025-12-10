from flask import Flask, request, jsonify
import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import accuracy_score
import joblib, os

app = Flask(__name__)

# ===================== 1️⃣ Baca Dataset =====================
file_path = 'dataset_rf_stunting.xlsx'

if not os.path.exists(file_path):
    raise FileNotFoundError("❌ File dataset_rf_stunting.xlsx tidak ditemukan!")

df = pd.read_excel(file_path, sheet_name='DataInput')

# Bersihkan dan siapkan data
df['Jenis_Kelamin'] = df['Jenis_Kelamin'].map({'Laki-laki': 1, 'Perempuan': 0})
for col in ['Usia_Bulan', 'Jenis_Kelamin', 'Tinggi_Badan_cm', 'Berat_Badan_kg']:
    df[col] = pd.to_numeric(df[col], errors='coerce')
df = df.dropna(subset=['Usia_Bulan', 'Jenis_Kelamin', 'Tinggi_Badan_cm', 'Berat_Badan_kg'])

# ===================== 2️⃣ Latih Model Random Forest =====================
X = df[['Usia_Bulan', 'Jenis_Kelamin', 'Tinggi_Badan_cm', 'Berat_Badan_kg']]
y = df['Status_Stunting']

le = LabelEncoder()
y_encoded = le.fit_transform(y)

X_train, X_test, y_train, y_test = train_test_split(X, y_encoded, test_size=0.2, random_state=42)
model = RandomForestClassifier(n_estimators=200, max_depth=10, random_state=42)
model.fit(X_train, y_train)

akurasi = accuracy_score(y_test, model.predict(X_test)) * 100
print(f"✅ Model Random Forest dilatih (akurasi: {akurasi:.2f}%)")

joblib.dump(model, 'model_rf_stunting.pkl')
joblib.dump(le, 'label_encoder.pkl')

# ===================== 3️⃣ Baca Tabel WHO Z-Score =====================
z_laki = pd.read_excel(file_path, sheet_name='Anak Laki-laki', skiprows=2)
z_perempuan = pd.read_excel(file_path, sheet_name='Anak Perempuan', skiprows=2)

for zdf in [z_laki, z_perempuan]:
    zdf.rename(columns=lambda c: str(c).strip(), inplace=True)
print("📘 Kolom sheet Laki-laki:", list(z_laki.columns))
print("📘 Kolom sheet Perempuan:", list(z_perempuan.columns))

# ===================== 4️⃣ Hitung Z-Score Berdasarkan WHO =====================
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

# ===================== 5️⃣ Konversi Z-Score → Risiko =====================
def zscore_to_risk(z):
    if z is None:
        return 0, "Tidak Diketahui"
    if z >= -1:
        return 20, "Normal"
    elif z >= -2:
        return 45, "Mulai Berisiko"
    elif z >= -3:
        return 70, "Berisiko Tinggi"
    else:
        return 90, "Sangat Berisiko"

# ===================== 6️⃣ Fungsi Saran Otomatis =====================
def get_saran_otomatis(pred_label, z, risiko):
    pred_label = pred_label.lower()

    if 'normal' in pred_label:
        kategori = "Normal"
        warna = "#7DDCD3"  # Tosca pastel
        saran = (
            f"Risiko Stunting: {risiko:.1f}% ({kategori}).\n"
            f"Nilai Z-Score: {z}.\n\n"
            "Pertumbuhan anak berada dalam kategori normal. "
            "Pertahankan pola makan bergizi seimbang dengan karbohidrat, protein, sayur, dan buah. "
            "Lakukan pemantauan tinggi dan berat badan secara rutin di Posyandu."
        )

    elif 'stunting' in pred_label:
        kategori = "Beresiko"
        warna = "#F2A5C4"  # Pink lembut
        saran = (
            f"Risiko Stunting: {risiko:.1f}% ({kategori}).\n"
            f"Nilai Z-Score: {z}.\n\n"
            "Anak menunjukkan potensi keterlambatan pertumbuhan. "
            "Perbaiki asupan gizi harian dengan menambah protein hewani (ikan, ayam, telur) "
            "dan sayur serta buah. "
            "Konsultasikan dengan tenaga kesehatan untuk panduan pencegahan stunting."
        )

    else:
        kategori = "Tidak Diketahui"
        warna = "#B0B0B0"
        saran = (
            "Data tidak dapat diinterpretasikan dengan pasti. "
            "Pastikan data tinggi, berat, dan usia anak sudah benar, lalu ulangi deteksi."
        )

    return saran, kategori, warna

# ===================== 7️⃣ Endpoint Prediksi =====================
@app.route('/predict_rf', methods=['POST'])
def predict_rf():
    try:
        data = request.get_json()
        umur = float(data.get('umur', 0))
        tinggi = float(data.get('tinggi_badan', 0))
        berat = float(data.get('berat_badan', 0))
        jenis_kelamin = data.get('jenis_kelamin', '').lower()

        if not all([umur, tinggi, berat, jenis_kelamin]):
            return jsonify({'error': 'Data input tidak lengkap!'}), 400

        # --- Prediksi Random Forest ---
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

        # --- Hitung Z-Score WHO ---
        z = hitung_zscore(umur, tinggi, jenis_kelamin)
        risiko, kategori_z = zscore_to_risk(z)

        # --- Ambil saran gabungan RF + Z-Score ---
        saran, kategori, warna = get_saran_otomatis(pred_label, z, risiko)

        # --- Log hasil ke terminal (biar bisa dicek langsung) ---
        print(f"👶 Umur: {umur} bln | JK: {jenis_kelamin} | TB: {tinggi} cm | RF: {pred_label} | Z: {z} | Risiko: {risiko}%")

        return jsonify({
            'status_prediksi': pred_label,
            'zscore': z,
            'risiko_persen': round(risiko, 2),
            'kategori_risiko': kategori,
            'warna_risiko': warna,
            'hasil': saran
        })

    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    print("🚀 Flask API SKINKARE - Random Forest + WHO Z-Score aktif (versi sopan & profesional)")
    app.run(debug=True, host='127.0.0.1', port=5001)
