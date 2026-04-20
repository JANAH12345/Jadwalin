<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Jadwalin</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --lilac-50:  #faf5ff;
            --lilac-100: #f3e8ff;
            --lilac-200: #e9d5ff;
            --lilac-400: #c084fc;
            --lilac-500: #a855f7;
            --lilac-600: #9333ea;
            --white:     #ffffff;
            --gray-300:  #d1d5db;
            --gray-400:  #9ca3af;
            --gray-500:  #6b7280;
            --gray-800:  #1f2937;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url("{{ asset('images/bg-marketing.png') }}") no-repeat center center fixed;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        /* Background Overlay (Cooler tone for Admin) */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(88, 28, 135, 0.45) 0%, rgba(20, 20, 20, 0.75) 100%);
            z-index: 1;
        }

        .login-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            animation: fadeInScale 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 24px 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .logo-container {
            margin-bottom: 24px;
            animation: slideDown 0.6s ease-out 0.2s both;
        }

        .logo-univ {
            height: 50px;
            width: auto;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        .login-title {
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--gray-500);
            line-height: 1.5;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
            position: relative;
            animation: slideUp 0.6s ease-out 0.4s both;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--lilac-600);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 14px;
            background: rgba(243, 232, 255, 0.5);
            border: 1.5px solid transparent;
            border-radius: 12px;
            font-size: 14px;
            color: var(--gray-800);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .form-control:focus {
            background: var(--white);
            border-color: var(--lilac-500);
            box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.15);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 42px;
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .password-toggle:hover { color: var(--lilac-600); }
        .password-toggle svg { width: 22px; height: 22px; }

        /* Button Redesign */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--lilac-600) 0%, #7e22ce 100%);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 16px;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px -5px rgba(126, 34, 206, 0.4);
            animation: slideUp 0.6s ease-out 0.6s both;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(126, 34, 206, 0.5);
            filter: brightness(1.05);
        }

        .btn-login:active { transform: translateY(0); }

        /* Error Alert */
        .error-alert {
            background: rgba(254, 226, 226, 0.9);
            color: #dc2626;
            padding: 14px 18px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(220, 38, 38, 0.2);
            animation: shake 0.5s ease-in-out;
        }

        /* Animations */
        @keyframes fadeInScale {
            0% { opacity: 0; transform: scale(0.95) translateY(20px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: rot 1s infinite linear;
            display: none;
        }
        @keyframes rot { to { transform: rotate(360deg); } }
        .loading .spinner { display: inline-block; }
        .loading .btn-text { display: none; }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <img src="{{ asset('images/logo-ibik.png') }}" alt="Logo IBIK" class="logo-univ">
                </div>
                <h1 class="login-title">Login Admin</h1>
                <p class="login-subtitle">Silakan masuk sebagai Admin untuk mengelola sistem.</p>
            </div>

            <form id="loginForm" action="{{ url('/admin/login') }}" method="POST">
                @csrf
                
                @if(session('error'))
                <div class="error-alert">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username admin" required value="{{ old('username') }}" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <svg id="eye" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg id="eye-off" style="display:none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>

                <button type="submit" class="btn-login" id="submitBtn">
                    <span class="btn-text">Masuk</span>
                    <div class="spinner"></div>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pwd = document.getElementById('password');
            const eye = document.getElementById('eye');
            const eyeOff = document.getElementById('eye-off');
            if(pwd.type === 'password') {
                pwd.type = 'text';
                eye.style.display = 'none';
                eyeOff.style.display = 'block';
            } else {
                pwd.type = 'password';
                eye.style.display = 'block';
                eyeOff.style.display = 'none';
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
    </script>
</body>
</html>
