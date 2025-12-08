from flask import Flask, request, jsonify
import pandas as pd
import numpy as np
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import accuracy_score
import joblib
import warnings
import os # Import untuk cek file

warnings.filterwarnings("ignore")

app = Flask(__name__)

# ==================================================
# 🌸 SKINKARE - Deteksi Dini Stunting (AI Random Forest)
# ==================================================

# --- Konfigurasi File ---
DATASET_PREFIX = 'dataset_rf_stunting.xlsx - '
DATA_INPUT_FILE = 'dataset_rf_stunting.csv'
MODEL_FILE = 'model_rf_stunting.pkl'

# --- HELPER FUNCTIONS ---

def get_standar_filename(sheet_prefix, jk):
    """Membuat nama file standar Z-score berdasarkan prefix dan jenis kelamin (L/P)."""
    gender_suffix = 'L' if jk == 1 else 'P'
    # Format Nama File: 'dataset_rf_stunting.xlsx - BBU_L.csv'
    return f"{DATASET_PREFIX}{sheet_prefix}_{gender_suffix}.csv"

def load_standar(sheet_prefix, jk):
    """
    Memuat data standar Z-score langsung dari file Excel (dataset_rf_stunting.xlsx)
    berdasarkan nama sheet dan jenis kelamin (L/P).
    """
    gender_suffix = 'L' if jk == 1 else 'P'
    sheet_name = f"{sheet_prefix}_{gender_suffix}"
    
    try:
        # Baca langsung dari sheet Excel, mulai dari baris ke-3 (header index ke-2)
        df_raw = pd.read_excel('dataset_rf_stunting.xlsx', sheet_name=sheet_name, header=2)
    except FileNotFoundError:
        print("🚨 File Excel dataset_rf_stunting.xlsx tidak ditemukan.")
        return pd.DataFrame()
    except ValueError:
        print(f"🚨 Sheet {sheet_name} tidak ditemukan di Excel.")
        return pd.DataFrame()
        
    # Ambil 8 kolom pertama
    if df_raw.shape[1] < 8:
        print(f"🚨 Format kolom pada sheet {sheet_name} tidak sesuai standar.")
        return pd.DataFrame()

    df = df_raw.iloc[:, 0:8].copy()
    
    # Standarisasi nama kolom
    df.columns = ['index_value', '-3 sd', '-2 sd', '-1 sd', 'median', '+1 sd', '+2 sd', '+3 sd']
    df.columns = df.columns.str.lower().str.strip().str.replace(' ', '').str.replace('+', '').str.replace('-', '')

    # Konversi ke numerik dan hapus baris NaN
    for col in df.columns:
        df[col] = pd.to_numeric(df[col], errors='coerce')

    df = df.dropna().reset_index(drop=True)
    return df

def get_nearest_row(df, index_value):
    """Mencari baris terdekat berdasarkan nilai index (umur atau tinggi badan)."""
    if df.empty:
        return None
        
    # Kolom index (umur atau tinggi) telah dinamai 'index_value'
    df_sorted = df.sort_values('index_value')
    # Temukan baris dengan 'index_value' terdekat
    nearest = df_sorted.iloc[(df_sorted['index_value'] - index_value).abs().argsort()[:1]]
        
    return nearest.iloc[0] if not nearest.empty else None

def hitung_z(nilai, median, sd_plus1):
    """Menghitung Z-score: (Nilai - Median) / SD. SD ≈ (+1SD) - Median."""
    sd = sd_plus1 - median
    if sd == 0:
        return 0.0
    return round((nilai - median) / sd, 2)

# ==================================================
# 3️⃣ Kategori berdasarkan Z-score (PMK No. 2/2020)
# ==================================================
def kategori_z(z, indeks):
    if indeks == 'BBU':
        if z < -3: return "Berat badan sangat kurang"
        elif -3 <= z < -2: return "Berat badan kurang"
        elif -2 <= z <= 1: return "Normal"
        else: return "Risiko berat badan lebih"
    elif indeks == 'TBU':
        # Stunting: TB/U < -2 SD
        if z < -3: return "Sangat pendek (Stunting Berat)"
        elif -3 <= z < -2: return "Pendek (Stunting)"
        elif -2 <= z <= 3: return "Normal"
        else: return "Tinggi"
    elif indeks in ['BBTB','IMTU']:
        if z < -3: return "Gizi buruk"
        elif -3 <= z < -2: return "Gizi kurang"
        elif -2 <= z < 1: return "Gizi baik" # Batas Normal sampai +1 SD
        elif 1 <= z < 2: return "Risiko gizi lebih"
        elif 2 <= z < 3: return "Gizi lebih"
        else: return "Obesitas"
    return "Tidak diketahui"

