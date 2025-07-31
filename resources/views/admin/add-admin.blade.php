<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin - ROOTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f8fb;
            font-family: 'PT Sans', sans-serif;
        }
        .main-content-fixed {
            margin-left: 260px;
            padding: 40px 30px;
        }
        @media (max-width: 991px) {
            .main-content-fixed {
                margin-left: 0;
                padding: 20px 5px;
            }
        }
        .add-admin-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            padding: 40px 30px;
            margin: 40px auto;
            max-width: 800px;
        }
        .form-label {
            font-weight: 600;
            color: #00796b;
        }
        .btn-primary {
            background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%);
            border: none;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #00bcd4 0%, #00796b 100%);
        }
        .form-control:focus {
            border-color: #00bcd4;
            box-shadow: 0 0 0 0.2rem rgba(0,188,212,.15);
        }
        .form-title {
            color: #00796b;
            font-weight: 700;
            margin-bottom: 24px;
            text-align: center;
        }
    </style>
</head>
<body>
@include('admin.partials.sidebar')
<div class="main-content-fixed">
    <div class="add-admin-container">
        <h2 class="form-title">Add Admin User</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.add-admin.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="AdminName" class="form-label">Admin Name</label>
                        <input type="text" class="form-control" id="AdminName" name="AdminName" value="{{ old('AdminName') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="UserName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="UserName" name="UserName" value="{{ old('UserName') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email" value="{{ old('Email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="MobileNumber" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" value="{{ old('MobileNumber') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="Password_confirmation" name="Password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="acc_type" class="form-label">Account Type</label>
                        <select class="form-control" id="acc_type" name="acc_type" required>
                            <option value="">Select Type</option>
                            <option value="admin" {{ old('acc_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super_admin" {{ old('acc_type') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Admin</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 