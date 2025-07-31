@extends('finance.layouts.app')
@section('content')
<style>
    .transaction-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding-top: 1.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .transaction-header-row .transaction-title {
        margin-bottom: 0;
    }
    .dt-controls-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        flex-wrap: wrap;
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
<div class="transaction-header-row pt-3">
    <h2 class="fw-bold transaction-title" style="color:#00796b;">Transaction List</h2>
</div>
<div class="dt-controls-row">
    <div class="dt-length"></div>
    <div class="dt-search"></div>
</div>
<div class="card border-0 shadow-sm" style="border-radius: 1.25rem;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="transactionListTable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Component</th>
                        <th>SubComponent</th>
                        <th>Year</th>
                        <th>Quarter</th>
                        <th>Output</th>
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
<script>
    $(document).ready(function() {
        var table = $('#transactionListTable').DataTable({
            order: [[0, 'asc']],
            pageLength: 25,
            responsive: true
        });
        // Move the length menu and search box into the controls row
        $(table.table().container()).find('.dataTables_length').appendTo('.dt-length');
        $(table.table().container()).find('.dataTables_filter').appendTo('.dt-search');
    });
</script>
@endsection 