# --- MODEL INITIALIZATION ---

le = LabelEncoder()
model = None

try:
    if os.path.exists(MODEL_FILE):
        print(f"🔄 Memuat model dari {MODEL_FILE}...")
        model = joblib.load(MODEL_FILE)
        # Memuat LabelEncoder
        df_temp = pd.read_csv(DATA_INPUT_FILE, sep=';')
        df_temp.columns = [c.lower().strip().replace(' ', '_') for c in df_temp.columns]

        if 'status_stunting' in df_temp.columns:
            df_temp['status_stunting'] = df_temp['status_stunting'].astype(str).str.strip()
            le.fit(df_temp['status_stunting'].dropna().unique())
            print("✅ Model dan LabelEncoder berhasil dimuat.")
        else:
            print("⚠️ Kolom 'status_stunting' tidak ditemukan di dataset.")
    else:
        print(f"⚙️ Melatih model baru menggunakan {DATA_INPUT_FILE}...")
        df_data = pd.read_csv(DATA_INPUT_FILE, sep=';')
        df_data.columns = [c.lower().strip().replace(' ', '_') for c in df_data.columns]

        # Ubah koma jadi titik agar bisa dikonversi ke float
        for col in ['umur', 'tinggi_badan_cm', 'berat_badan_kg']:
            if col in df_data.columns:
                df_data[col] = (
                    df_data[col]
                    .astype(str)
                    .str.replace(',', '.', regex=False)
                    .str.replace(' ', '', regex=False)
                )
                df_data[col] = pd.to_numeric(df_data[col], errors='coerce')

        # Konversi jenis kelamin ke angka
        df_data['jenis_kelamin'] = df_data['jenis_kelamin'].astype(str).str.lower().map({
            'laki-laki': 1, 'laki': 1, 'l': 1,
            'perempuan': 0, 'p': 0
        })

        # Hapus baris kosong
        df_data = df_data.dropna(subset=['umur', 'jenis_kelamin', 'tinggi_badan_cm', 'berat_badan_kg', 'status_stunting'])

        # Fitur & target
        X = df_data[['umur', 'jenis_kelamin', 'tinggi_badan_cm', 'berat_badan_kg']]
        y = df_data['status_stunting']
        y_encoded = le.fit_transform(y)

        X_train, X_test, y_train, y_test = train_test_split(X, y_encoded, test_size=0.2, random_state=42)
        model = RandomForestClassifier(n_estimators=200, max_depth=10, random_state=42)
        model.fit(X_train, y_train)

        accuracy = accuracy_score(y_test, model.predict(X_test))
        print(f"✅ Akurasi Model Random Forest: {round(accuracy * 100, 2)}%")
        joblib.dump(model, MODEL_FILE)
        print(f"✅ Model berhasil disimpan sebagai {MODEL_FILE}")

except Exception as e:
    print(f"❌ Gagal inisialisasi model atau dataset: {e}")
    model = None


