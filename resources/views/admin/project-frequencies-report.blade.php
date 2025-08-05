<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Reporting Frequencies Report - ROOTS</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
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
        .project-frequencies-report-container {
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
        .btn-secondary {
            background: linear-gradient(90deg, #6c757d 0%, #495057 100%);
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 30px;
        }
        .btn-secondary:hover {
            background: linear-gradient(90deg, #495057 0%, #6c757d 100%);
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
        .dt-buttons .btn {
            background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 6px;
            margin-right: 5px;
        }
        .dt-buttons .btn:hover {
            background: linear-gradient(90deg, #00bcd4 0%, #00796b 100%);
            color: white;
        }
    </style>
</head>
<body>
@include('admin.partials.sidebar')
<div class="main-content-fixed">
    <div class="project-frequencies-report-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Project Reporting Frequencies Report</h2>
            <div class="d-flex gap-2">
                <button onclick="goBack()" class="btn btn-secondary">
                    <i class="fa fa-arrow-left me-2"></i>Go Back
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="projectFrequenciesReportTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Reporting Frequency</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projectFrequencies as $index => $projectFrequency)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $projectFrequency->Rep_frequency }}</td>
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
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#projectFrequenciesReportTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[0, 'asc']],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
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

function goBack() {
    window.history.back();
}
</script>
</body>
</html> 