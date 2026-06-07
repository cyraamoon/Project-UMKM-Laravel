<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>La Brioche Cafe</title>


    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

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
            overflow-x: hidden;
        }

        :root {
            --bg-cream: #FFF9F5;
            --bg-soft: #FDF7F0;
            --brown-light: #E8D5B5;
            --brown-mid: #C4A484;
            --brown-warm: #B8956E;
            --brown-dark: #8B6914;
            --brown-deep: #5C3D2E;
            --gold: #D4A76A;
            --gold-light: #E8C48A;
            --gold-dark: #C49A5C;
            --white: #FFFFFF;
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 8px 30px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--brown-light); }
        ::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 10px; }

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
            transition: all 0.3s ease;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--brown-deep);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-icon {
            background: var(--gold);
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .logo span { color: var(--gold); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            color: var(--brown-deep);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 40px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover {
            background: var(--brown-light);
            color: var(--gold-dark);
        }

        .btn-login {
            background: transparent;
            border: 1.5px solid var(--brown-mid);
        }

        .btn-login:hover {
            background: var(--brown-mid);
            color: white;
        }

        .btn-register {
            background: var(--gold);
            color: white;
            border: none;
        }

        .btn-register:hover {
            background: var(--gold-dark);
            color: white;
        }

        .cart-badge {
            background: var(--gold);
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
            transition: all 0.2s ease;
        }

        .nav-profile:hover {
            background: #E8D5B5;
        }

        .hero {
            position: relative;
            min-height: 620px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #FFF9F5 0%, #FDF7F0 100%);
            overflow: hidden;
        }

        .hero-bg-shape {
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 167, 106, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-bg-shape-2 {
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(232, 213, 181, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            padding: 0 24px;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(212, 167, 106, 0.12);
            color: var(--gold-dark);
            font-size: 12px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 40px;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 64px;
            font-weight: 800;
            color: var(--brown-deep);
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-title span {
            color: var(--gold);
            position: relative;
            display: inline-block;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 0;
            width: 100%;
            height: 12px;
            background: rgba(212, 167, 106, 0.3);
            border-radius: 10px;
            z-index: -1;
        }

        .hero-subtitle {
            font-size: 16px;
            color: #8B7355;
            margin-bottom: 32px;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: var(--gold);
            color: white;
            padding: 14px 36px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 14px rgba(212, 167, 106, 0.3);
        }

        .btn-primary:hover {
            background: var(--gold-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 167, 106, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--brown-mid);
            color: var(--brown-deep);
            padding: 12px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-secondary:hover {
            background: var(--brown-mid);
            color: white;
            border-color: var(--brown-mid);
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 48px;
            margin-top: 48px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--gold);
        }

        .stat-label {
            font-size: 12px;
            color: #8B7355;
            margin-top: 4px;
        }

        .features {
            padding: 80px 56px;
            background: var(--white);
        }

        .section-header {
            text-align: center;
            margin-bottom: 56px;
        }

        .section-subtitle {
            font-size: 12px;
            font-weight: 600;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            font-weight: 700;
            color: var(--brown-deep);
            margin-bottom: 16px;
        }

        .section-desc {
            color: #8B7355;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        .feature-card {
            text-align: center;
            padding: 32px 24px;
            background: var(--bg-cream);
            border-radius: 28px;
            transition: all 0.3s ease;
            border: 1px solid rgba(232, 213, 181, 0.5);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-md);
            border-color: var(--gold-light);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: white;
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--brown-deep);
            margin-bottom: 12px;
        }

        .feature-desc {
            font-size: 14px;
            color: #8B7355;
            line-height: 1.6;
        }

        /* ========== KATEGORI (FUNGSIONAL) ========== */
        .categories {
            padding: 60px 56px;
            background: var(--bg-soft);
        }

        .categories-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .categories-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
        }

        .category-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            background: var(--white);
            border-radius: 50px;
            border: 1px solid var(--brown-light);
            text-decoration: none;
            transition: all 0.3s ease;
            min-width: 140px;
        }

        .category-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--gold);
        }

        .category-btn.active {
            background: var(--gold);
            border-color: var(--gold);
        }

        .category-btn.active .category-btn-name {
            color: white;
        }

        .category-btn.active .category-btn-count {
            color: rgba(255,255,255,0.8);
        }

        .category-btn.active .category-btn-icon {
            filter: brightness(0) invert(1);
        }

        .category-btn-icon {
            font-size: 26px;
        }

        .category-btn-info {
            display: flex;
            flex-direction: column;
        }

        .category-btn-name {
            font-weight: 700;
            font-size: 14px;
            color: var(--brown-deep);
        }

        .category-btn-count {
            font-size: 10px;
            color: var(--brown-warm);
        }

        .products {
            padding: 80px 56px;
        }

        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 48px;
        }

        .filter-tab {
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            background: transparent;
            border: 1.5px solid var(--brown-light);
            color: var(--brown-deep);
            transition: all 0.2s;
            text-decoration: none;
        }

        .filter-tab.active,
        .filter-tab:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: white;
        }

        .product-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }

        .product-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(232, 213, 181, 0.5);
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--gold);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--bg-cream) 0%, var(--brown-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 56px;
        }

        .product-body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 8px;
        }

        .product-name {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 15px;
            color: var(--brown-deep);
            text-decoration: none;
            transition: color 0.2s;
            line-height: 1.3;
        }

        .product-name:hover {
            color: var(--gold);
        }

        .product-category {
            font-size: 9px;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--brown-light);
            color: var(--brown-deep);
            white-space: nowrap;
        }

        .product-desc {
            font-size: 11px;
            color: #8B7355;
            margin-bottom: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .product-price {
            font-weight: 800;
            font-size: 16px;
            color: var(--gold);
        }

        .product-stock {
            font-size: 10px;
            color: #8B7355;
        }

        .product-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .btn-detail {
            flex: 1;
            background: #E8D5B5;
            color: #5C3D2E;
            border: none;
            padding: 8px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            text-decoration: none;
        }

        .btn-detail:hover {
            background: #C4A484;
            color: white;
        }

        .btn-add {
            flex: 1;
            background: var(--gold);
            border: none;
            padding: 8px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-add:hover {
            background: var(--gold-dark);
        }

        .testimonials {
            padding: 80px 56px;
            background: linear-gradient(135deg, var(--bg-cream) 0%, var(--bg-soft) 100%);
        }

        .testimonial-grid {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }

        .testimonial-card {
            background: var(--white);
            padding: 28px;
            border-radius: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(232, 213, 181, 0.5);
        }

        .testimonial-text {
            font-size: 14px;
            line-height: 1.7;
            color: #5C3D2E;
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testimonial-avatar {
            width: 44px;
            height: 44px;
            background: var(--gold-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .testimonial-name {
            font-weight: 700;
            font-size: 14px;
            color: var(--brown-deep);
        }

        .testimonial-role {
            font-size: 11px;
            color: #8B7355;
        }

        .cta {
            padding: 80px 56px;
            background: linear-gradient(135deg, var(--brown-deep) 0%, #3D2A1A 100%);
            text-align: center;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
        }

        .cta-desc {
            color: rgba(255,255,255,0.7);
            margin-bottom: 32px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta .btn-primary {
            background: white;
            color: var(--brown-deep);
            box-shadow: none;
        }

        .cta .btn-primary:hover {
            background: var(--gold);
            color: white;
        }

        .footer {
            background: #1A120B;
            padding: 56px 56px 32px;
            color: #C4A484;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 16px;
        }

        .footer-about {
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            color: #C4A484;
            text-decoration: none;
        }

        .social-link:hover {
            background: var(--gold);
            color: white;
        }

        .footer-title {
            font-weight: 700;
            font-size: 14px;
            color: white;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #C4A484;
            text-decoration: none;
            font-size: 12px;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--gold);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 32px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 11px;
            color: #8B7355;
        }

        @media (max-width: 992px) {
            .navbar { padding: 16px 24px; flex-direction: column; gap: 12px; }
            .features-grid { grid-template-columns: 1fr; gap: 20px; }
            .categories { padding: 40px 24px; }
            .testimonial-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .hero-title { font-size: 44px; }
            .products, .features, .categories, .testimonials, .cta { padding: 48px 24px; }
        }

        @media (max-width: 576px) {
            .category-btn { padding: 8px 14px; min-width: auto; flex: 1; }
            .category-btn-icon { font-size: 20px; }
            .category-btn-name { font-size: 11px; }
            .category-btn-count { font-size: 9px; }
            .hero-buttons { flex-direction: column; align-items: center; }
            .stats { gap: 24px; }
            .product-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; }
            .product-image { height: 160px; font-size: 40px; }
            .product-body { padding: 12px; }
            .product-price { font-size: 14px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('landing') }}" class="logo">
        <div class="logo-icon">🥐</div>
        La <span>Brioche</span>
    </a>

    <div class="nav-links">
        <a href="{{ route('landing') }}" class="nav-link">
            <i class="ti ti-home"></i> Beranda
        </a>
        @auth
            <a href="{{ route('keranjang.index') }}" class="nav-link">
                <i class="ti ti-shopping-cart"></i> Keranjang
                @php $keranjang = session()->get('keranjang', []); $cartCount = array_sum(array_column($keranjang, 'jumlah')); @endphp
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
                    <i class="ti ti-logout"></i> Keluar
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link btn-login">Masuk</a>
            <a href="{{ route('register') }}" class="nav-link btn-register">Daftar</a>
        @endauth
    </div>
</nav>

{{-- HERO SECTION --}}
<section class="hero">
    <div class="hero-bg-shape"></div>
    <div class="hero-bg-shape-2"></div>
    <div class="hero-content">
       <span class="hero-badge">✨ Where Flavor Meets Comfort ✨</span>
<h1 class="hero-title">
    <span>Taste</span> the Difference<br>
    Feel the Love
</h1>
<p class="hero-subtitle">
    Dari kopi spesial hingga hidangan lezat, setiap gigitan dan tegukan di La Brioche
    dibuat dengan bahan premium dan penuh dedikasi.
</p>
        <div class="hero-buttons">
            @auth
                <a href="#products" class="btn-primary">
                    <i class="ti ti-shopping-bag"></i> Belanja Sekarang
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">
                    <i class="ti ti-user-plus"></i> Daftar Sekarang
                </a>
            @endauth
            <a href="#products" class="btn-secondary">
                <i class="ti ti-eye"></i> Lihat Menu
            </a>
        </div>

        <div class="stats">
            <div class="stat-item">
                <div class="stat-number">{{ $totalProduk }}+</div>
                <div class="stat-label">Varian Menu</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $totalPelanggan }}+</div>
                <div class="stat-label">Happy Customers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $rataRating }}★</div>
                <div class="stat-label">Customer Rating</div>
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="section-header">
        <div class="section-subtitle">KENAPA HARUS MEMILIH KAMI</div>
        <h2 class="section-title">Lebih dari Sekadar Cafe</h2>
        <p class="section-desc">Kami berkomitmen memberikan pengalaman terbaik untuk setiap pelanggan</p>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🌾</div>
            <h3 class="feature-title">Bahan Premium</h3>
            <p class="feature-desc">Tepung import pilihan, bahan segar setiap hari, tanpa bahan pengawet</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🚚</div>
            <h3 class="feature-title">Pengiriman Cepat</h3>
            <p class="feature-desc">Antar ke rumah atau ambil langsung di toko, fresh & tepat waktu</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">❤️</div>
            <h3 class="feature-title">Dibuat dengan Cinta</h3>
            <p class="feature-desc">Setiap produk dibuat fresh setiap hari, tidak ada yang basi</p>
        </div>
    </div>
</section>

<section class="categories">
    <div class="section-header">
        <div class="section-subtitle">MENU KAMI</div>
        <h2 class="section-title">Pilih Kategori Favoritmu</h2>
        <p class="section-desc">Tersedia berbagai pilihan menu yang siap memanjakan lidah Anda</p>
    </div>

    <div class="categories-container">
        <div class="categories-wrapper">
            @php
                $allKategoriList = \App\Models\Produk::distinct()->pluck('kategori');
                $icons = [
                    'Main Course' => '🍽️',
                    'Minuman' => '🍹',
                    'Dessert' => '🍰',
                    'Appetizer' => '🍢'
                ];
                $allProductsCount = $produk->count();
            @endphp

            <a href="{{ route('landing') }}"
               class="category-btn {{ empty($kategori) ? 'active' : '' }}">
                <div class="category-btn-icon">🎂</div>
                <div class="category-btn-info">
                    <span class="category-btn-name">Semua Menu</span>
                    <span class="category-btn-count">{{ $allProductsCount }} produk</span>
                </div>
            </a>

            @foreach($allKategoriList as $kat)
                @php
                    $jumlahProduk = \App\Models\Produk::where('kategori', $kat)->count();
                    $icon = $icons[$kat] ?? '🍽️';
                @endphp
                <a href="{{ route('landing', ['kategori' => $kat]) }}"
                   class="category-btn {{ ($kategori ?? '') == $kat ? 'active' : '' }}">
                    <div class="category-btn-icon">{{ $icon }}</div>
                    <div class="category-btn-info">
                        <span class="category-btn-name">{{ $kat }}</span>
                        <span class="category-btn-count">{{ $jumlahProduk }} produk</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="products" id="products">
    <div class="section-header">
        <div class="section-subtitle">OUR SPECIALS</div>
        <h2 class="section-title">Menu Unggulan Hari Ini</h2>
        <p class="section-desc">Pilihan terbaik dari dapur La Brioche untuk Anda</p>
    </div>

    <div class="filter-tabs">
        <a href="{{ route('landing') }}" class="filter-tab {{ empty($kategori) ? 'active' : '' }}">Semua</a>
        @foreach($allKategoriList as $kat)
            <a href="{{ route('landing', ['kategori' => $kat]) }}"
               class="filter-tab {{ ($kategori ?? '') == $kat ? 'active' : '' }}">
                {{ $kat }}
            </a>
        @endforeach
    </div>

    <div class="product-grid">
        @forelse($produk as $p)
        <div class="product-card">
            @if($p->poto)
                <img src="{{ asset('storage/'.$p->poto) }}" class="product-image" alt="{{ $p->nama_produk }}">
            @else
                <div class="product-image">
                    @if($p->kategori == 'Minuman')
                        🍹
                    @elseif($p->kategori == 'Main Course')
                        🍽️
                    @elseif($p->kategori == 'Dessert')
                        🍰
                    @elseif($p->kategori == 'Appetizer')
                        🍢
                    @else
                        🍽️
                    @endif
                </div>
            @endif
            <div class="product-body">
                <div class="product-header">
                    <a href="{{ route('produk.detail', $p->id) }}" class="product-name">
                        {{ $p->nama_produk }}
                    </a>
                    <span class="product-category">{{ $p->kategori }}</span>
                </div>
                <p class="product-desc">{{ Str::limit($p->deskripsi ?? 'Nikmati kelezatan produk premium dari La Brioche', 60) }}</p>
                <div class="product-footer">
                    <span class="product-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                    <span class="product-stock">Stok: {{ $p->stok }}</span>
                </div>
                @auth
                <div class="product-actions">
                    <a href="{{ route('produk.detail', $p->id) }}" class="btn-detail">
                        <i class="ti ti-eye"></i> Detail
                    </a>
                    <form action="{{ route('keranjang.tambah', $p->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        <input type="hidden" name="jumlah" value="1">
                        <button type="submit" class="btn-add">
                            <i class="ti ti-shopping-cart-plus"></i> Tambah
                        </button>
                    </form>
                </div>
                @else
                <div class="product-actions">
                    <a href="{{ route('produk.detail', $p->id) }}" class="btn-detail">
                        <i class="ti ti-eye"></i> Detail
                    </a>
                    <a href="{{ route('login') }}" class="btn-add" style="text-align: center; text-decoration: none;">
                        <i class="ti ti-lock"></i> Masuk
                    </a>
                </div>
                @endauth
            </div>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
            <div style="font-size: 64px; margin-bottom: 16px;">🍞</div>
            <p style="color: #8B7355;">Belum ada produk tersedia.</p>
        </div>
        @endforelse
    </div>
</section>

<section class="testimonials">
    <div class="section-header">
        <div class="section-subtitle">TESTIMONIALS</div>
        <h2 class="section-title">Apa Kata Mereka?</h2>
        <p class="section-desc">Lebih dari {{ $totalPelanggan }}+ pelanggan puas dengan produk kami</p>
    </div>

    <div class="testimonial-grid">
        @forelse($testimonials as $t)
        <div class="testimonial-card">
            <div class="testimonial-rating" style="margin-bottom: 12px;">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $t->rating)
                        <span style="color: #D4A76A;">★</span>
                    @else
                        <span style="color: #E8D5B5;">★</span>
                    @endif
                @endfor
            </div>
            <p class="testimonial-text">"{{ $t->testimoni }}"</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar">
                    {{ substr($t->user->nama_lengkap ?? $t->user->username, 0, 1) }}
                </div>
                <div>
                    <div class="testimonial-name">{{ $t->user->nama_lengkap ?? $t->user->username }}</div>
                    <div class="testimonial-role">Pelanggan Setia</div>
                </div>
            </div>
        </div>
        @empty
        <div class="testimonial-card" style="grid-column: 1/-1; text-align: center;">
            <p>Belum ada testimonial. Jadilah yang pertama!</p>
            @auth
                <a href="{{ route('testimonial.create') }}" class="btn-primary" style="display: inline-block; margin-top: 15px;">✨ Berikan Testimonial</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary" style="display: inline-block; margin-top: 15px;">Login untuk memberi testimonial</a>
            @endauth
        </div>
        @endforelse
    </div>

    @if($testimonials->count() > 0)
    <div style="text-align: center; margin-top: 40px;">
        @auth
            <a href="{{ route('testimonial.create') }}" style="background: #D4A76A; color: white; padding: 10px 24px; border-radius: 40px; text-decoration: none; display: inline-block; font-weight: 600;">
                ✍️ Berikan Testimonial
            </a>
        @else
            <a href="{{ route('login') }}" style="background: #D4A76A; color: white; padding: 10px 24px; border-radius: 40px; text-decoration: none; display: inline-block; font-weight: 600;">
                Login untuk memberi testimonial
            </a>
        @endauth
    </div>
    @endif
