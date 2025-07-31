<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contractor - ROOTS</title>
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
        .edit-contractor-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            padding: 40px 30px;
            margin: 40px auto;
            max-width: 600px;
        }
        .page-title {
            color: #00796b;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-label {
            color: #00796b;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #00bcd4;
            box-shadow: 0 0 0 0.2rem rgba(0,188,212,.15);
        }
        .btn-primary {
            background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%);
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 30px;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #00bcd4 0%, #00796b 100%);
        }
        .btn-secondary {
            background: linear-gradient(90deg, #6c757d 0%, #495057 100%);
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 30px;
        }
        .btn-secondary:hover {
            background: linear-gradient(90deg, #495057 0%, #6c757d 100%);
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
    </style>
</head>
<body>
@include('admin.partials.sidebar')
<div class="main-content-fixed">
    <div class="edit-contractor-container">
        <h2 class="page-title">Edit Contractor</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.edit-contractor.update', $contractor->contractorId) }}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            
            <div class="mb-4">
                <label for="contractorName" class="form-label">Contractor Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('contractorName') is-invalid @enderror" 
                       id="contractorName" name="contractorName" value="{{ old('contractorName', $contractor->contractorName) }}" 
                       placeholder="Enter contractor name" required>
                @error('contractorName')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                       id="contact" name="contact" value="{{ old('contact', $contractor->contact) }}" 
                       placeholder="Enter contact information" required>
                @error('contact')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                       id="address" name="address" value="{{ old('address', $contractor->address) }}" 
                       placeholder="Enter address" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="actorId" class="form-label">Implementing Partners <span class="text-danger">*</span></label>
                <select class="form-select @error('actorId') is-invalid @enderror" 
                        id="actorId" name="actorId" required>
                    <option value="">Select Implementing Partners</option>
                    @foreach($actors as $actor)
                        <option value="{{ $actor->Actor_name }}" 
                                {{ old('actorId', $contractor->actorId) == $actor->Actor_name ? 'selected' : '' }}>
                            {{ $actor->Actor_name }}
                        </option>
                    @endforeach
                </select>
                @error('actorId')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3 justify-content-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-2"></i>Update Contractor
                </button>
                <a href="{{ route('admin.contractors') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 