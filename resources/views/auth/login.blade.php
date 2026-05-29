<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk — La Brioche</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

  {{-- SweetAlert2 CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: #faf7f2;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'DM Sans', sans-serif;
      padding: 2rem;
    }

    .auth-card {
      background: #fff;
      border: 1px solid #e8dfd2;
      border-radius: 12px;
      padding: 2.5rem 2.25rem;
      width: 100%;
      max-width: 380px;
    }

    .auth-logo {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 2rem;
    }

    .auth-logo-icon {
      width: 40px;
      height: 40px;
      background: #2c1a0e;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Playfair Display', serif;
      font-style: italic;
      font-size: 18px;
      color: #e8a96e;
      margin-bottom: 8px;
    }

    .auth-logo-name {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      color: #2c1a0e;
    }

    .auth-tabs {
      display: flex;
      border-bottom: 1px solid #e8dfd2;
      margin-bottom: 1.75rem;
    }

    .auth-tab {
      flex: 1;
      display: block;
      text-align: center;
      padding: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 500;
      color: #b0a090;
      text-decoration: none;
      border-bottom: 2px solid transparent;
      margin-bottom: -1px;
    }

    .auth-tab.active {
      color: #2c1a0e;
      border-bottom-color: #c88133;
    }

    .auth-field {
      display: flex;
      flex-direction: column;
      gap: 5px;
      margin-bottom: 14px;
    }

    .auth-field label {
      font-size: 12px;
      font-weight: 500;
      color: #6b5040;
    }

    .auth-field input {
      background: #faf7f2;
      border: 1px solid #e0d5c5;
      border-radius: 8px;
      padding: 10px 12px;
      font-size: 14px;
      font-family: 'DM Sans', sans-serif;
      color: #2c1a0e;
      outline: none;
      width: 100%;
      transition: border-color 0.15s, box-shadow 0.15s;
    }

    .auth-field input:focus {
      border-color: #c88133;
      box-shadow: 0 0 0 3px #c8813318;
      background: #fff;
    }

    .auth-field input::placeholder { color: #c0b0a0; }

    .auth-forgot {
      text-align: right;
      margin-top: -6px;
      margin-bottom: 14px;
    }

    .auth-forgot a {
      font-size: 12px;
      color: #c88133;
      text-decoration: none;
    }

    .auth-btn {
      background: #2c1a0e;
      color: #e8a96e;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 500;
      letter-spacing: 0.05em;
      cursor: pointer;
      width: 100%;
      margin-top: 4px;
    }

    .auth-btn:hover { background: #3d2510; }

    .auth-footer {
      text-align: center;
      margin-top: 1.25rem;
      font-size: 12px;
      color: #8a7060;
    }

    .auth-footer a {
      color: #c88133;
      text-decoration: none;
      font-weight: 500;
    }
  </style>
</head>
<body>
  <div class="auth-card">
    <div class="auth-logo">
      <div class="auth-logo-icon">L</div>
      <span class="auth-logo-name">La Brioche</span>
    </div>

    <div class="auth-tabs">
      <a href="{{ route('login') }}" class="auth-tab active">Masuk</a>
      <a href="{{ route('register') }}" class="auth-tab">Daftar</a>
    </div>

    <form method="POST" action="{{ route('login') }}" id="loginForm">
      @csrf

      <div class="auth-field">
        <label for="email">Email atau Username</label>
        <input type="text" id="email" name="email" placeholder="Masukkan email / username" value="{{ old('email') }}" required autofocus>
      </div>

      <div class="auth-field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password kamu" required>
      </div>

      <div class="auth-forgot">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">Lupa password?</a>
        @endif
      </div>

      <button type="submit" class="auth-btn">Masuk</button>
    </form>

    <div class="auth-footer">
      Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>
  </div>

  <script>
    // Kustomisasi tampilan SweetAlert2 sesuai tema La Brioche
    const swalBrioche = Swal.mixin({
      customClass: {
        popup:        'swal-brioche-popup',
        title:        'swal-brioche-title',
        htmlContainer:'swal-brioche-text',
        confirmButton:'swal-brioche-btn',
      },
      buttonsStyling: false,
      fontFamily: "'DM Sans', sans-serif",
    });

    // ── Error validasi / login gagal ──
    @if ($errors->any())
      swalBrioche.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '{{ $errors->first() }}',
        confirmButtonText: 'Coba Lagi',
      });
    @endif

    // ── Pesan sukses dari session (misal: setelah logout) ──
    @if (session('status'))
      swalBrioche.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('status') }}',
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true,
      });
    @endif
  </script>

  {{-- Custom style untuk SweetAlert agar cocok dengan tema --}}
  <style>
    .swal-brioche-popup {
      border-radius: 12px !important;
      font-family: 'DM Sans', sans-serif !important;
      border: 1px solid #e8dfd2 !important;
    }
    .swal-brioche-title {
      font-family: 'Playfair Display', serif !important;
      color: #2c1a0e !important;
      font-size: 20px !important;
    }
    .swal-brioche-text {
      color: #6b5040 !important;
      font-size: 14px !important;
    }
    .swal-brioche-btn {
      background: #2c1a0e !important;
      color: #e8a96e !important;
      border: none !important;
      border-radius: 8px !important;
      padding: 10px 28px !important;
      font-family: 'DM Sans', sans-serif !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      letter-spacing: 0.05em !important;
      cursor: pointer !important;
    }
    .swal-brioche-btn:hover {
      background: #3d2510 !important;
    }
  </style>
</body>
</html>
