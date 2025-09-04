<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Sistem Bapenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #2a5298, #252050,#4284ff);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h3 {
            font-weight: 700;
            color: #2a5298;
        }

        .login-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }

        .form-floating label {
            color: #666;
        }

        .btn-login {
            background: #2a5298;
            border: none;
            padding: 0.8rem;
            border-radius: 10px;
            font-weight: 600;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(42, 82, 152, 0.4);
        }

        .footer-text {
            margin-top: 1.5rem;
            font-size: 0.85rem;
            text-align: center;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <h3>Login</h3>
            <p>Please sign in to continue</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <div class="form-floating mb-3">
                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="Email"
                    value="{{ old('email') }}" required autocomplete="current-email" />
                <label for="inputEmail"><i class="fas fa-envelope me-2 text-primary"></i>Email</label>
            </div>

            <div class="form-floating mb-4">
                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                <label for="inputPassword"><i class="fas fa-lock me-2 text-primary"></i>Password</label>
            </div>

            <div class="d-grid">
                <button class="btn btn-login" type="submit">Login</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
