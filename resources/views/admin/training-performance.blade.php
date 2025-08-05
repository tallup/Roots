@extends('admin.layouts.app')

@section('title', 'Training Performance Tracking - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-graduation-cap me-2"></i>
                            Training Performance Tracking
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
                        <table id="trainingPerformanceTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Year</th>
                                    <th>Quarter</th>
                                    <th>Training Type</th>
                                    <th>Component</th>
                                    <th>Subcomponent</th>
                                    <th>Actor Type</th>
                                    <th>Person</th>
                                    <th>Venue</th>
                                    <th>Training Cost</th>
                                    <th>Training Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trainings as $index => $training)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge bg-{{ $training->status === 'Approved' ? 'success' : ($training->status === 'Rejected' ? 'danger' : 'warning') }}">
                                                {{ $training->status }}
                                            </span>
                                        </td>
                                        <td>{{ $training->year }}</td>
                                        <td>{{ $training->proId }}</td>
                                        <td>{{ $training->traId }}</td>
                                        <td>{{ $training->component_name }}</td>
                                        <td>{{ $training->sub_name }}</td>
                                        <td>{{ $training->actorId }}</td>
                                        <td>{{ $training->personId }}</td>
                                        <td>{{ $training->venId }}</td>
                                        <td>{{ number_format((float)$training->cost, 2) }}</td>
                                        <td>{{ Str::limit($training->train_desc, 50) }}</td>
                                        <td>
                                            <a href="{{ route('admin.training-performance.review', $training->train_Id) }}" 
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
    $('#trainingPerformanceTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[0, 'asc']],
        columnDefs: [
            { targets: [12], orderable: false }
        ]
    });
});
</script>
@endpush
@endsection 