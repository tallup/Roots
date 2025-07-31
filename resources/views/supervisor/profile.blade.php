@extends('supervisor.layouts.app')
@section('title', 'Supervisor Profile')
@section('content')
<style>
    .profile-card {
        max-width: 600px;
        margin: 40px auto;
        border-radius: 2rem;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        border: none;
    }
    .profile-header {
        background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
        color: #fff;
        border-radius: 2rem 2rem 0 0;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        text-align: center;
    }
    .profile-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        margin-bottom: 1rem;
        background: #e0f7fa;
        display: inline-block;
    }
    .profile-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .profile-section {
        padding: 2rem 2.5rem 2.5rem 2.5rem;
    }
    .form-label {
        font-weight: 600;
        color: #00796b;
    }
    .form-control[readonly] {
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        color: #333;
        font-weight: 500;
    }
</style>
<div class="container py-4">
    <div class="card profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fa fa-user fa-3x" style="color:#00bcd4;"></i>
            </div>
            <div class="profile-title">{{ $user->CompanyName ?? 'N/A' }}</div>
            <div>{{ $user->Email ?? 'N/A' }}</div>
        </div>
        <div class="profile-section">
            <form>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" value="{{ $user->ID ?? 'N/A' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Region</label>
                        <input type="text" class="form-control" value="{{ $user->region_name ?? 'N/A' }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" value="{{ $user->Address ?? 'N/A' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" value="{{ $user->Workphnumber ?? 'N/A' }}" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 