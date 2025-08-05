<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary Types - ROOTS</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f8fb;
            font-family: 'PT Sans', sans-serif;
        }
        .main-content-fixed {
            margin-left: 260px;
            padding: 40px 30px;
        }
        @media (max-width: 991px) {
            .main-content-fixed {
                margin-left: 0;
                padding: 20px 5px;
            }
        }
        .beneficiary-types-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            padding: 40px 30px;
            margin: 40px auto;
        }
        .page-title {
            color: #00796b;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%);
            border: none;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #00bcd4 0%, #00796b 100%);
        }
        .btn-secondary {
            background: linear-gradient(90deg, #6c757d 0%, #495057 100%);
            border: none;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-secondary:hover {
            background: linear-gradient(90deg, #495057 0%, #6c757d 100%);
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.875rem;
        }
        .btn-edit.btn-sm, .btn-delete.btn-sm {
            padding: 5px 10px;
            font-size: 0.875rem;
        }
        .table th {
            background: #f8f9fa;
            color: #00796b;
            font-weight: 600;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e9ecef;
            border-radius: 6px;
            padding: 8px 12px;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #00bcd4;
            box-shadow: 0 0 0 0.2rem rgba(0,188,212,.15);
        }
        .btn-edit {
            background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 6px;
        }
        .btn-edit:hover {
            background: linear-gradient(90deg, #00bcd4 0%, #00796b 100%);
            color: white;
        }
        .btn-delete {
            background: linear-gradient(90deg, #d32f2f 0%, #f44336 100%);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 6px;
        }
        .btn-delete:hover {
            background: linear-gradient(90deg, #f44336 0%, #d32f2f 100%);
            color: white;
        }
    </style>
</head>
<body>
@include('admin.partials.sidebar')
<div class="main-content-fixed">
    <div class="beneficiary-types-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Beneficiary Types</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.beneficiary-types-report') }}" class="btn btn-secondary">
                    <i class="fa fa-file-alt me-2"></i>View Report
                </a>
                <a href="{{ route('admin.add-beneficiary-type') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-2"></i>Add New Beneficiary Type
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table id="beneficiaryTypesTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Beneficiary Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beneficiaryTypes as $index => $beneficiaryType)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $beneficiaryType->beneficiary_type }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.edit-beneficiary-type', $beneficiaryType->benId) }}" 
                                   class="btn btn-sm btn-edit">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm delete-beneficiary-type" 
                                        data-id="{{ $beneficiaryType->benId }}" 
                                        data-name="{{ $beneficiaryType->beneficiary_type }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#beneficiaryTypesTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[0, 'asc']],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
});

$(document).on('click', '.delete-beneficiary-type', function() {
    const id = $(this).data('id');
    const name = $(this).data('name');
    if (confirm('Are you sure you want to delete the beneficiary type "' + name + '"?')) {
        // Create a form to submit the delete request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ url("/admin/delete-beneficiary-type") }}/' + id;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method override for DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
});
</script>
</body>
</html> 