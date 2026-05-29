<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>La Brioche - @yield('title', 'Bakery & Coffee')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FFF9F5;
            color: #4A3520;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 249, 245, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(232, 213, 181, 0.5);
            padding: 16px 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 800;
            color: #5C3D2E;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-link {
            color: #5C3D2E;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 40px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover {
            background: #E8D5B5;
        }

        .btn-login {
            background: transparent;
            border: 1.5px solid #C4A484;
        }

        .btn-register {
            background: #D4A76A;
            color: white;
            border: none;
        }

        .cart-badge {
            background: #D4A76A;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            margin-left: 4px;
        }

        .nav-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 16px 4px 8px;
            border-radius: 40px;
            background: #FDF7F0;
            border: 1px solid #E8D5B5;
            text-decoration: none;
            color: #5C3D2E;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-profile:hover {
            background: #E8D5B5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 12px 20px;
                flex-direction: column;
                gap: 12px;
            }
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ route('landing') }}" class="logo">
        🥐 La Brioche
    </a>

    <div class="nav-links">
        <a href="{{ route('landing') }}" class="nav-link">
            <i class="ti ti-home"></i> Beranda
        </a>
        @auth
            <a href="{{ route('keranjang.index') }}" class="nav-link">
                <i class="ti ti-shopping-cart"></i> Keranjang
                @php
                    $keranjang = session()->get('keranjang', []);
                    $cartCount = array_sum(array_column($keranjang, 'jumlah'));
                @endphp
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>

            <a href="{{ route('profile.index') }}" class="nav-profile">
                @if(Auth::user()->foto_profil)
                    <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                         style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                @else
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #D4A76A; display: flex; align-items: center; justify-content: center; font-size: 16px; color: white;">
                        👤
                    </div>
                @endif
                <span>Profil</span>
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: none; cursor: pointer;">
                    <i class="ti ti-logout"></i> Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link btn-login">Login</a>
            <a href="{{ route('register') }}" class="nav-link btn-register">Daftar</a>
        @endauth
    </div>
</nav>

{{-- MAIN CONTENT --}}
<main>
    @yield('content')
</main>

{{-- SweetAlert Notifications --}}
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            background: '#FFF9F5',
            color: '#4A3520',
            confirmButtonColor: '#D4A76A',
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            background: '#FFF9F5',
            color: '#4A3520',
            confirmButtonColor: '#D4A76A'
        });
    @endif

    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: '{{ session('info') }}',
            background: '#FFF9F5',
            color: '#4A3520',
            confirmButtonColor: '#D4A76A'
        });
    @endif
</script>

</body>
</html>
