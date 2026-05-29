<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - La Brioche</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FFF9F5;
            color: #4A3520;
        }

        :root {
            --bg-cream: #FFF9F5;
            --bg-soft: #FDF7F0;
            --brown-light: #E8D5B5;
            --brown-mid: #C4A484;
            --brown-warm: #B8956E;
            --brown-deep: #5C3D2E;
            --gold: #D4A76A;
            --gold-dark: #C49A5C;
            --white: #FFFFFF;
        }

        .admin-wrapper { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: var(--white);
            border-right: 1px solid var(--brown-light);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header { padding: 24px; border-bottom: 1px solid var(--brown-light); }
        .sidebar-logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--brown-deep);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sidebar-logo span { color: var(--gold); }

        .sidebar-menu { list-style: none; padding: 20px 16px; }
        .sidebar-item { margin-bottom: 8px; }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--brown-deep);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s;
            font-weight: 500;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: var(--bg-cream);
            color: var(--gold);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 24px 32px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--brown-light);
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--brown-deep);
        }
        .btn-logout {
            background: none;
            border: 1px solid var(--brown-light);
            padding: 8px 18px;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-logout:hover { background: var(--gold); color: white; border-color: var(--gold); }

        /* STAT CARDS */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: var(--white);
            border-radius: 20px;
            padding: 20px;
            border: 1px solid var(--brown-light);
        }
        .stat-label { font-size: 12px; color: var(--brown-warm); margin-bottom: 8px; }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--gold);
        }

        /* CARDS */
        .card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--brown-light);
            overflow: hidden;
            margin-bottom: 28px;
        }
        .card-header { padding: 16px 24px; background: var(--bg-soft); border-bottom: 1px solid var(--brown-light); }
        .card-title { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: var(--brown-deep); }
        .card-body { padding: 24px; }

        /* FORM */
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--brown-deep); margin-bottom: 6px; }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--brown-light);
            border-radius: 12px;
            background: var(--bg-cream);
            font-family: inherit;
        }
        .form-control:focus { outline: none; border-color: var(--gold); }

        /* BUTTONS */
        .btn-primary {
            background: var(--gold);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-primary:hover { background: var(--gold-dark); }
        .btn-outline {
            background: transparent;
            border: 1px solid var(--brown-light);
            color: var(--brown-deep);
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-outline:hover { background: var(--bg-cream); border-color: var(--gold); }
        .btn-danger {
            background: transparent;
            border: 1px solid #f0cccc;
            color: #cc6666;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-danger:hover { background: #f0cccc; color: #cc0000; }

        /* TABLE */
        .table-wrapper { overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th, .data-table td { padding: 12px; text-align: left; border-bottom: 1px solid var(--brown-light); }
        .data-table th { font-size: 12px; font-weight: 600; color: var(--brown-warm); background: var(--bg-soft); }
        .data-table td { font-size: 13px; }
        .data-table tr:hover td { background: var(--bg-cream); }

        .product-img {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--brown-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .pill {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: var(--brown-light);
            color: var(--brown-deep);
        }

        @media (max-width: 768px) {
            .sidebar { width: 70px; }
            .sidebar-logo span, .sidebar-link span:not(.ti) { display: none; }
            .sidebar-link { justify-content: center; }
            .main-content { margin-left: 70px; padding: 16px; }
            .stat-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">🥐 La <span>Brioche</span></a>
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-item"><a href="{{ route('admin.dashboard') }}" class="sidebar-link"><i class="ti ti-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.transaksi') }}" class="sidebar-link"><i class="ti ti-receipt"></i> <span>Data Transaksi</span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.pelanggan') }}" class="sidebar-link"><i class="ti ti-users"></i> <span>Data Pelanggan</span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.testimonials') }}" class="sidebar-link"> <i class="ti ti-star"></i> <span>Testimonial</span></a>
</li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                <div>
                    <span class="admin-name">{{ Auth::user()->nama_lengkap ?? Auth::user()->username }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Keluar</button>
                    </form>
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <script>
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', background: '#FFF9F5', confirmButtonColor: '#D4A76A', timer: 3000 });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', background: '#FFF9F5', confirmButtonColor: '#D4A76A' });
        @endif
    </script>
</body>
</html>
