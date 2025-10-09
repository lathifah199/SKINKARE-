<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrasi</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: url("images/keluarga.jpg") center/cover no-repeat;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.3);
    }

    .register-box {
      position: relative;
      z-index: 10;
      background-color: #e9b9c5;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    h2 {
      margin-bottom: 25px;
      font-size: 24px;
      color: #333;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 45px 12px 15px;
      border-radius: 50px;
      border: 1px solid #ccc;
      font-size: 14px;
      color: #000;
      background-color: #fff;
      box-sizing: border-box;
    }

    .input-group input::placeholder {
      color: #777;
    }

    .input-group input:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 4px rgba(59, 130, 246, 0.5);
    }

    .input-group i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #555;
      font-size: 18px;
    }

    button {
      width: 100%;
      background-color: #000;
      color: #fff;
      padding: 12px;
      font-weight: 600;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-size: 15px;
    }

    button:hover {
      background-color: #333;
    }

    .text-sm {
      font-size: 14px;
      color: #222;
    }

    .text-sm a {
      color: #000;
      font-weight: bold;
      text-decoration: none;
    }

    .text-sm a:hover {
      text-decoration: underline;
    }

    /* Popup Success */
    .popup {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 100;
    }

    .popup-box {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      width: 340px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
      animation: fadeIn 0.3s ease;
    }

    .popup-box h2 {
      margin-bottom: 10px;
      font-size: 20px;
      color: #333;
    }

    .popup-box p {
      color: #666;
      margin-bottom: 15px;
    }

    .popup-box button {
      background: #333;
      color: #fff;
      border: none;
      padding: 8px 20px;
      border-radius: 6px;
      cursor: pointer;
    }

    .popup-box button:hover {
      background: #555;
    }

    /* Error box */
    .error-box {
      background: #f8d7da;
      color: #842029;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
      text-align: left;
    }

    .error-box ul {
      padding-left: 18px;
      margin: 0;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="overlay"></div>

  <div class="register-box">
    <h2>Registrasi</h2>

    <!-- Error message -->
    <div id="errorBox" class="error-box" style="display: none;">
      <ul id="errorList"></ul>
    </div>

    <form id="registerForm">
      <div class="input-group">
        <input type="text" name="nama_pengguna" id="nama_pengguna" placeholder="Nama Pengguna" />
        <i class="fa-solid fa-user-circle"></i>
      </div>

      <div class="input-group">
        <input type="email" name="email" id="email" placeholder="Email" />
        <i class="fa-solid fa-envelope"></i>
      </div>

      <div class="input-group">
        <input type="text" name="alamat_rumah" id="alamat_rumah" placeholder="Alamat Rumah" />
        <i class="fa-solid fa-envelope"></i>
      </div>

      <div class="input-group">
        <input type="text" name="nomor_hp" id="nomor_hp" placeholder="Nomor HP" />
        <i class="fa-solid fa-phone"></i>
      </div>

      <div class="input-group">
        <input type="password" name="kata_sandi" id="kata_sandi" placeholder="Kata Sandi" />
        <i class="fa-solid fa-lock"></i>
      </div>

      <div class="input-group">
        <input type="password" name="kata_sandi_confirmation" id="kata_sandi_confirmation" placeholder="Konfirmasi Kata Sandi" />
        <i class="fa-solid fa-lock"></i>
      </div>

      <button type="submit">Registrasi</button>

      <div class="text-sm" style="margin-top: 15px;">
        Sudah punya akun? <a href="#">Klik di sini</a>
      </div>
    </form>
  </div>

  <!-- Popup success (hidden by default) -->
  <div id="popupSuccess" class="popup" style="display: none;">
    <div class="popup-box">
      <h2>Registrasi Berhasil!</h2>
      <p>Akun kamu telah berhasil dibuat.</p>
      <button onclick="closePopup()">Tutup</button>
    </div>
  </div>

  <script>
    const form = document.getElementById("registerForm");
    const popup = document.getElementById("popupSuccess");
    const errorBox = document.getElementById("errorBox");
    const errorList = document.getElementById("errorList");

    form.addEventListener("submit", (e) => {
      e.preventDefault();

      // ambil data input
      const nama = document.getElementById("nama_pengguna").value.trim();
      const email = document.getElementById("email").value.trim();
      const hp = document.getElementById("nomor_hp").value.trim();
      const sandi = document.getElementById("kata_sandi").value.trim();
      const konfirmasi = document.getElementById("kata_sandi_confirmation").value.trim();

      // reset error
      errorList.innerHTML = "";
      errorBox.style.display = "none";

      // validasi sederhana
      let errors = [];
      if (!nama) errors.push("Nama pengguna wajib diisi.");
      if (!email) errors.push("Email wajib diisi.");
      if (!hp) errors.push("Nomor HP wajib diisi.");
      if (!sandi) errors.push("Kata sandi wajib diisi.");
      if (sandi && sandi.length < 6) errors.push("Kata sandi minimal 6 karakter.");
      if (sandi !== konfirmasi) errors.push("Konfirmasi kata sandi tidak cocok.");

      if (errors.length > 0) {
        errorBox.style.display = "block";
        errors.forEach((err) => {
          const li = document.createElement("li");
          li.textContent = "- " + err;
          errorList.appendChild(li);
        });
        return;
      }

      // tampilkan popup sukses
      popup.style.display = "flex";

      // reset form
      form.reset();

      // otomatis hilang setelah 3 detik
      setTimeout(() => {
        popup.style.display = "none";
      }, 3000);
    });

    function closePopup() {
      popup.style.display = "none";
    }
  </script>
</body>
</html>
