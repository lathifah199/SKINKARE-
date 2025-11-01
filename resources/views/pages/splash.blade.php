<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SKINKARE - Splash Screen</title>
  <style>
    /* 🌸 Background dan posisi */
    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #F5C7CD 0%, #C7E8E0 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
    }

    /* 🌼 Kontainer logo + teks */
    .splash-container {
      text-align: center;
      animation: fadeIn 1.5s ease-in-out;
    }

    /* 🌷 Logo */
    .logo {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: white;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin: 0 auto 20px;
      animation: float 2.5s ease-in-out infinite;
    }

    .logo img {
      width: 70px;
      height: 70px;
    }

    /* 🌿 Nama aplikasi */
    h1 {
      font-size: 1.8rem;
      color: #a78aaf;
      letter-spacing: 2px;
    }

    /* ✨ Animasi */
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }
  </style>
</head>
<body>
  <div class="splash-container">
    <div class="logo">
      <img src="images/logo.png" alt="Logo">
    </div>
    <h1>SKINKARE</h1>
  </div>

  <script>
    // Setelah 3 detik, masuk ke halaman utama
    setTimeout(() => {
      window.location.href = "halamanbf"; // ubah sesuai halaman utama kamu
    }, 3000);
  </script>
</body>
</html>
