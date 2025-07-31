@extends('finance.layouts.app')
@section('content')
<style>
    .report-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding-top: 1.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .report-header-row .report-title {
        margin-bottom: 0;
    }
    .dt-controls-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .dt-length {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .dt-search {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-left: auto;
    }
    .dt-buttons {
        display: flex !important;
        justify-content: center !important;
        align-items: center;
        gap: 0.5rem;
        margin: 1rem 0 1.5rem 0;
        width: 100%;
    }
    .dt-buttons .btn, .dt-buttons button, .dt-buttons .dt-button {
        background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%) !important;
        color: #fff !important;
        border: none !important;
        font-weight: 600;
        border-radius: 0.5rem !important;
        padding: 0.5rem 1.1rem !important;
        font-size: 1rem !important;
        box-shadow: none !important;
    }
    .dataTables_length label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0;
    }
    .dataTables_length select {
        margin-bottom: 0;
    }
    .dataTables_length, .dataTables_filter {
        margin-bottom: 0 !important;
    }
</style>
<div class="report-header-row pt-3">
    <h2 class="fw-bold report-title" style="color:#00796b;">Transaction Reports</h2>
</div>
<div class="dt-controls-row">
    <div class="dt-length"></div>
    <div class="dt-search d-flex align-items-center gap-2"></div>
</div>
<div class="card border-0 shadow-sm" style="border-radius: 1.25rem;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="transactionReportTable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Component</th>
                        <th>SubComponent</th>
                        <th>Year</th>
                        <th>Quarter</th>
                        <th>Output</th>
                        <th>Output Amount</th>
                        <th>Balance@Transaction</th>
                        <th>EntryDate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $i => $row)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $row->comdesc }}</td>
                            <td>{{ $row->subcom }}</td>
                            <td>{{ $row->yr }}</td>
                            <td>{{ $row->qtr }}</td>
                            <td>{{ $row->outp }}</td>
                            <td>{{ $row->outAm }}</td>
                            <td>{{ $row->bal }}</td>
                            <td>{{ $row->entdate }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.0/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css"/>
<script>
    $(document).ready(function() {
        var table = $('#transactionReportTable').DataTable({
            order: [[0, 'asc']],
            pageLength: 25,
            responsive: true,
            dom: '<"dt-controls-row"lf><"dt-buttons-row"B>rtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        // Move the length menu and search box into the controls row
        $(table.table().container()).find('.dataTables_length').appendTo('.dt-length');
        $(table.table().container()).find('.dataTables_filter').appendTo('.dt-search');
        // Center the buttons below the controls
        $(table.table().container()).find('.dt-buttons').appendTo('.dt-buttons-row');
    });
</script>
@endsection 