</section>

<section class="cta">
    <h2 class="cta-title">Siap Menikmati Kelezatan?</h2>
    <p class="cta-desc">Pesan sekarang dan rasakan sensasi makanan & kopi terbaik dari La Brioche</p>
    @auth
        <a href="#products" class="btn-primary">Pesan Sekarang →</a>
    @else
        <a href="{{ route('register') }}" class="btn-primary">Daftar Sekarang →</a>
    @endauth
</section>

<footer class="footer">
    <div class="footer-grid">
        <div>
            <div class="footer-logo">🥐 La Brioche</div>
            <p class="footer-about">cafe premium dengan bahan terbaik dan dibuat dengan penuh cinta setiap hari.</p>
            <div class="social-links">
                <a href="#" class="social-link"><i class="ti ti-brand-instagram"></i></a>
                <a href="#" class="social-link"><i class="ti ti-brand-facebook"></i></a>
                <a href="#" class="social-link"><i class="ti ti-brand-tiktok"></i></a>
            </div>
        </div>
        <div>
            <h4 class="footer-title">Menu</h4>
            <ul class="footer-links">
                <li><a href="{{ route('landing') }}">Beranda</a></li>
                <li><a href="#products">Produk</a></li>
            </ul>
        </div>
        <div>
            <h4 class="footer-title">Bantuan</h4>
            <ul class="footer-links">
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Syarat & Ketentuan</a></li>
            </ul>
        </div>
        <div>
            <h4 class="footer-title">Kontak</h4>
            <ul class="footer-links">
                <li>📍 Jl. Perjuangan Kota Cirebon</li>
                <li>📞 0812-3456-7890</li>
                <li>✉️ labrioche@gmail.com</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        © {{ date('Y') }} La Brioche — CAFE. All rights reserved.
    </div>
</footer>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(255, 249, 245, 0.98)';
            navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.05)';
        } else {
            navbar.style.background = 'rgba(255, 249, 245, 0.95)';
            navbar.style.boxShadow = 'none';
        }
    });
</script>

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
            timerProgressBar: true,
            iconColor: '#D4A76A'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
            background: '#FFF9F5',
            color: '#4A3520',
            confirmButtonColor: '#D4A76A'
        });
    @endif
</script>
</body>
</html>
