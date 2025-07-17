<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Comic Sans MS', cursive, sans-serif;
      background: radial-gradient(circle at top right, #f8c1ff, #c6b3f9, #a4c5ff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-image: url('https://i.imgur.com/B7S9bZP.png'); /* optional: subtle stitch texture bg */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    .login-container {
      background: rgba(255, 250, 255, 0.9);
      backdrop-filter: blur(6px);
      padding: 40px;
      width: 90%;
      max-width: 400px;
      border-radius: 25px;
      border: 3px dashed #cc8df5;
      box-shadow: 0 0 20px rgba(187, 102, 255, 0.3);
      position: relative;
    }

    .login-container::before {
      content: '💙 Stitch Login 💜';
      position: absolute;
      top: -25px;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(to right, #e38eff, #fba3d2);
      padding: 6px 18px;
      border-radius: 20px;
      font-size: 14px;
      color: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #7748d6;
      font-size: 26px;
      margin-bottom: 8px;
    }

    .description {
      text-align: center;
      font-size: 14px;
      color: #9250cc;
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      color: #662c91;
      margin-bottom: 6px;
      display: block;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 2px solid #e4b0ff;
      border-radius: 12px;
      background-color: #fffaff;
      color: #5c1780;
      margin-bottom: 16px;
      transition: all 0.3s ease-in-out;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #b97aff;
      outline: none;
      box-shadow: 0 0 8px #e2a6ff;
    }

    .checkbox-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      color: #6c3cb9;
      margin-bottom: 18px;
    }

    .checkbox-container input[type="checkbox"] {
      accent-color: #cf71ff;
      margin-right: 6px;
    }

    .checkbox-container a {
      color: #b562f0;
      text-decoration: none;
    }

    .checkbox-container a:hover {
      text-decoration: underline;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 12px;
      background: linear-gradient(45deg, #ff9bd1, #b78fff);
      color: #fff;
      font-weight: bold;
      font-size: 15px;
      cursor: pointer;
      transition: 0.3s ease-in-out;
    }

    .submit-btn:hover {
      background: linear-gradient(45deg, #f279c2, #a772f9);
    }

    .footer-text {
      text-align: center;
      margin-top: 20px;
      font-size: 13px;
      color: #a45de6;
    }

    .footer-text a {
      color: #9f4ef0;
      font-weight: bold;
      text-decoration: none;
    }

    .footer-text a:hover {
      text-decoration: underline;
    }

    .session-status,
    .error-message {
      font-size: 13px;
      text-align: center;
      margin-bottom: 14px;
    }

    .session-status {
      color: #8e44ad;
    }

    .error-message {
      color: #e8418d;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Welcome Back</h2>
    <p class="description">Log in your credentials ✨</p>

    <!-- Session Status -->
    @if (session('status'))
      <div class="session-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="stitch@ohana.com">
      @error('email')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required placeholder="••••••••">
      @error('password')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <div class="checkbox-container">
        <label><input type="checkbox" name="remember"> Remember me</label>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">Forgot password?</a>
        @endif
      </div>

      <button type="submit" class="submit-btn">Log In</button>
    </form>

    <p class="footer-text">
      Don’t have an account?
      <a href="{{ route('register') }}">Sign up</a>
    </p>
  </div>

</body>
</html>
