@extends('admin.layouts.app')

@section('title', 'Review Training Performance - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-graduation-cap me-2"></i>
                            Review Training Performance
                        </h4>
                        <div>
                            <a href="{{ route('admin.training-performance') }}" class="btn btn-light me-2">
                                <i class="fa fa-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.training-performance.update', $training->train_Id) }}" method="POST" id="trainingForm">
                        @csrf
                        @method('POST')
                        
                        <!-- Basic Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-info-circle me-2"></i>Basic Information
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="train_Id" class="form-label">Record ID</label>
                                    <input type="text" class="form-control bg-light" id="train_Id" value="{{ $training->train_Id }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year *</label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                           id="year" name="year" value="{{ $training->year }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="proId" class="form-label">Quarter *</label>
                                    <input type="text" class="form-control @error('proId') is-invalid @enderror" 
                                           id="proId" name="proId" value="{{ $training->proId }}" required>
                                    @error('proId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="traId" class="form-label">Training Type *</label>
                                    <input type="text" class="form-control @error('traId') is-invalid @enderror" 
                                           id="traId" name="traId" value="{{ $training->traId }}" required>
                                    @error('traId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Component Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-project-diagram me-2"></i>Component Information
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="component_name" class="form-label">Component Name</label>
                                    <input type="text" class="form-control bg-light" id="component_name" value="{{ $training->component_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sub_name" class="form-label">Subcomponent Name</label>
                                    <input type="text" class="form-control bg-light" id="sub_name" value="{{ $training->sub_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="compId" class="form-label">Component ID *</label>
                                    <input type="text" class="form-control @error('compId') is-invalid @enderror" 
                                           id="compId" name="compId" value="{{ $training->compId }}" required>
                                    @error('compId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subId" class="form-label">Subcomponent ID *</label>
                                    <input type="text" class="form-control @error('subId') is-invalid @enderror" 
                                           id="subId" name="subId" value="{{ $training->subId }}" required>
                                    @error('subId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Stakeholders Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-users me-2"></i>Stakeholders
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="actorId" class="form-label">Actor Type *</label>
                                    <input type="text" class="form-control @error('actorId') is-invalid @enderror" 
                                           id="actorId" name="actorId" value="{{ $training->actorId }}" required>
                                    @error('actorId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="personId" class="form-label">Person *</label>
                                    <input type="text" class="form-control @error('personId') is-invalid @enderror" 
                                           id="personId" name="personId" value="{{ $training->personId }}" required>
                                    @error('personId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="venId" class="form-label">Venue *</label>
                                    <input type="text" class="form-control @error('venId') is-invalid @enderror" 
                                           id="venId" name="venId" value="{{ $training->venId }}" required>
                                    @error('venId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Training Details Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-graduation-cap me-2"></i>Training Details
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="train_desc" class="form-label">Training Description *</label>
                                    <textarea class="form-control @error('train_desc') is-invalid @enderror" 
                                              id="train_desc" name="train_desc" rows="3" required>{{ $training->train_desc }}</textarea>
                                    @error('train_desc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="cost" class="form-label">Training Cost *</label>
                                    <input type="number" step="0.01" class="form-control @error('cost') is-invalid @enderror" 
                                           id="cost" name="cost" value="{{ $training->cost }}" required>
                                    @error('cost')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="total_target" class="form-label">Total Targeted *</label>
                                    <input type="number" class="form-control @error('total_target') is-invalid @enderror" 
                                           id="total_target" name="total_target" value="{{ $training->total_target }}" required>
                                    @error('total_target')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="total_acheived" class="form-label">Total Achieved *</label>
                                    <input type="number" class="form-control @error('total_acheived') is-invalid @enderror" 
                                           id="total_acheived" name="total_acheived" value="{{ $training->total_acheived }}" required>
                                    @error('total_acheived')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Analysis & Recommendations Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-chart-line me-2"></i>Analysis & Recommendations
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="key_issue" class="form-label">Key Issues</label>
                                    <textarea class="form-control @error('key_issue') is-invalid @enderror" 
                                              id="key_issue" name="key_issue" rows="3">{{ $training->key_issue }}</textarea>
                                    @error('key_issue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="recommendation" class="form-label">Recommendations</label>
                                    <textarea class="form-control @error('recommendation') is-invalid @enderror" 
                                              id="recommendation" name="recommendation" rows="3">{{ $training->recommendation }}</textarea>
                                    @error('recommendation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="rmk" class="form-label">Remarks</label>
                                    <textarea class="form-control @error('rmk') is-invalid @enderror" 
                                              id="rmk" name="rmk" rows="3">{{ $training->rmk }}</textarea>
                                    @error('rmk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status & Actions Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-cogs me-2"></i>Status & Actions
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Current Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="Pending" {{ $training->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $training->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Rejected" {{ $training->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary" 
                                            style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border: none;">
                                        <i class="fa fa-save me-2"></i>Update Record
                                    </button>
                                    
                                    <div>
                                        <button type="button" class="btn btn-success me-2" onclick="approveTraining()"
                                                style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none;">
                                            <i class="fa fa-check me-2"></i>Approve
                                        </button>
                                        
                                        <button type="button" class="btn btn-danger me-2" onclick="rejectTraining()"
                                                style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%); border: none;">
                                            <i class="fa fa-times me-2"></i>Reject
                                        </button>
                                        
                                        <button type="button" class="btn btn-warning" onclick="deleteTraining()"
                                                style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); border: none;">
                                            <i class="fa fa-trash me-2"></i>Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function approveTraining() {
    if (confirm('Are you sure you want to approve this training performance record?')) {
        fetch(`{{ route('admin.training-performance.approve', $training->train_Id) }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("admin.training-performance") }}';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while approving the record.');
        });
    }
}

function rejectTraining() {
    if (confirm('Are you sure you want to reject this training performance record?')) {
        fetch(`{{ route('admin.training-performance.reject', $training->train_Id) }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("admin.training-performance") }}';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while rejecting the record.');
        });
    }
}

function deleteTraining() {
    if (confirm('Are you sure you want to delete this training performance record? This action cannot be undone.')) {
        fetch(`{{ route('admin.training-performance.delete', $training->train_Id) }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("admin.training-performance") }}';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the record.');
        });
    }
}
</script>
@endpush
@endsection 