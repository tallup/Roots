@extends('finance.layouts.app')
@section('content')
<style>
    .results-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding-top: 1.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .results-header-row .results-title {
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
<div class="results-header-row pt-3">
    <h2 class="fw-bold results-title" style="color:#00796b;">Results Financial Transactions</h2>
</div>
<div class="dt-controls-row">
    <div class="dt-length"></div>
    <div class="dt-search"></div>
</div>
<div class="card border-0 shadow-sm" style="border-radius: 1.25rem;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="resultsTable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Component</th>
                        <th>Allocation (USD)</th>
                        <th>Allocation Balance (USD)</th>
                        <th>Subcomponent</th>
                        <th>Sub Allocation (USD)</th>
                        <th>Sub Allocation Balance (USD)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $i => $row)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $row->component_desc }}</td>
                            <td>{{ $row->C_allocation }}</td>
                            <td>{{ $row->C_allocation_balance }}</td>
                            <td>{{ $row->sub_desc }}</td>
                            <td>{{ $row->sub_allocation }}</td>
                            <td>{{ $row->sub_allocation_balance }}</td>
                            <td>
                                <a href="{{ route('finance.result-transactions.edit', $row->subid) }}" class="btn btn-xs px-2 py-1" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; font-weight:600; border:none; font-size:0.85rem; padding:2px 8px;">Edit</a>
                            </td>
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
        var table = $('#resultsTable').DataTable({
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