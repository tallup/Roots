@extends('admin.layouts.app')

@section('title', 'Disbursement Performance Review - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #218838 0%, #17a2b8 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-eye me-2"></i>
                            Disbursement Performance Review
                        </h4>
                        <div>
                            <a href="{{ route('admin.disbursement-performance') }}" class="btn btn-light me-2">
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
                    
                    <form action="{{ route('admin.disbursement-performance.update', $performance->disburs_id) }}" method="POST">
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
                                    <label for="record_id" class="form-label">Record ID</label>
                                    <input type="text" class="form-control bg-light" id="record_id" value="{{ $performance->disburs_id }}" readonly>
                                </div>
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
                                    <input type="text" class="form-control" id="quarter" name="quarter" value="{{ $performance->quarter }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="disburs_source" class="form-label">Disbursement Source</label>
                                    <input type="text" class="form-control" id="disburs_source" name="disburs_source" value="{{ $performance->disburs_source }}" required>
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
                                    <input type="text" class="form-control bg-light" id="component_name" value="{{ $performance->component_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sub_name" class="form-label">Subcomponent Name</label>
                                    <input type="text" class="form-control bg-light" id="sub_name" value="{{ $performance->sub_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="comp_id" class="form-label">Component ID</label>
                                    <input type="text" class="form-control" id="comp_id" name="comp_id" value="{{ $performance->comp_id }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subcomp" class="form-label">Subcomponent ID</label>
                                    <input type="text" class="form-control" id="subcomp" name="subcomp" value="{{ $performance->subcomp }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-money-bill me-2"></i>Financial Information
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="querter_taeget" class="form-label">Quarter Target</label>
                                    <input type="number" step="0.01" class="form-control" id="querter_taeget" name="querter_taeget" value="{{ $performance->querter_taeget }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="actual" class="form-label">Actual</label>
                                    <input type="number" step="0.01" class="form-control" id="actual" name="actual" value="{{ $performance->actual }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="commit" class="form-label">Commitment</label>
                                    <input type="number" step="0.01" class="form-control" id="commit" name="commit" value="{{ $performance->commit }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="perfor" class="form-label">Performance</label>
                                    <input type="number" step="0.01" class="form-control" id="perfor" name="perfor" value="{{ $performance->perfor }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="execu" class="form-label">Execution (%)</label>
                                    <input type="number" step="0.01" class="form-control" id="execu" name="execu" value="{{ $performance->execu }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Status Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-clipboard-check me-2"></i>Status & Review
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="current_status" class="form-label">Current Status</label>
                                    <input type="text" class="form-control bg-light" id="current_status" value="{{ $performance->admstatus ?? 'pending' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Change Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Pending" {{ ($performance->admstatus ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ ($performance->admstatus ?? 'pending') === 'approve' ? 'selected' : '' }}>Approved</option>
                                        <option value="Rejected" {{ ($performance->admstatus ?? 'pending') === 'reject' ? 'selected' : '' }}>Rejected</option>
                                    </select>
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
                                        @if($performance->admstatus !== 'approve')
                                        <button type="button" class="btn me-2 approve-btn" data-id="{{ $performance->disburs_id }}" style="background: linear-gradient(90deg, #28a745 0%, #20c997 100%); color: #fff; border: none;">
                                            <i class="fa fa-check me-1"></i>Approve
                                        </button>
                                        @endif
                                        
                                        @if($performance->admstatus !== 'reject')
                                        <button type="button" class="btn me-2 reject-btn" data-id="{{ $performance->disburs_id }}" style="background: linear-gradient(90deg, #dc3545 0%, #fd7e14 100%); color: #fff; border: none;">
                                            <i class="fa fa-times me-1"></i>Reject
                                        </button>
                                        @endif
                                        
                                        <button type="button" class="btn delete-btn" data-id="{{ $performance->disburs_id }}" style="background: linear-gradient(90deg, #6c757d 0%, #495057 100%); color: #fff; border: none;">
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
                fetch(`/admin/disbursement-performance/${id}/approve`, {
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
                        window.location.href = '{{ route("admin.disbursement-performance") }}';
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
    
    // Reject button functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.reject-btn')) {
            const button = e.target.closest('.reject-btn');
            const id = button.getAttribute('data-id');
            
            if (confirm('Are you sure you want to reject this record?')) {
                fetch(`/admin/disbursement-performance/${id}/reject`, {
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
                        alert('Record rejected successfully!');
                        window.location.href = '{{ route("admin.disbursement-performance") }}';
                    } else {
                        alert('Error rejecting record: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error rejecting record!');
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
                fetch(`/admin/disbursement-performance/${id}/delete`, {
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
                        window.location.href = '{{ route("admin.disbursement-performance") }}';
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