@extends('admin.layouts.app')

@section('title', 'Indicator Performance Review - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #218838 0%, #17a2b8 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-eye me-2"></i>
                            Indicator Performance Review
                        </h4>
                        <div>
                            <a href="{{ route('admin.indicator-performance') }}" class="btn btn-light me-2">
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
                    
                    <form action="{{ route('admin.indicator-performance.update', $performance->indicator_id) }}" method="POST">
                        @csrf
                        
                        <!-- Basic Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-info-circle me-2"></i>Basic Information
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="text" class="form-control" id="year" name="year" value="{{ $performance->year }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="quarter" class="form-label">Quarter</label>
                                    <input type="text" class="form-control" id="quarter" name="quarter" value="{{ $performance->proId }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="indicator_category" class="form-label">Indicator Category</label>
                                    <input type="text" class="form-control" id="indicator_category" name="indicator_category" value="{{ $performance->icat }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="freq_data_collection" class="form-label">Freq Data Collection</label>
                                    <input type="text" class="form-control" id="freq_data_collection" name="freq_data_collection" value="{{ $performance->data }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Indicator Details Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-chart-bar me-2"></i>Indicator Details
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="indicator_type" class="form-label">Indicator Type</label>
                                    <input type="text" class="form-control" id="indicator_type" name="indicator_type" value="{{ $performance->indicatorId }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unit_measurement" class="form-label">Unit Measurement</label>
                                    <input type="text" class="form-control" id="unit_measurement" name="unit_measurement" value="{{ $performance->measuId }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Indicator Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $performance->indicator_desc }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Target & Baseline Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-bullseye me-2"></i>Target & Baseline
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="baseline" class="form-label">Baseline</label>
                                    <input type="number" class="form-control" id="baseline" name="baseline" value="{{ $performance->baseline }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="target" class="form-label">Targeted Value</label>
                                    <input type="number" class="form-control" id="target" name="target" value="{{ $performance->target }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="achieved" class="form-label">Target Achieved</label>
                                    <input type="number" class="form-control" id="achieved" name="achieved" value="{{ $performance->acheived }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="achievement_percentage" class="form-label">% Achievement</label>
                                    <input type="number" step="0.01" class="form-control" id="achievement_percentage" name="achievement_percentage" value="{{ $performance->acheivement }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Pending" {{ $performance->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $performance->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Rejected" {{ $performance->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Breakdown & Analysis Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-chart-line me-2"></i>Breakdown & Analysis
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="breakdown_plan" class="form-label">Indicator Breakdown Plan</label>
                                    <textarea class="form-control" id="breakdown_plan" name="breakdown_plan" rows="3">{{ $performance->commentAc }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="breakdown_achieved" class="form-label">Indicator Breakdown Achieved</label>
                                    <textarea class="form-control" id="breakdown_achieved" name="breakdown_achieved" rows="3">{{ $performance->comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="3">{{ $performance->rmk }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn" style="background: linear-gradient(90deg, #218838 0%, #17a2b8 100%); color: #fff; border: none;">
                                        <i class="fa fa-save me-1"></i>Update Record
                                    </button>
                                    
                                    <div>
                                        @if($performance->status !== 'Approved')
                                        <button type="button" class="btn me-2 approve-btn" data-id="{{ $performance->indicator_id }}" style="background: linear-gradient(90deg, #28a745 0%, #20c997 100%); color: #fff; border: none;">
                                            <i class="fa fa-check me-1"></i>Approve
                                        </button>
                                        @endif
                                        
                                        <button type="button" class="btn delete-btn" data-id="{{ $performance->indicator_id }}" style="background: linear-gradient(90deg, #dc3545 0%, #fd7e14 100%); color: #fff; border: none;">
                                            <i class="fa fa-trash me-1"></i>Delete
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Approve button functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.approve-btn')) {
            const button = e.target.closest('.approve-btn');
            const id = button.getAttribute('data-id');
            
            if (confirm('Are you sure you want to approve this record?')) {
                fetch(`/admin/indicator-performance/${id}/approve`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Record approved successfully!');
                        window.location.href = '{{ route("admin.indicator-performance") }}';
                    } else {
                        alert('Error approving record: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error approving record!');
                });
            }
        }
    });
    
    // Delete button functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            const button = e.target.closest('.delete-btn');
            const id = button.getAttribute('data-id');
            
            if (confirm('Are you sure you want to delete this record?')) {
                fetch(`/admin/indicator-performance/${id}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Record deleted successfully!');
                        window.location.href = '{{ route("admin.indicator-performance") }}';
                    } else {
                        alert('Error deleting record: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting record!');
                });
            }
        }
    });
});
</script>
@endpush
@endsection 