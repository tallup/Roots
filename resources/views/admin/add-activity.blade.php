<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Activity - ROOTS</title>
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
        .add-activity-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            padding: 40px 30px;
            margin: 40px auto;
            max-width: 600px;
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
    <div class="add-activity-container">
        <h2 class="form-title">Add Activity</h2>
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
        <form method="POST" action="{{ route('admin.add-activity.store') }}">
            @csrf
            <div class="mb-3">
                <label for="activity_name" class="form-label">Activity Name</label>
                <input type="text" class="form-control" id="activity_name" name="activity_name" 
                       value="{{ old('activity_name') }}" placeholder="Enter activity name" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">Add Activity</button>
                <a href="{{ route('admin.activities') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 