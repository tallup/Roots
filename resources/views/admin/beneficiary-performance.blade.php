@extends('admin.layouts.app')

@section('title', 'Beneficiary Performance Tracking - ROOTS')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #218838 0%, #17a2b8 100%); color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-users me-2"></i>
                            Beneficiary Performance Tracking
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
                        <table id="beneficiaryPerformanceTable" class="table table-striped table-hover">
                                                         <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Supervisor Status</th>
                                     <th>Admin Status</th>
                                     <th>Year</th>
                                     <th>Quarter</th>
                                     <th>Region</th>
                                     <th>Activity</th>
                                     <th>Intervention</th>
                                     <th>Beneficiary</th>
                                     <th>Total Ben</th>
                                     <th>Town/Village</th>
                                     <th>Actions</th>
                                 </tr>
                             </thead>
                            <tbody>
                                                                 @foreach($beneficiaryPerformances as $index => $performance)
                                     <tr>
                                         <td>{{ $performance->profile_id }}</td>
                                         <td>
                                             <span class="badge bg-{{ $performance->status === 'Approved' ? 'success' : ($performance->status === 'Pending' ? 'warning' : 'danger') }}">
                                                 {{ $performance->status ?? 'Approved' }}
                                             </span>
                                         </td>
                                         <td>
                                             <span class="badge bg-{{ $performance->admstatus === 'approve' ? 'success' : ($performance->admstatus === 'pending' ? 'warning' : 'danger') }}">
                                                 {{ $performance->admstatus ?? 'pending' }}
                                             </span>
                                         </td>
                                         <td>{{ $performance->year }}</td>
                                         <td>{{ $performance->quarter_name ?? $performance->proid }}</td>
                                         <td>{{ $performance->region_name ?? $performance->regid }}</td>
                                         <td>{{ Str::limit($performance->activity, 30) }}</td>
                                         <td>{{ Str::limit($performance->intervenid ?? $performance->comp, 30) }}</td>
                                         <td>{{ $performance->beneficiary_name ?? $performance->benid }}</td>
                                         <td>{{ $performance->beneficiary_no }}</td>
                                         <td>{{ $performance->community }}</td>
                                         <td>
                                             <a href="{{ route('admin.beneficiary-performance.review', $performance->profile_id) }}" 
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
     $('#beneficiaryPerformanceTable').DataTable({
         pageLength: 25,
         order: [[0, 'asc']],
         responsive: true
     });
     
     // Delete button functionality
     $(document).on('click', '.delete-btn', function() {
         const id = $(this).data('id');
         if (confirm('Are you sure you want to delete this record?')) {
             fetch(`/admin/beneficiary-performance/${id}/delete`, {
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