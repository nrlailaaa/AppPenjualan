<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #cde8e3, #92bfb9);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #1f3f3a;
    }

    .login-container {
      background-color: #ffffff;
      border-radius: 14px;
      box-shadow: 0 0 12px 4px #31796dcc;
      padding: 40px 30px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      border: 2px solid #31796d;
      transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .login-container:hover {
      box-shadow: 0 0 24px 6px #31796dff;
      border-color: #2c9d8f;
    }

    .logo {
      font-size: 36px;
      font-weight: 900;
      color: #2c9d8f;
      margin-bottom: 15px;
      letter-spacing: 2px;
      text-shadow: 0 0 8px #31796dcc, 0 0 10px #2c9d8f99;
    }

    .login-container h2 {
      margin-bottom: 28px;
      color: #2c9d8f;
      font-weight: 700;
      font-size: 26px;
    }

    .input-group {
      position: relative;
      margin-bottom: 18px;
    }

    .input-field {
      padding: 14px 50px 14px 14px;
      border: 2px solid #6fa49c;
      border-radius: 8px;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
      width: 100%;
      box-sizing: border-box;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      color: #234539;
      background-color: #d1ebe8;
    }

    .input-field::placeholder {
      color: #5e9d93;
    }

    .input-field:focus {
      outline: none;
      border-color: #2c9d8f;
      box-shadow: 0 0 10px #2c9d8faa;
      background-color: #ffffff;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 14px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 14px;
      color: #2c9d8f;
      user-select: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }
    .toggle-password:hover {
      color: #31796d;
    }

    .login-button {
      background: linear-gradient(135deg, #2c9d8f, #1f6f64);
      color: white;
      padding: 14px;
      border: none;
      border-radius: 8px;
      font-size: 17px;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
      transition: background 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 14px #2c9d8fcc;
    }

    .login-button:hover {
      background: linear-gradient(135deg, #1f6f64, #16594f);
      box-shadow: 0 6px 18px #16594fcc;
    }

    .forgot-password {
      text-decoration: none;
      color: #31796d;
      font-size: 14px;
      margin-top: 18px;
      display: inline-block;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .forgot-password:hover {
      color: #2c9d8f;
      text-decoration: underline;
    }

    .error-message {
      color: #e74c3c;
      font-size: 14px;
      margin-bottom: 15px;
      text-align: left;
      font-weight: 600;
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="logo">MLXVII</div>
    <h2>Login</h2>

    @if ($errors->any())
      <div class="error-message">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="input-group">
        <input class="input-field" type="email" name="email" placeholder="Masukkan email Anda" required autofocus>
      </div>

      <div class="input-group">
        <input class="input-field" type="password" name="password" id="password" placeholder="Masukkan password" required>
        <span class="toggle-password" onclick="togglePassword()">Show</span>
      </div>

      <button class="login-button" type="submit">Masuk</button>
    </form>

    <a href="https://api.whatsapp.com/send?phone=6289678285388" class="forgot-password" target="_blank">
      Belum punya akun? Hubungi admin
    </a>

  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const toggleBtn = document.querySelector(".toggle-password");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleBtn.textContent = "Hide";
      } else {
        passwordInput.type = "password";
        toggleBtn.textContent = "Show";
      }
    }
  </script>
</body>
</html>
