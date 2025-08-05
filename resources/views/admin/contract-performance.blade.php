@extends('admin.layouts.app')

@section('title', 'Contract/MOU Performance Tracking - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-file-contract me-2"></i>
                            Contract/MOU Performance Tracking
                        </h4>
                        <div>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light me-2">
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

                    <div class="table-responsive">
                        <table id="contractPerformanceTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Year</th>
                                    <th>Quarter</th>
                                    <th>Contract/MOU</th>
                                    <th>Component</th>
                                    <th>Subcomponent</th>
                                    <th>Actor</th>
                                    <th>Intervention</th>
                                    <th>Contract Type</th>
                                    <th>Cost</th>
                                    <th>Key Issues</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $index => $contract)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge bg-{{ $contract->status === 'Approved' ? 'success' : ($contract->status === 'Rejected' ? 'danger' : 'warning') }}">
                                                {{ $contract->status }}
                                            </span>
                                        </td>
                                        <td>{{ $contract->year }}</td>
                                        <td>{{ $contract->proId }}</td>
                                        <td>{{ $contract->name }}</td>
                                        <td>{{ $contract->component_name }}</td>
                                        <td>{{ $contract->sub_name }}</td>
                                        <td>{{ $contract->actorId }}</td>
                                        <td>{{ $contract->intervenId }}</td>
                                        <td>{{ $contract->ctyId }}</td>
                                        <td>{{ number_format($contract->cost, 2) }}</td>
                                        <td>{{ Str::limit($contract->key_issue, 50) }}</td>
                                        <td>
                                            <a href="{{ route('admin.contract-performance.review', $contract->conId) }}" 
                                               class="btn btn-info btn-sm" 
                                               title="Review">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#contractPerformanceTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[0, 'asc']],
        columnDefs: [
            { targets: [12], orderable: false },
            { targets: [11], orderable: false }
        ]
    });
});
</script>
@endpush
@endsection 