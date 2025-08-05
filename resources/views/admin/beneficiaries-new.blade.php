@extends('admin.layouts.app')

@section('title', 'Beneficiary Profile Report')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fa fa-users me-2"></i>Beneficiary Performance Monitoring Report - Admin View
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
                        <table id="beneficiariesTable" class="table table-striped table-bordered">
                            <thead style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); color: white;">
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Year</th>
                                    <th>Quarter</th>
                                    <th>Region</th>
                                    <th>Activity</th>
                                    <th>Intervention</th>
                                    <th>Beneficiary</th>
                                    <th>PwD</th>
                                    <th>Youth</th>
                                    <th>Profile</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Total Ben</th>
                                    <th>Town/Village</th>
                                    <th>Contact</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($beneficiaries as $beneficiary)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $beneficiary->status ?? 'Pending' }}</td>
                                    <td>{{ $beneficiary->year }}</td>
                                    <td>{{ $beneficiary->proId }}</td>
                                    <td>{{ $beneficiary->regId }}</td>
                                    <td>{{ $beneficiary->activity_id }}</td>
                                    <td>{{ $beneficiary->intervenId }}</td>
                                    <td>{{ $beneficiary->benId }}</td>
                                    <td>{{ $beneficiary->npwd ?? 0 }}</td>
                                    <td>{{ $beneficiary->nyouth ?? 0 }}</td>
                                    <td>
                                        @if($beneficiary->add_profile)
                                            <img src="/client/uploads/{{ $beneficiary->add_profile }}" width="80" height="80" alt="Profile">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $beneficiary->male ?? 0 }}</td>
                                    <td>{{ $beneficiary->female ?? 0 }}</td>
                                    <td>{{ $beneficiary->beneficiary_no ?? 0 }}</td>
                                    <td>{{ $beneficiary->community }}</td>
                                    <td>{{ $beneficiary->contact ?? '' }}</td>
                                    <td>{{ $beneficiary->rmk ?? '' }}</td>
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
    $('#beneficiariesTable').DataTable({
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
                targets: [2, 3, 4], // Year, Quarter, Region
                width: '100px'
            },
            {
                targets: [5], // Activity
                width: '120px'
            },
            {
                targets: [6, 7], // Intervention, Beneficiary
                width: '150px'
            },
            {
                targets: [8, 9], // PwD, Youth
                width: '80px',
                className: 'text-center'
            },
            {
                targets: [10], // Profile
                width: '100px',
                className: 'text-center'
            },
            {
                targets: [11, 12, 13], // Male, Female, Total Ben
                width: '80px',
                className: 'text-center'
            },
            {
                targets: [14], // Town/Village
                width: '120px'
            },
            {
                targets: [15, 16], // Contact, Remarks
                width: '100px'
            }
        ]
    });
});

// Export functions
function copyTable() {
    const table = document.getElementById('beneficiariesTable');
    const range = document.createRange();
    range.selectNode(table);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
    alert('Table copied to clipboard!');
}

function exportToCSV() {
    const table = document.getElementById('beneficiariesTable');
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
    link.download = 'beneficiary_report.csv';
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