@extends('admin.layouts.app')

@section('title', 'Disbursement Performance Tracking - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #218838 0%, #17a2b8 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-money-bill me-2"></i>
                            Disbursement Performance Tracking
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
                        <table id="disbursementPerformanceTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Year</th>
                                    <th>Quarter</th>
                                    <th>Source</th>
                                    <th>Component Name</th>
                                    <th>Subcomponent Name</th>
                                    <th>Quarter Target</th>
                                    <th>Actual</th>
                                    <th>Commitment</th>
                                    <th>Performance</th>
                                    <th>Execution (%)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disbursementPerformances as $index => $performance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge bg-{{ $performance->admstatus === 'approve' ? 'success' : ($performance->admstatus === 'pending' ? 'warning' : 'danger') }}">
                                                {{ $performance->admstatus ?? 'pending' }}
                                            </span>
                                        </td>
                                        <td>{{ $performance->year }}</td>
                                        <td>{{ $performance->quarter }}</td>
                                        <td>{{ $performance->disburs_source }}</td>
                                        <td>{{ $performance->component_name }}</td>
                                        <td>{{ $performance->sub_name }}</td>
                                        <td>{{ number_format($performance->querter_taeget, 2) }}</td>
                                        <td>{{ number_format($performance->actual, 2) }}</td>
                                        <td>{{ number_format($performance->commit, 2) }}</td>
                                        <td>{{ number_format($performance->perfor, 2) }}</td>
                                        <td>{{ number_format($performance->execu, 2) }}%</td>
                                        <td>
                                            <a href="{{ route('admin.disbursement-performance.review', $performance->disburs_id) }}" 
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
    $('#disbursementPerformanceTable').DataTable({
        pageLength: 25,
        order: [[0, 'asc']],
        responsive: true
    });
    
    // Delete button functionality
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this record?')) {
            fetch(`/admin/disbursement-performance/${id}/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Record deleted successfully!');
                    location.reload();
                } else {
                    alert('Error deleting record: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting record!');
            });
        }
    });
});
</script>
@endpush
@endsection 