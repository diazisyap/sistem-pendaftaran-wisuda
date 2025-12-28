<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pendaftaran Wisuda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --primary-green: #0b3c39;
            --secondary-green: #0d847c;
            --accent-orange: #ffc107;
            --light-bg: #f8f9fa;
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', 'Roboto', 'Helvetica', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            position: relative;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header h4 {
            color: var(--primary-green);
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }
        .login-header p {
            color: #8898aa;
            font-size: 0.95rem;
        }
        .form-control, .input-group-text {
            border-color: #e9ecef;
            background-color: #fff;
        }
        .input-group-text {
            border-right: none;
            padding-left: 1rem;
        }
        .form-control {
            border-left: none;
            border-right: none; 
            padding: 0.75rem 0.5rem;
            font-size: 0.95rem;
            color: var(--primary-green);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: var(--secondary-green);
        }
        .form-control:focus + .input-group-text, 
        .input-group:focus-within .input-group-text {
            border-color: var(--secondary-green);
        }
        .input-group:focus-within .text-muted {
            color: var(--secondary-green) !important;
        }
        
        
        .input-group .input-group-text:last-child {
            border-left: none;
            border-right: 1px solid #e9ecef;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
            cursor: pointer;
            padding-right: 1rem;
        }
       
        .input-group .input-group-text:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }
        
        .input-group .form-control:not(:last-child) {
             border-top-right-radius: 0;
             border-bottom-right-radius: 0;
        }

        
        .input-group:focus-within .input-group-text:first-child {
             border-color: var(--secondary-green);
        }
        .input-group:focus-within .input-group-text:last-child {
             border-color: var(--secondary-green);
        }

        .btn-login {
            background: linear-gradient(to right, var(--primary-green), var(--secondary-green));
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.85rem;
            font-weight: 700;
            width: 100%;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 6px rgba(11, 60, 57, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 1rem;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(11, 60, 57, 0.25);
            color: white;
        }
        
        .btn-google {
            background-color: white;
            color: #333;
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #d3d6d8;
            transform: translateY(-1px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #adb5bd;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e9ecef;
        }
        .divider:not(:empty)::before { margin-right: 1em; }
        .divider:not(:empty)::after { margin-left: 1em; }
        
        .footer-note {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .footer-note a {
            color: var(--secondary-green);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }
        .footer-note a:hover {
            color: var(--primary-green);
            text-decoration: underline;
        }
        .form-check-input:checked {
            background-color: var(--secondary-green);
            border-color: var(--secondary-green);
        }
        
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="mb-4">
                <div style="background: rgba(13, 132, 124, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="fas fa-graduation-cap fa-3x" style="color: var(--secondary-green);"></i>
                </div>
            </div>
            <h4>Login</h4>
            <p>Sistem Pendaftaran Wisuda</p>
        </div>

        @if(session('error'))
        <div class="alert alert-danger text-center shadow-sm border-0" role="alert" style="font-size: 0.9rem; border-radius: 8px;">
            {{ session('error') }}
        </div>
        @endif
        

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" class="form-control border-end-1" style="border-right: 1px solid #e9ecef; border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem;" id="email" name="email" placeholder="Email Address" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye text-muted" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label text-secondary small" for="remember">
                        Ingat Saya
                    </label>
                </div>
                <a href="#" class="small text-decoration-none fw-semibold" style="color: var(--secondary-green);">Lupa password?</a>
            </div>

            <button type="submit" class="btn btn-login">
                MASUK SEKARANG
            </button>
        </form>

        <div class="divider">atau</div>

        <button class="btn btn-google">
            <img src="https://www.google.com/favicon.ico" alt="Google" width="18">
            Masuk dengan Google
        </button>

        <div class="footer-note">
            Belum punya akun? <a href="{{ route('register') }}">Buat Akun</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
