<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar — La Brioche</title>
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

    .auth-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 14px;
    }

    .auth-field {
      display: flex;
      flex-direction: column;
      gap: 5px;
      margin-bottom: 14px;
    }

    .auth-row .auth-field {
      margin-bottom: 0;
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
      <a href="{{ route('login') }}" class="auth-tab">Masuk</a>
      <a href="{{ route('register') }}" class="auth-tab active">Daftar</a>
    </div>

    <form method="POST" action="{{ route('register') }}" id="registerForm">
      @csrf

      <div class="auth-field">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap kamu" value="{{ old('nama_lengkap') }}" required>
      </div>

      <div class="auth-row">
        <div class="auth-field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="email@kamu.com" value="{{ old('email') }}" required>
        </div>
        <div class="auth-field">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="username" value="{{ old('username') }}" required>
        </div>
      </div>

      <div class="auth-field">
        <label for="phone">No. Handphone</label>
        <input type="tel" id="phone" name="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
      </div>

      <div class="auth-field">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" placeholder="Alamat lengkap" value="{{ old('alamat') }}" required>
      </div>

      <div class="auth-row">
        <div class="auth-field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Min. 6 karakter" required>
        </div>
        <div class="auth-field">
          <label for="password_confirmation">Konfirmasi</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
        </div>
      </div>

      <button type="submit" class="auth-btn">Daftar Sekarang</button>
    </form>

    <div class="auth-footer">
      Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
  </div>

  <script>
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

    // ── Error validasi registrasi ──
    @if ($errors->any())
      swalBrioche.fire({
        icon: 'error',
        title: 'Pendaftaran Gagal',
        text: '{{ $errors->first() }}',
        confirmButtonText: 'Coba Lagi',
      });
    @endif

    // ── Sukses registrasi (jika ada redirect balik dengan session, opsional) ──
    @if (session('success'))
      swalBrioche.fire({
        icon: 'success',
        title: 'Selamat Datang! 🎉',
        text: '{{ session('success') }}',
        confirmButtonText: 'Mulai Belanja',
        timer: 3000,
        timerProgressBar: true,
      });
    @endif
  </script>

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
