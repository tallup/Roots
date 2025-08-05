@extends('admin.layouts.app')

@section('title', 'Beneficiary Performance Review - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #218838 0%, #17a2b8 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-eye me-2"></i>
                            Beneficiary Performance Review
                        </h4>
                        <div>
                            <a href="{{ route('admin.beneficiary-performance') }}" class="btn btn-light me-2">
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
                    
                    <form action="{{ route('admin.beneficiary-performance.update', $performance->profile_id) }}" method="POST">
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
                                    <input type="text" class="form-control bg-light" id="record_id" value="{{ $performance->profile_id }}" readonly>
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
                                    <input type="text" class="form-control" id="quarter" name="quarter" value="{{ $performance->quarter_name ?? $performance->proid }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="region" class="form-label">Region</label>
                                    <input type="text" class="form-control" id="region" name="region" value="{{ $performance->region_name ?? $performance->regid }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Project Details Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-project-diagram me-2"></i>Project Details
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="activity" class="form-label">Activity</label>
                                    <textarea class="form-control" id="activity" name="activity" rows="3" required>{{ $performance->activity }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="intervention" class="form-label">Intervention</label>
                                    <textarea class="form-control" id="intervention" name="intervention" rows="3" required>{{ $performance->intervenid ?? $performance->comp }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="component_name" class="form-label">Component</label>
                                    <input type="text" class="form-control bg-light" id="component_name" value="{{ $performance->component_name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sub_name" class="form-label">Sub Component</label>
                                    <input type="text" class="form-control bg-light" id="sub_name" value="{{ $performance->sub_name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="indicator_type" class="form-label">Indicator Type</label>
                                    <input type="text" class="form-control bg-light" id="indicator_type" value="{{ $performance->indicator_type ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Indicator Description</label>
                                    <textarea class="form-control bg-light" id="description" rows="3" readonly>{{ $performance->description ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Beneficiary Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-users me-2"></i>Beneficiary Information
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="beneficiary" class="form-label">Beneficiary Type</label>
                                    <input type="text" class="form-control" id="beneficiary" name="beneficiary" value="{{ $performance->beneficiary_name ?? $performance->benid }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="total_ben" class="form-label">Total Beneficiaries</label>
                                    <input type="number" class="form-control" id="total_ben" name="total_ben" value="{{ $performance->beneficiary_no }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="male" class="form-label">Male</label>
                                    <input type="number" class="form-control" id="male" name="male" value="{{ $performance->male ?? 0 }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="female" class="form-label">Female</label>
                                    <input type="number" class="form-control" id="female" name="female" value="{{ $performance->female }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pwd" class="form-label">PWD (Persons With Disabilities)</label>
                                    <input type="number" class="form-control" id="pwd" name="pwd" value="{{ $performance->npwd }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="youth" class="form-label">Youth</label>
                                    <input type="number" class="form-control" id="youth" name="youth" value="{{ $performance->nyouth }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Location & Contact Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-map-marker me-2"></i>Location & Contact
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="town_village" class="form-label">Town/Village</label>
                                    <input type="text" class="form-control" id="town_village" name="town_village" value="{{ $performance->community }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact Person & Phone#</label>
                                    <input type="text" class="form-control bg-light" id="contact" value="{{ $performance->contact ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <input type="text" class="form-control bg-light" id="remarks" value="{{ $performance->rmk ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Status & Review Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                                    <i class="fa fa-clipboard-check me-2"></i>Status & Review
                                </h5>
                            </div>
                                                                                      <div class="col-md-4">
                                 <div class="mb-3">
                                     <label for="current_status" class="form-label">Supervisor Status</label>
                                     <input type="text" class="form-control bg-light" id="status" value="{{ $performance->status ?? 'Approved' }}" readonly>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="mb-3">
                                     <label for="admstatus" class="form-label">Admin Status</label>
                                     <input type="text" class="form-control bg-light" id="admstatus" value="{{ $performance->admstatus ?? '' }}" readonly>
                                 </div>
                             </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Change Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Pending" {{ $performance->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $performance->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Rejected" {{ $performance->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="sup_revw" class="form-label">Supervisor Review</label>
                                    <textarea class="form-control bg-light" id="sup_revw" rows="3" readonly>{{ $performance->sup_revw ?? '' }}</textarea>
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
                                        <button type="button" class="btn me-2 approve-btn" data-id="{{ $performance->profile_id }}" style="background: linear-gradient(90deg, #28a745 0%, #20c997 100%); color: #fff; border: none;">
                                            <i class="fa fa-check me-1"></i>Approve
                                        </button>
                                        @endif
                                        
                                        @if($performance->admstatus !== 'reject')
                                        <button type="button" class="btn me-2 reject-btn" data-id="{{ $performance->profile_id }}" style="background: linear-gradient(90deg, #dc3545 0%, #fd7e14 100%); color: #fff; border: none;">
                                            <i class="fa fa-times me-1"></i>Reject
                                        </button>
                                        @endif
                                        
                                        <button type="button" class="btn delete-btn" data-id="{{ $performance->profile_id }}" style="background: linear-gradient(90deg, #6c757d 0%, #495057 100%); color: #fff; border: none;">
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
                fetch(`/admin/beneficiary-performance/${id}/approve`, {
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
                        window.location.href = '{{ route("admin.beneficiary-performance") }}';
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
                fetch(`/admin/beneficiary-performance/${id}/reject`, {
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
                        window.location.href = '{{ route("admin.beneficiary-performance") }}';
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
                fetch(`/admin/beneficiary-performance/${id}/delete`, {
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
                        window.location.href = '{{ route("admin.beneficiary-performance") }}';
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