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
            <p>Silakan masuk untuk melanjutkan</p>
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








{{-- <x-guest-layout>
    <!-- Session Status -->


    <!-- Email Address -->


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
            type="password"
            name="password"
            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<form method="POST" action="{{ route('login') }}"> --}}
