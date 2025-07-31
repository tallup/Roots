<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Login - ROOTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            padding: 40px 32px 32px 32px;
            max-width: 400px;
            width: 100%;
        }
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #00796b;
            margin-bottom: 24px;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
            font-size: 1.1rem;
        }
        .btn-primary {
            background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%);
            border: none;
            font-weight: 600;
            border-radius: 10px;
            font-size: 1.1rem;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #00bcd4 0%, #00796b 100%);
        }
        .input-group-text {
            background: #f4f8fb;
            border-radius: 10px 0 0 10px;
            color: #00bcd4;
            font-size: 1.2rem;
        }
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 18px;
        }
        .logo i {
            font-size: 2.5rem;
            color: #00bcd4;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <i class="fa fa-user-shield"></i>
        </div>
        <div class="login-title">Supervisor Login</div>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('supervisor.login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="Enter your email">
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
        </form>
        <div class="d-flex justify-content-between mt-3">
            <a href="#" class="text-decoration-none text-primary">Forgot Password?</a>
            <a href="/" class="text-decoration-none text-secondary">&larr; Back to Home</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 