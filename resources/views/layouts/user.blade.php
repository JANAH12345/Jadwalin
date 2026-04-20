<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jadwalin')</title>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Lilac Theme Palette */
            --lilac-50:  #f5f3ff;
            --lilac-100: #ede9fe;
            --lilac-200: #ddd6fe;
            --lilac-300: #c4b5fd;
            --lilac-400: #a78bfa;
            --lilac-500: #6d28d9; /* NEW: Deep Purple */
            --lilac-600: #5b21b6;
            --lilac-700: #4c1d95;
            
            --white:     #ffffff;
            --gray-50:   #f9fafb;
            --gray-100:  #f3f4f6;
            --gray-200:  #e5e7eb;
            --gray-300:  #d1d5db;
            --gray-600:  #4b5563;
            --gray-700:  #374151;
            --gray-800:  #1f2937;
            --gray-900:  #111827;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--gray-50);
            color: var(--gray-800);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 0 8rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center; /* Center the menu */
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--lilac-600);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: absolute;
            left: 8rem;
        }
        
        .navbar-brand svg {
            width: 24px;
            height: 24px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--gray-600);
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: var(--lilac-500);
            transition: width 0.2s ease;
        }

        .nav-link:hover {
            color: var(--lilac-600);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .nav-link.active {
            color: var(--lilac-600);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px; /* full rounded */
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            gap: 0.5rem;
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--lilac-500);
            color: var(--lilac-600);
        }

        .btn-outline:hover {
            background: var(--lilac-50);
        }

        .btn-primary {
            background: var(--lilac-600);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(147, 51, 234, 0.25);
        }

        .btn-primary:hover {
            background: var(--lilac-700);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(147, 51, 234, 0.35);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 9999px;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--lilac-100);
            color: var(--lilac-700);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray-700);
            padding-right: 0.5rem;
        }

        /* Main Wrapper */
        main {
            flex: 1;
        }

        /* Footer */
        footer {
            background-color: var(--lilac-200); /* Lilac lebih terang/kontras */
            border-top: 1px solid var(--lilac-300);
            padding: 2.5rem;
            text-align: center;
            color: var(--lilac-800);
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Responsiveness */
        @media (max-width: 1024px) {
            .navbar { padding: 0 2rem; }
            .navbar-brand { left: 2rem; }
        }

        @media (max-width: 768px) {
            .navbar-menu { display: none; }
            .navbar { justify-content: flex-start; padding: 0 1rem; }
            .navbar-brand { position: static; }
        }

        /* Smooth Loading Page Transition */
        #page-loader {
            position: fixed;
            inset: 0;
            background: var(--white);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s ease;
        }

        .loader-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--lilac-100);
            border-top-color: var(--lilac-600);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loaded #page-loader {
            opacity: 0;
            pointer-events: none;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Page Loader -->
    <div id="page-loader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logo-ibik.png') }}" alt="Logo IBIK" style="width: 38px; height: 38px; object-fit: contain;">
            Jadwalin
        </a>

        <div class="navbar-menu">
            <a href="{{ url('/#beranda') }}" class="nav-link">Beranda</a>
            <a href="{{ url('/#tentang') }}" class="nav-link">Tentang</a>
            <!-- Nav Kelola Jadwal (Redirect by auth middleware if not logged in) -->
            <a href="{{ route('user.jadwal') }}" class="nav-link {{ request()->routeIs('user.jadwal') ? 'active' : '' }}">Kelola Jadwal</a>
            <a href="{{ url('/#kontak') }}" class="nav-link">Kontak</a>
        </div>

        <div class="navbar-right" style="position: absolute; right: 8rem;">
            @if(Auth::check() && Auth::user()->role === 'marketing')
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="source" value="user">
                        <button type="submit" class="btn btn-outline" style="padding: 0.4rem 1rem; font-size: 0.8rem; border-radius: 8px;">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 10px 20px; border-radius: 99px; display: inline-flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 18px; height: 18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Login Marketing
                </a>
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('error'))
            <div style="max-width: 600px; margin: 20px auto; background: rgba(254, 226, 226, 0.9); color: #dc2626; padding: 14px 18px; border-radius: 12px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 12px; border: 1px solid rgba(220, 38, 38, 0.2); text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); z-index: 100; position: relative;">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span style="flex: 1;">{{ session('error') }}</span>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Jadwalin. All rights reserved.
    </footer>

    <script>
        // Remove page loader when fully loaded
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });

        // Add smooth scrolling for anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                // Only act on pure ID targets
                if (this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
