<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcomponent Allocations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-0">
            @include('finance.partials.sidebar')
        </div>
        <div class="col-md-9 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color:#00796b;">Subcomponent Allocations</h2>
                <div>
                    <a href="{{ route('finance.subcomponents.add') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border: none; font-weight: 600;">
                        <i class="fa fa-plus me-2"></i>Add New Subcomponent
                    </a>
                    <a href="{{ route('finance.subcomponents.report') }}" class="btn btn-info ms-2" style="font-weight:600;"><i class="fa fa-file-alt me-2"></i>View Report</a>
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
                        <table class="table table-striped table-hover" id="subcomponentsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Component ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Allocation (USD)</th>
                                    <th>Balance (USD)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcomponents as $i => $row)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $row->compid }}</td>
                                        <td>{{ $row->subcomponent }}</td>
                                        <td>{{ $row->sub_desc }}</td>
                                        <td>{{ number_format((float)str_replace(',', '', $row->sub_allocation), 2) }}</td>
                                        <td>{{ number_format($row->sub_allocation_balance, 2) }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('finance.subcomponents.edit', $row->subid) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; font-weight:600; border:none;"><i class="fa fa-edit"></i> Edit</a>
                                                <button class="btn btn-sm" style="background: linear-gradient(135deg, #ff1744 0%, #ff8a65 100%); color: #fff; font-weight:600; border:none;" onclick="deleteSubcomponent('{{ $row->subid }}')"><i class="fa fa-trash"></i> Delete</button>
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
<script>
    $(document).ready(function() {
        $('#subcomponentsTable').DataTable({
            order: [[0, 'asc']],
            pageLength: 25,
            responsive: true,
            language: {
                search: "Search subcomponents:",
                lengthMenu: "Show _MENU_ subcomponents per page",
                info: "Showing _START_ to _END_ of _TOTAL_ subcomponents",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });
    function deleteSubcomponent(id) {
        if(confirm('Are you sure you want to delete this subcomponent?')) {
            $.ajax({
                url: '/finance/subcomponents/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    }
                }
            });
        }
    }
</script>
</body>
</html> 