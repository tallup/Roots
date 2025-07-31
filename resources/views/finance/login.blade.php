<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); min-height: 100vh; }
        .login-card { max-width: 400px; margin: 60px auto; border-radius: 1.25rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .login-header { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0; padding: 1.5rem; text-align: center; }
        .login-title { color: #fff; font-size: 1.5rem; font-weight: bold; }
        .btn-gradient { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; border: none; }
        .login-links { margin-top: 1.5rem; text-align: center; }
        .login-links a { color: #00796b; text-decoration: underline; margin: 0 0.5rem; }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="card login-card">
        <div class="login-header">
            <div class="login-title">Finance Login</div>
        </div>
        <div class="login-section p-4">
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('finance.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-gradient btn-lg px-5">Login</button>
                </div>
            </form>
            <div class="login-links">
                <a href="#">Forgot Password?</a> |
                <a href="/">Back to Home</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>