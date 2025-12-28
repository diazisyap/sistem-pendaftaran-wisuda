<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Pendaftaran Wisuda</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px; 
            padding: 2rem;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header h4 {
            color: var(--primary-green);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .login-header p {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: var(--secondary-green);
            box-shadow: 0 0 0 0.2rem rgba(13, 132, 124, 0.25);
        }
        .btn-login {
            background-color: var(--primary-green);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            width: 100%;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color: var(--secondary-green);
            color: white;
        }
        .footer-note {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #6c757d;
        }
        .footer-note a {
            color: var(--secondary-green);
            text-decoration: none;
            font-weight: 600;
        }
        .footer-note a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="mb-3">
                <i class="fas fa-graduation-cap fa-3x" style="color: var(--primary-green);"></i>
            </div>
            <h4>Buat Akun Baru</h4>
            <p>Sistem Pendaftaran Wisuda</p>
        </div>

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label visually-hidden">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" id="name" name="name" placeholder="Nama Lengkap" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label visually-hidden">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" placeholder="Email Address" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label visually-hidden">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Password" required>
                </div>
            </div>
            
             <div class="mb-3">
                <label for="password_confirmation" class="form-label visually-hidden">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                Daftar
            </button>
        </form>

        <div class="footer-note">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
