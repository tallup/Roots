@extends('supervisor.layouts.app')
@section('title', 'Supervisor Settings')
@section('content')
<style>
    .settings-card {
        max-width: 500px;
        margin: 40px auto;
        border-radius: 2rem;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        border: none;
    }
    .settings-header {
        background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
        color: #fff;
        border-radius: 2rem 2rem 0 0;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        text-align: center;
    }
    .settings-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .settings-section {
        padding: 2rem 2.5rem 2.5rem 2.5rem;
    }
    .form-label {
        font-weight: 600;
        color: #00796b;
    }
    .form-control {
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        color: #333;
        font-weight: 500;
    }
    .btn-gradient {
        background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
        color: #fff;
        border: none;
        font-weight: 600;
    }
</style>
<div class="container py-4">
    <div class="card settings-card">
        <div class="settings-header">
            <div class="settings-title">Change Password</div>
        </div>
        <div class="settings-section">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('supervisor.settings.update') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-gradient btn-lg px-5">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 