# ==================================================
# 4️⃣ Endpoint Prediksi
# ==================================================
@app.route('/predict_rf', methods=['POST'])
def predict_rf():
    if model is None:
        return jsonify({"status": "error", "message": "Model AI belum terinisialisasi. Periksa file dataset."}), 500
        
    try:
        data = request.get_json() if request.is_json else request.form.to_dict()

        # Ambil & ubah tipe data
        umur = float(data.get('umur', 0))
        tinggi = float(data.get('tinggi_badan', 0))
        berat = float(data.get('berat_badan', 0))
        jenis_kelamin = data.get('jenis_kelamin', 'L')
        nama_anak = str(data.get('nama_anak', 'Anak'))

        jk_encoded = 1 if str(jenis_kelamin).lower() in ['l', 'laki-laki'] else 0
        jk_label = 'Laki-laki' if jk_encoded == 1 else 'Perempuan'
        
        # Validasi Input
        if umur <= 0 or tinggi <= 0 or berat <= 0:
             return jsonify({"status": "error", "message": "Input Umur, Tinggi Badan, dan Berat Badan harus lebih dari nol."}), 400


        # 🔹 Prediksi AI (Random Forest)
        df_input = pd.DataFrame({
            'umur':[umur], 'jenis_kelamin':[jk_encoded], 'tinggi_badan_cm':[tinggi], 'berat_badan_kg':[berat]
        })

        # 🔹 Prediksi AI (Random Forest)
   # 🔹 Prediksi AI (Random Forest)
        probas = model.predict_proba(df_input)[0].tolist()  # ubah array ke list
        pred_idx = int(np.argmax(probas))  # indeks tertinggi probabilitas
        pred_class = model.predict(df_input)[0]   # ambil label hasil prediksi

        # 🔹 Pastikan inverse transform pakai list
        try:
            pred_label = le.inverse_transform([pred_class])
            #pred_label = [pred_class][0]
        except Exception as e:
            print(f"⚠️ Gagal inverse_transform: {e}")
            pred_label = str(pred_class)



        prob_prediksi = round(float(probas[pred_idx]) * 100, 2)

        
        # 🔹 Hitung IMT
        imt = round(berat / ((tinggi/100)**2), 2)

        # 🔹 Ambil standar antropometri
        df_bbu = load_standar('BBU', jk_encoded)
        df_tbu = load_standar('TBU', jk_encoded)
        df_bbtb = load_standar('BBTB', jk_encoded)
        df_imtu = load_standar('IMTU', jk_encoded)
        
        if df_bbu.empty or df_tbu.empty or df_bbtb.empty or df_imtu.empty:
            return jsonify({"status": "error", "message": "Gagal memuat standar antropometri Z-Score. Periksa file CSV standar."}), 500

        # --- Perhitungan Z-Score ---
        row_bbu = get_nearest_row(df_bbu, umur)  # Index: Umur
        row_tbu = get_nearest_row(df_tbu, umur)  # Index: Umur
        row_bbtb = get_nearest_row(df_bbtb, tinggi) # 🔥 FIX: Index: TINGGI BADAN
        row_imtu = get_nearest_row(df_imtu, umur) # Index: Umur
        
        if row_bbu is None or row_tbu is None or row_bbtb is None or row_imtu is None:
             return jsonify({"status": "error", "message": "Data anak berada di luar rentang standar PMK 2/2020 (misal: Umur > 60 bulan atau Tinggi Badan di luar batas)."}), 400

        # Hitung Z-score
        z_bbu = hitung_z(berat, row_bbu['median'], row_bbu['+1sd'])
        z_tbu = hitung_z(tinggi, row_tbu['median'], row_tbu['+1sd'])
        z_bbtb = hitung_z(berat, row_bbtb['median'], row_bbtb['+1sd'])
        z_imtu = hitung_z(imt, row_imtu['median'], row_imtu['+1sd'])

        # Kategori
        kategori_bbu = kategori_z(z_bbu, 'BBU')
        kategori_tbu = kategori_z(z_tbu, 'TBU')
        kategori_bbtb = kategori_z(z_bbtb, 'BBTB')
        kategori_imtu = kategori_z(z_imtu, 'IMTU')

        # ==================================================
        # 🔹 Rekomendasi Panjang (Logic remains the same)
        # ==================================================
        rekomendasi = []
        
        # Penentuan Status Final (Prioritas Stunting dari TB/U)
        status_deteksi_final = pred_label
        if z_tbu < -2:
             status_deteksi_final = "Stunting"
             if z_tbu < -3: status_deteksi_final = "Stunting Berat"
        elif pred_label == "Normal" and z_tbu < -2:
             # Override RF Normal jika Z-score TBU menunjukkan stunting
             status_deteksi_final = kategori_tbu.replace('Pendek (', '').replace(')', '') # Ambil 'Stunting'

        if 'stunting' in status_deteksi_final.lower() or z_tbu < -2:
            rekomendasi.append(
                "Anak menunjukkan perawakan pendek berdasarkan indeks Tinggi Badan menurut Umur (TB/U). "
                "Hal ini termasuk indikasi stunting. Lakukan pemantauan pertumbuhan secara rutin setiap bulan. "
                "Disarankan untuk segera melakukan konsultasi ke posyandu atau tenaga kesehatan untuk tatalaksana stunting."
            )
        elif -2 <= z_tbu <= 3:
            rekomendasi.append(
                "Tinggi badan anak tergolong normal sesuai usia. Pertahankan pola makan dan perawatan yang seimbang. "
                "Tetap lakukan pemantauan rutin di posyandu untuk memastikan tren pertumbuhan linear tetap baik."
            )

        if z_bbu < -2:
            rekomendasi.append(
                "Berat badan anak di bawah standar normal. Anak berisiko mengalami gizi kurang atau gagal tumbuh. "
                "Perlu dilakukan penilaian status gizi lengkap dan evaluasi kenaikan berat badan tiap bulan."
            )
        elif z_bbu > 1:
            rekomendasi.append(
                "Berat badan anak di atas rata-rata. Perlu pemantauan kenaikan IMT untuk mencegah risiko gizi lebih atau obesitas."
            )
        else: # -2 <= z_bbu <= 1
            rekomendasi.append(
                "Berat badan anak normal untuk usianya. Teruskan pemberian makanan bergizi seimbang "
                "dengan cukup protein, karbohidrat, sayur, dan buah-buahan."
            )

        if z_imtu > 1:
            rekomendasi.append(
                "Nilai Indeks Massa Tubuh (IMT/U) anak lebih tinggi dari standar. "
                "Hal ini dapat mengindikasikan risiko gizi lebih atau obesitas. Perlu evaluasi pola makan dan aktivitas fisik anak."
            )
        
        # Gabungkan rekomendasi menjadi satu string dengan pemisah yang jelas
        rekomendasi_lengkap = " ".join(rekomendasi)

        # ==================================================
        # 5️⃣ Kirim Hasil ke Laravel/hasil_deteksi.blade.php
        # ==================================================
        
        result = {
            "status": "success",
            "message": "Deteksi stunting berhasil dilakukan.",
            
            # --- Data Input Anak ---
            "nama_anak": nama_anak,
            "umur_bulan": umur,
            "jenis_kelamin": jk_label,
            "tinggi_badan": tinggi,
            "berat_badan": berat,
            "imt": imt,

            # --- Hasil Deteksi ---
            "status_deteksi_final": status_deteksi_final,
            "status_ai_rf": pred_label,
            "probabilitas": prob_prediksi,
            "rekomendasi_lengkap": rekomendasi_lengkap,

            # Detail Z-score (Untuk nakes)
            "z_bbu": z_bbu, "kategori_bbu": kategori_bbu,
            "z_tbu": z_tbu, "kategori_tbu": kategori_tbu,
            "z_bbtb": z_bbtb, "kategori_bbtb": kategori_bbtb,
            "z_imtu": z_imtu, "kategori_imtu": kategori_imtu,
        }

        return jsonify(result)

    except Exception as e:
        print(f"❌ Terjadi Kesalahan: {e}")
        return jsonify({
            "status": "error",
            "message": f"Terjadi kesalahan pada server AI: {str(e)}"
        }), 500
