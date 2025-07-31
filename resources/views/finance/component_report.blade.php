<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Component Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-0">
            @include('finance.partials.sidebar')
        </div>
        <div class="col-md-9 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color:#00796b;">Component Report</h2>
                <button onclick="window.print()" class="btn btn-outline-primary"><i class="fa fa-print me-2"></i>Print</button>
            </div>
            <div class="card border-0 shadow-sm" style="border-radius: 1.25rem;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Allocation</th>
                                    <th>Allocation Balance</th>
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
</body>
</html> 