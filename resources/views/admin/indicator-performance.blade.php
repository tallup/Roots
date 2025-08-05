@extends('admin.layouts.app')

@section('title', 'Indicator Performance Tracking - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #218838 0%, #17a2b8 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-chart-line me-2"></i>
                            Indicator Performance Tracking
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
                        <table id="indicatorPerformanceTable" class="table table-striped table-hover">
                                                         <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Status</th>
                                     <th>Quarter</th>
                                     <th>Year</th>
                                     <th>Indicator Type</th>
                                     <th>Indicator Description</th>
                                     <th>Indicator Category</th>
                                     <th>Freq Data Collection</th>
                                     <th>Target</th>
                                     <th>Achieved</th>
                                     <th>%Achievement</th>
                                     <th>Actions</th>
                                 </tr>
                             </thead>
                            <tbody>
                                @foreach($indicatorPerformances as $index => $performance)
                                                                 <tr>
                                     <td>{{ $index + 1 }}</td>
                                     <td>
                                         <span class="badge bg-{{ $performance->status === 'Approved' ? 'success' : ($performance->status === 'Pending' ? 'warning' : 'danger') }}">
                                             {{ $performance->status }}
                                         </span>
                                     </td>
                                     <td>{{ $performance->proId }}</td>
                                     <td>{{ $performance->year }}</td>
                                     <td>{{ $performance->indicatorId }}</td>
                                     <td>{{ Str::limit($performance->indicator_desc, 50) }}</td>
                                     <td>{{ $performance->icat }}</td>
                                     <td>{{ $performance->data }}</td>
                                     <td>{{ $performance->target }}</td>
                                     <td>{{ $performance->acheived }}</td>
                                     <td>{{ number_format($performance->acheivement, 2) }}%</td>
                                     <td>
                                         <a href="{{ route('admin.indicator-performance.review', $performance->indicator_id) }}" 
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
    $('#indicatorPerformanceTable').DataTable({
        pageLength: 25,
        order: [[0, 'asc']],
        responsive: true
    });
    

});
</script>
@endpush
@endsection 