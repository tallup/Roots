@extends('supervisor.layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm mb-4 w-100" style="border-radius: 1.25rem;">
        <div class="card-header bg-white border-0 fw-bold fs-5" style="border-radius: 1.25rem 1.25rem 0 0;">Indicator Performance Monitoring Report - Supervisor View</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table table-striped table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Year</th>
                            <th>Indicator Type</th>
                            <th>Indicator Description</th>
                            <th>Category</th>
                            <th>Baseline</th>
                            <th>Target</th>
                            <th>Achieved</th>
                            <th>% Achievement</th>
                            <th>Frequency</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($indicators as $row)
                            <tr>
                                <td>{{ $row->indicator_id }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->year }}</td>
                                <td>{{ $row->indicator_type }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->icat }}</td>
                                <td>{{ $row->baseline }}</td>
                                <td>{{ number_format($row->target) }}</td>
                                <td>{{ number_format($row->acheived) }}</td>
                                <td>{{ number_format($row->acheivement, 2) }}%</td>
                                <td>{{ $row->data }}</td>
                                <td style="text-align: right;">
                                    <a href="{{ route('supervisor.indicators.review', $row->indicator_id) }}" class="btn btn-link btn-review" title="Review">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="15" class="text-center text-muted">No indicators found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 