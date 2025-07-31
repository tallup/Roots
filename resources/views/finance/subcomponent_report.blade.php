<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcomponent Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0;">
                    Subcomponent Report
                    <button onclick="window.print()" class="btn btn-light"><i class="fa fa-print"></i> Print</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Allocation (USD)</th>
                                    <th>Balance (USD)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcomponents as $i => $row)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $row->subcomponent }}</td>
                                        <td>{{ $row->sub_desc }}</td>
                                        <td>{{ number_format($row->allocation, 2) }}</td>
                                        <td>{{ number_format($row->allocation_balance, 2) }}</td>
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