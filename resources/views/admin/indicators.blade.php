@extends('admin.layouts.app')

@section('title', 'Indicators Report')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fa fa-chart-line me-2"></i>Indicator Performance Monitoring Report - Admin View
                        </h4>
                        <div class="d-flex gap-2" role="group">
                            <button type="button" class="btn btn-light btn-sm" onclick="copyTable()">
                                <i class="fa fa-copy me-1"></i>Copy
                            </button>
                            <button type="button" class="btn btn-light btn-sm" onclick="exportToCSV()">
                                <i class="fa fa-file-csv me-1"></i>CSV
                            </button>
                            <button type="button" class="btn btn-light btn-sm" onclick="exportToExcel()">
                                <i class="fa fa-file-excel me-1"></i>Excel
                            </button>
                            <button type="button" class="btn btn-light btn-sm" onclick="exportToPDF()">
                                <i class="fa fa-file-pdf me-1"></i>PDF
                            </button>
                            <button type="button" class="btn btn-light btn-sm" onclick="printTable()">
                                <i class="fa fa-print me-1"></i>Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="indicatorsTable" class="table table-striped table-bordered">
                            <thead style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: white;">
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Year</th>
                                    <th>Quarter</th>
                                    <th>Indicator Type</th>
                                    <th>Description</th>
                                    <th>Indicator Description</th>
                                    <th>Target</th>
                                    <th>Achieved</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($indicators as $indicator)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $indicator->status ?? 'Pending' }}</td>
                                    <td>{{ $indicator->year }}</td>
                                    <td>{{ $indicator->data ?? 'N/A' }}</td>
                                    <td>{{ $indicator->indicator_type ?? '' }}</td>
                                    <td>{{ $indicator->description ?? '' }}</td>
                                    <td>{{ $indicator->indicator_desc ?? '' }}</td>
                                    <td>{{ number_format($indicator->target ?? 0) }}</td>
                                    <td>{{ number_format($indicator->acheived ?? 0) }}</td>
                                    <td>{{ $indicator->rmk ?? '' }}</td>
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

<style>
.card-header {
    border-bottom: none;
}

.table thead th {
    border: none;
    font-weight: 600;
}

.table tbody tr:hover {
    background-color: rgba(0, 121, 107, 0.05);
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate {
    color: #333;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%) !important;
    border-color: #00796b !important;
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: linear-gradient(90deg, #00695c 0%, #00acc1 100%) !important;
    border-color: #00695c !important;
    color: white !important;
}
</style>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#indicatorsTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[0, 'desc']],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ records per page",
            info: "Showing _START_ to _END_ of _TOTAL_ records",
            infoEmpty: "Showing 0 to 0 of 0 records",
            infoFiltered: "(filtered from _MAX_ total records)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        },
        columnDefs: [
            {
                targets: [0], // No column
                width: '60px'
            },
            {
                targets: [1], // Status column
                width: '100px'
            },
            {
                targets: [2, 3], // Year, Quarter
                width: '100px'
            },
            {
                targets: [4], // Indicator Type
                width: '150px'
            },
            {
                targets: [5, 6], // Description, Indicator Description
                width: '200px'
            },
            {
                targets: [7, 8], // Target, Achieved
                width: '100px',
                className: 'text-center'
            },
            {
                targets: [9], // Remarks
                width: '150px'
            }
        ]
    });
});

// Export functions
function copyTable() {
    const table = document.getElementById('indicatorsTable');
    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
    alert('Table copied to clipboard!');
}

function exportToCSV() {
    const table = document.getElementById('indicatorsTable');
    const rows = table.querySelectorAll('tr');
    let csv = [];
    
    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        
        for (let j = 0; j < cols.length; j++) {
            let text = cols[j].innerText.replace(/"/g, '""');
            rowData.push('"' + text + '"');
        }
        
        csv.push(rowData.join(','));
    }
    
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'indicators_report.csv';
    link.click();
}

function exportToExcel() {
    // For Excel export, we'll use CSV format which Excel can open
    exportToCSV();
}

function exportToPDF() {
    window.print();
}

function printTable() {
    window.print();
}
</script>
@endpush 