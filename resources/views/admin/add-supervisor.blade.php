<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supervisor - ROOTS</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    
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
        .add-supervisor-container {
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
    <div class="add-supervisor-container">
        <h2 class="form-title">Add Supervisor</h2>
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
        <form method="POST" action="{{ route('admin.add-supervisor.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="CompanyName" class="form-label">Company/Organization Name</label>
                        <input type="text" class="form-control" id="CompanyName" name="CompanyName" value="{{ old('CompanyName') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="region_name" class="form-label">Region</label>
                        <select class="form-control" id="region_name" name="region_name" required>
                            <option value="">Select Region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->region_name }}" {{ old('region_name') == $region->region_name ? 'selected' : '' }}>
                                    {{ $region->region_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Workphnumber" class="form-label">Work Phone Number</label>
                        <input type="text" class="form-control" id="Workphnumber" name="Workphnumber" value="{{ old('Workphnumber') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email" value="{{ old('Email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="Password" name="Password" required>
                            <button type="button" class="btn btn-link position-absolute end-0 top-0 h-100" onclick="togglePassword('Password')" style="z-index: 10;">
                                <i class="fa fa-eye" id="Password-icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Password_confirmation" class="form-label">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="Password_confirmation" name="Password_confirmation" required>
                            <button type="button" class="btn btn-link position-absolute end-0 top-0 h-100" onclick="togglePassword('Password_confirmation')" style="z-index: 10;">
                                <i class="fa fa-eye" id="Password_confirmation-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="Address" class="form-label">Address</label>
                        <textarea class="form-control" id="Address" name="Address" rows="3">{{ old('Address') }}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Supervisor</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
</body>
</html> 