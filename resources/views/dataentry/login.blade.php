<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); min-height: 100vh; }
        .login-card { max-width: 400px; margin: 60px auto; border-radius: 1.25rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .login-header { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0; padding: 1.5rem; text-align: center; }
        .login-title { color: #fff; font-size: 1.5rem; font-weight: bold; }
        .login-subtitle { color: #e0f7fa; font-size: 1rem; }
        .btn-login { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; border: none; width: 100%; }
        .forgot-password, .back-to-home { color: #00796b; text-decoration: underline; margin: 0 0.5rem; }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="card login-card">
        <div class="login-header">
            <h1 class="login-title">Data Entry</h1>
            <p class="login-subtitle">ROOTS M&E System</p>
        </div>
        <div class="login-body p-4">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            <form method="POST" action="{{ route('dataentry.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            required
                            autofocus>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-login">
                        <i class="fa fa-sign-in-alt me-2"></i>Login
                    </button>
                </div>
                <div class="text-center">
                    <a href="{{ route('dataentry.reset-password') }}" class="forgot-password">
                        <i class="fa fa-key me-1"></i>Forgot Password?
                    </a>
                </div>
            </form>
            <hr class="my-4">
            <div class="text-center">
                <a href="{{ route('home') }}" class="back-to-home">
                    <i class="fa fa-arrow-left me-1"></i>Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>