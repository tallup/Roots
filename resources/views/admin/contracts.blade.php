@extends('admin.layouts.app')

@section('title', 'Contracts Report')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fa fa-file-contract me-2"></i>Contract/MOU Performance Monitoring Report - Admin View
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
                        <table id="contractsTable" class="table table-striped table-bordered">
                            <thead style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: white;">
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Quarter</th>
                                    <th>Year</th>
                                    <th>Contract/MOU</th>
                                    <th>Component</th>
                                    <th>Subcomponent</th>
                                    <th>Actor</th>
                                    <th>Person</th>
                                    <th>Type Intervention</th>
                                    <th>Contract Type</th>
                                    <th>Status</th>
                                    <th>Cost</th>
                                    <th>Key Issues</th>
                                    <th>Recommendations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $contract)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contract->status ?? 'Pending' }}</td>
                                    <td>{{ $contract->proId ?? '' }}</td>
                                    <td>{{ $contract->year }}</td>
                                    <td>{{ $contract->name ?? '' }}</td>
                                    <td>{{ $contract->component_name ?? '' }}</td>
                                    <td>{{ $contract->sub_name ?? '' }}</td>
                                    <td>{{ $contract->actorId ?? '' }}</td>
                                    <td>{{ $contract->personId ?? '' }}</td>
                                    <td>{{ $contract->intervenId ?? '' }}</td>
                                    <td>{{ $contract->ctyId ?? '' }}</td>
                                    <td>{{ $contract->stuId ?? '' }}</td>
                                    <td>{{ number_format($contract->cost ?? 0) }}</td>
                                    <td>{{ $contract->key_issue ?? '' }}</td>
                                    <td>{{ $contract->recommendation ?? '' }}</td>
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
    $('#contractsTable').DataTable({
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
                targets: [2, 3], // Quarter, Year
                width: '80px'
            },
            {
                targets: [4], // Contract/MOU
                width: '150px'
            },
            {
                targets: [5, 6], // Component, Subcomponent
                width: '120px'
            },
            {
                targets: [7, 8, 9, 10, 11, 12], // Actor, Person, Type Intervention, Contract Type, Status
                width: '100px'
            },
            {
                targets: [13], // Cost
                width: '100px',
                className: 'text-center'
            },
            {
                targets: [14, 15], // Key Issues, Recommendations
                width: '150px'
            }
        ]
    });
});

// Export functions
function copyTable() {
    const table = document.getElementById('contractsTable');
    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
    alert('Table copied to clipboard!');
}

function exportToCSV() {
    const table = document.getElementById('contractsTable');
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
    link.download = 'contracts_report.csv';
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