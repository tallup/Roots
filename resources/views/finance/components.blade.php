<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Component Allocations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-0">
            @include('finance.partials.sidebar')
        </div>
        <div class="col-md-9 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color:#00796b;">Component Allocations</h2>
                <div>
                    <a href="{{ route('finance.components.add') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border: none; font-weight: 600;">
                        <i class="fa fa-plus me-2"></i>Add New Component
                    </a>
                    <a href="{{ route('finance.components.report') }}" class="btn btn-info ms-2" style="font-weight:600;"><i class="fa fa-file-alt me-2"></i>View Report</a>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card border-0 shadow-sm" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="componentsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Allocation</th>
                                    <th>Allocation Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($components as $i => $row)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $row->component }}</td>
                                        <td>{{ $row->component_desc }}</td>
                                        <td>{{ $row->C_allocation }}</td>
                                        <td>{{ $row->C_allocation_balance }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="/finance/components/{{ $row->comid }}/edit" class="btn btn-sm" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; font-weight:600; border:none;"><i class="fa fa-edit"></i> Edit</a>
                                                <button class="btn btn-sm" style="background: linear-gradient(135deg, #ff1744 0%, #ff8a65 100%); color: #fff; font-weight:600; border:none;" onclick="deleteComponent('{{ $row->comid }}')"><i class="fa fa-trash"></i> Delete</button>
                                            </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.0/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#componentsTable').DataTable({
            order: [[0, 'asc']],
            pageLength: 25,
            responsive: true,
            language: {
                search: "Search components:",
                lengthMenu: "Show _MENU_ components per page",
                info: "Showing _START_ to _END_ of _TOTAL_ components",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });
    function deleteComponent(id) {
        if(confirm('Are you sure you want to delete this component?')) {
            $.ajax({
                url: '/finance/components/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    } else {
                        alert('Unable to delete component.');
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the component.');
                }
            });
        }
    }
</script>
</body>
</html> 