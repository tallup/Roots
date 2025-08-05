@extends('admin.layouts.app')

@section('title', 'Review Contract/MOU Performance - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-file-contract me-2"></i>
                            Review Contract/MOU Performance
                        </h4>
                        <div>
                            <a href="{{ route('admin.contract-performance') }}" class="btn btn-light me-2">
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

            <form action="{{ route('admin.contract-performance.update', $contract->conId) }}" method="POST" id="contractForm">
                @csrf
                @method('POST')
                
                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-md-6">
                        <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                            <i class="fa fa-info-circle me-2"></i>Basic Information
                        </h5>
                        
                        <div class="mb-3">
                            <label for="conId" class="form-label">Record ID</label>
                            <input type="text" class="form-control" id="conId" value="{{ $contract->conId }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Year *</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                   id="year" name="year" value="{{ $contract->year }}" required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proId" class="form-label">Quarter *</label>
                            <input type="text" class="form-control @error('proId') is-invalid @enderror" 
                                   id="proId" name="proId" value="{{ $contract->proId }}" required>
                            @error('proId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Contract/MOU Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ $contract->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Project Details -->
                    <div class="col-md-6">
                        <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                            <i class="fa fa-project-diagram me-2"></i>Project Details
                        </h5>
                        
                        <div class="mb-3">
                            <label for="compId" class="form-label">Component *</label>
                            <input type="text" class="form-control @error('compId') is-invalid @enderror" 
                                   id="compId" name="compId" value="{{ $contract->compId }}" required>
                            @error('compId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subId" class="form-label">Subcomponent *</label>
                            <input type="text" class="form-control @error('subId') is-invalid @enderror" 
                                   id="subId" name="subId" value="{{ $contract->subId }}" required>
                            @error('subId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="intervenId" class="form-label">Intervention *</label>
                            <input type="text" class="form-control @error('intervenId') is-invalid @enderror" 
                                   id="intervenId" name="intervenId" value="{{ $contract->intervenId }}" required>
                            @error('intervenId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Stakeholders -->
                    <div class="col-md-6">
                        <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                            <i class="fa fa-users me-2"></i>Stakeholders
                        </h5>
                        
                        <div class="mb-3">
                            <label for="actorId" class="form-label">Actor *</label>
                            <input type="text" class="form-control @error('actorId') is-invalid @enderror" 
                                   id="actorId" name="actorId" value="{{ $contract->actorId }}" required>
                            @error('actorId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="personId" class="form-label">Person *</label>
                            <input type="text" class="form-control @error('personId') is-invalid @enderror" 
                                   id="personId" name="personId" value="{{ $contract->personId }}" required>
                            @error('personId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Contract Details -->
                    <div class="col-md-6">
                        <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                            <i class="fa fa-file-contract me-2"></i>Contract Details
                        </h5>
                        
                        <div class="mb-3">
                            <label for="ctyId" class="form-label">Contract Type *</label>
                            <input type="text" class="form-control @error('ctyId') is-invalid @enderror" 
                                   id="ctyId" name="ctyId" value="{{ $contract->ctyId }}" required>
                            @error('ctyId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stuId" class="form-label">Status ID *</label>
                            <input type="number" class="form-control @error('stuId') is-invalid @enderror" 
                                   id="stuId" name="stuId" value="{{ $contract->stuId }}" required>
                            @error('stuId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cost" class="form-label">Cost *</label>
                            <input type="number" step="0.01" class="form-control @error('cost') is-invalid @enderror" 
                                   id="cost" name="cost" value="{{ $contract->cost }}" required>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Analysis -->
                    <div class="col-md-12">
                        <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                            <i class="fa fa-chart-line me-2"></i>Analysis & Recommendations
                        </h5>
                        
                        <div class="mb-3">
                            <label for="key_issue" class="form-label">Key Issues *</label>
                            <textarea class="form-control @error('key_issue') is-invalid @enderror" 
                                      id="key_issue" name="key_issue" rows="3" required>{{ $contract->key_issue }}</textarea>
                            @error('key_issue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="recommendation" class="form-label">Recommendations *</label>
                            <textarea class="form-control @error('recommendation') is-invalid @enderror" 
                                      id="recommendation" name="recommendation" rows="3" required>{{ $contract->recommendation }}</textarea>
                            @error('recommendation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Status & Actions -->
                    <div class="col-md-12">
                        <h5 class="section-title mb-3" style="color: #00796b; font-weight: 600; border-bottom: 2px solid #00bcd4; padding-bottom: 8px; margin-bottom: 20px;">
                            <i class="fa fa-cogs me-2"></i>Status & Actions
                        </h5>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Current Status *</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="Pending" {{ $contract->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ $contract->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ $contract->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
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
                                <button type="button" class="btn btn-success me-2" onclick="approveContract()"
                                        style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none;">
                                    <i class="fa fa-check me-2"></i>Approve
                                </button>
                                
                                <button type="button" class="btn btn-danger me-2" onclick="rejectContract()"
                                        style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%); border: none;">
                                    <i class="fa fa-times me-2"></i>Reject
                                </button>
                                
                                <button type="button" class="btn btn-warning" onclick="deleteContract()"
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

<script>
function approveContract() {
    if (confirm('Are you sure you want to approve this contract performance record?')) {
        fetch('{{ route("admin.contract-performance.approve", $contract->conId) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Contract performance approved successfully!');
                window.location.href = '{{ route("admin.contract-performance") }}';
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

function rejectContract() {
    if (confirm('Are you sure you want to reject this contract performance record?')) {
        fetch('{{ route("admin.contract-performance.reject", $contract->conId) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Contract performance rejected successfully!');
                window.location.href = '{{ route("admin.contract-performance") }}';
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

function deleteContract() {
    if (confirm('Are you sure you want to delete this contract performance record? This action cannot be undone.')) {
        fetch('{{ route("admin.contract-performance.delete", $contract->conId) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Contract performance deleted successfully!');
                window.location.href = '{{ route("admin.contract-performance") }}';
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
@endsection 