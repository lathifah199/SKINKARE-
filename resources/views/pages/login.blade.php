<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
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

    .login-box {
      position: relative;
      z-index: 10;
      background-color: #E9B9C5;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    label {
      font-weight: 600;
      color: #333;
      margin-left: 5px;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 12px 45px 12px 15px;
      border-radius: 50px;
      border: 1px solid #ccc;
      font-size: 14px;
      color: #000;
      background-color: #fff;
      box-sizing: border-box;
    }

    input::placeholder {
      color: #777;
    }

    input:focus {
      outline: none;
      border-color: #3b82f6; /* biru */
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
      background-color: #53AFA2;
      color: #ffffffff;
      padding: 12px;
      font-weight: 600;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #333;
    }

    .text-center {
      text-align: center;
      font-size: 14px;
      color: #222;
      margin-top: 10px;
    }

    .text-center a {
      color: #000;
      text-decoration: none;
      font-weight: bold;
    }

    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>

  <div class="login-box">
    <h2>Masuk</h2>
    <form>
      <div class="input-group">
        <label for="nama_pengguna">Nama Pengguna</label>
        <input type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Masukkan nama pengguna">
        <i class='bx bxs-user'></i>
      </div>

      <div class="input-group">
        <label for="kata_sandi">Kata Sandi</label>
        <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Masukkan kata sandi">
        <i class='bx bxs-lock'></i>
      </div>

      <button type="submit">Masuk</button>

      <div class="text-center">
        <a href="#">Lupa Kata Sandi?</a>
      </div>
      <div class="text-center">
        Belum punya akun? <a href="#">Klik di sini</a>
      </div>
    </form>
  </div>
</body>
</html>
