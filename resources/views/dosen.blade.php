npm <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Dosen')</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --accent: #0ea5e9;
            --bg-body: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --sidebar-width: 280px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); color: var(--text-main); }

        .app-layout { display: flex; min-height: 100vh; }

        /* SIDEBAR MODERN */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.02);
        }

        .sidebar-brand {
            padding: 28px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px dashed var(--border-color);
        }

        .brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            display: flex; align-items: center; justify-content: center;
            border-radius: 12px;
            font-size: 20px;
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.25);
        }

        .sidebar-brand h2 { font-size: 17px; font-weight: 800; color: var(--text-main); letter-spacing: -0.5px; }
        .sidebar-brand span { font-size: 11px; color: var(--text-muted); display: block; font-weight: 500; }

        .sidebar-nav { padding: 24px 16px; display: flex; flex-direction: column; gap: 6px; flex-grow: 1; }
        .nav-label { font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); padding: 0 12px; margin-bottom: 8px; letter-spacing: 0.8px; }

        .sidebar-link {
            display: flex; align-items: center; gap: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px; font-weight: 600;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background: #eef2ff;
            color: var(--primary);
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.08);
        }

        /* MAIN CONTENT CONTAINER */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* TOP NAVBAR */
        .topbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 40px;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 90;
        }

        .topbar-title h1 { font-size: 20px; font-weight: 800; color: var(--text-main); letter-spacing: -0.5px; }
        .topbar-title p { font-size: 13px; color: var(--text-muted); margin-top: 2px; }

        .topbar-action { display: flex; align-items: center; gap: 16px; }
        
        .logout-btn {
            background: #ffeeef;
            color: #ef4444;
            border: 1px solid #fecdce;
            padding: 9px 18px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex; align-items: center; gap: 6px;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        /* CONTENT CONTAINER */
        .content-container {
            max-width: 1300px;
            margin: 32px auto;
            padding: 0 32px;
            width: 100%;
        }

        /* GLOBAL COMPONENTS STYLING */
        .alert {
            padding: 16px 20px; border-radius: 14px; margin-bottom: 24px;
            font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }
        .alert-success { background: #f0fdf4; color: #15803d; border: 1px solid #dcfce7; }

        .card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 28px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            transition: transform 0.2s;
        }

        .card-header-flex {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 24px; padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title-group h2 { font-size: 18px; font-weight: 700; color: var(--text-main); }
        .card-title-group p { font-size: 13px; color: var(--text-muted); margin-top: 3px; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-full { grid-column: span 2; }
        .form-group { margin-bottom: 18px; }

        label { display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px; }

        input, select, textarea {
            width: 100%; padding: 13px 16px;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            background: #f8fafc;
            color: var(--text-main);
            font-family: inherit; font-size: 14px;
            outline: none; transition: all 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        textarea { min-height: 120px; resize: vertical; }

        .btn {
            border: none; padding: 12px 24px;
            border-radius: 12px; font-family: inherit; font-weight: 700;
            cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        /* Responsive Layout */
        @media(max-width: 1024px) {
            .sidebar { display: none; }
            .main-wrapper { margin-left: 0; }
            .topbar { padding: 16px 20px; }
            .content-container { padding: 0 16px; }
            .form-grid { grid-template-init: 1fr; grid-template-columns: 1fr; }
            .form-full { grid-column: span 1; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="app-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon">🎓</div>
                <div>
                    <h2>Portal Dosen</h2>
                    <span>Akademik Kampus</span>
                </div>
            </div>  

            <div class="sidebar-nav">
    <div class="nav-label">Menu Utama</div>
    <a href="{{ route('dosen.dashboard') }}" class="sidebar-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}">📊 Dashboard Utama</a>
    <a href="{{ route('dosen.matkul') }}" class="sidebar-link {{ request()->routeIs('dosen.matkul') ? 'active' : '' }}">📚 Mata Kuliah</a>
    <a href="{{ route('dosen.tugas') }}" class="sidebar-link {{ request()->routeIs('dosen.tugas') ? 'active' : '' }}">📝 Buat Tugas</a>
    <a href="{{ route('dosen.nilai') }}" class="sidebar-link {{ request()->routeIs('dosen.nilai') ? 'active' : '' }}">📈 Nilai & Tugas Mhs</a>
</div>
        </aside>

        <!-- MAIN WRAPPER -->
        <div class="main-wrapper">
            
            <!-- TOPBAR -->
            <header class="topbar">
                <div class="topbar-title">
                    <h1>Selamat Datang, Dosen 👋</h1>
                    <p>Sistem Pengelolaan Tugas & Penilaian Mahasiswa</p>
                </div>

                <div class="topbar-action">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <main class="content-container">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>