# ==================================================
# 1️⃣ Load dataset utama (langsung dari Excel)
# ==================================================
dataset_file = 'dataset_rf_stunting.xlsx'

try:
    df_data = pd.read_excel(dataset_file, sheet_name='DataInput')

    # Normalisasi nama kolom agar seragam
    df_data.columns = [c.strip().lower().replace(' ', '_') for c in df_data.columns]

    # Pastikan kolom yang dibutuhkan ada
    expected_cols = ['umur', 'jenis_kelamin', 'tinggi_badan_cm', 'berat_badan_kg', 'status_stunting']
    for col in expected_cols:
        if col not in df_data.columns:
            raise KeyError(f"Kolom '{col}' tidak ditemukan di sheet DataInput.")

    # Encode jenis kelamin
    df_data['jenis_kelamin'] = df_data['jenis_kelamin'].astype(str).str.lower().map({
        'laki-laki': 1, 'laki': 1, 'l': 1,
        'perempuan': 0, 'p': 0
    })

    # Fitur & target
    X = df_data[['umur', 'jenis_kelamin', 'tinggi_badan_cm', 'berat_badan_kg']]
    y = df_data['status_stunting'].astype(str).str.strip()

    le = LabelEncoder()
    y_encoded = le.fit_transform(y)

    # Latih model Random Forest
    X_train, X_test, y_train, y_test = train_test_split(X, y_encoded, test_size=0.2, random_state=42)
    model = RandomForestClassifier(n_estimators=200, max_depth=10, random_state=42)
    model.fit(X_train, y_train)

    print("✅ Model & LabelEncoder berhasil dilatih dari Excel (DataInput).")
    print("🧠 Kelas yang terdeteksi:", list(le.classes_))
except Exception as e:
    print("❌ Gagal melatih model:", e)
    model = None

if __name__ == '__main__':
    print("--- Aplikasi SKINKARE (Flask AI) Siap Dijalankan ---")
    if os.path.exists(DATA_INPUT_FILE):
        app.run(debug=True, port=5001, host="0.0.0.0")
    else:
        print(f"❌ ERROR: File dataset utama ({DATA_INPUT_FILE}) tidak ditemukan. Gagal menjalankan aplikasi.")