@extends('finance.layouts.app')
@section('content')
<style>
    .disb-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding-top: 1.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .disb-header-row .disb-title {
        margin-bottom: 0;
    }
    .btn-add-disb {
        min-width: 200px;
        font-weight: 600;
        background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
        border: none;
    }
    .dataTables_length, .dataTables_filter {
        margin-bottom: 0 !important;
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
</style>
<div class="disb-header-row">
    <h2 class="fw-bold disb-title" style="color:#00796b;">Disbursement Records</h2>
    <a href="{{ route('finance.disbursements.create') }}" class="btn btn-primary btn-add-disb">
        <i class="fa fa-plus me-2"></i>Add New Disbursement
    </a>
</div>
<div class="dt-controls-row">
    <div class="dt-length"></div>
    <div class="dt-search"></div>
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
            <table class="table table-striped table-hover" id="disbursementsTable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Year</th>
                        <th>Source</th>
                        <th>Component</th>
                        <th>Subcomponent</th>
                        <th>Performance</th>
                        <th>Execution (%)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disbursements as $i => $row)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $row->admstatus }}</td>
                            <td>{{ $row->year }}</td>
                            <td>{{ $row->disburs_source }}</td>
                            <td>{{ $row->component_name ?? 'N/A' }}</td>
                            <td>{{ $row->sub_name ?? 'N/A' }}</td>
                            <td>{{ $row->perfor }}</td>
                            <td>{{ $row->execu }}</td>
                            <td>
                                <span class="d-inline-flex gap-1">
                                    <a href="{{ route('finance.disbursements.edit', $row->disburs_id) }}" class="btn btn-xs px-2 py-1" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; font-weight:600; border:none; font-size:0.85rem; padding:2px 8px;"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-xs px-2 py-1" style="background: linear-gradient(135deg, #ff1744 0%, #ff8a65 100%); color: #fff; font-weight:600; border:none; font-size:0.85rem; padding:2px 8px;" onclick="deleteDisbursement('{{ $row->disburs_id }}')"><i class="fa fa-trash"></i></button>
                                </span>
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
        var table = $('#disbursementsTable').DataTable({
            order: [[0, 'asc']],
            pageLength: 25,
            responsive: true
        });
        // Move the length menu and search box into the controls row
        $(table.table().container()).find('.dataTables_length').appendTo('.dt-length');
        $(table.table().container()).find('.dataTables_filter').appendTo('.dt-search');
    });
    function deleteDisbursement(id) {
        if(confirm('Are you sure you want to delete this disbursement?')) {
            $.ajax({
                url: '/finance/disbursements/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    } else {
                        alert('Unable to delete disbursement.');
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the disbursement.');
                }
            });
        }
    }
</script>
@endsection 