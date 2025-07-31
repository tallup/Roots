@extends('supervisor.layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm mb-4 w-100" style="border-radius: 1.25rem;">
        <div class="card-header bg-white border-0 fw-bold fs-5" style="border-radius: 1.25rem 1.25rem 0 0;">Beneficiary Performance Monitoring Report - Supervisor View</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table table-striped table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Supervisor Status</th>
                            <th>Admin Status</th>
                            <th>Year</th>
                            <th>Region</th>
                            <th>Activity</th>
                            <th>Intervention</th>
                            <th>Beneficiary</th>
                            <th>Total Ben</th>
                            <th>Town/Village</th>
                            <th>Supervisor Review</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beneficiaries as $row)
                            <tr>
                                <td>{{ $row->profile_id }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->admstatus }}</td>
                                <td>{{ $row->year }}</td>
                                <td>{{ $row->regid }}</td>
                                <td>{{ $row->activity }}</td>
                                <td>{{ $row->intervenid }}</td>
                                <td>{{ $row->benid }}</td>
                                <td>{{ $row->beneficiary_no }}</td>
                                <td>{{ $row->community }}</td>
                                <td>{{ $row->sup_revw }}</td>
                                <td style="text-align: right;">
                                    <a href="{{ route('supervisor.beneficiaries.review', $row->profile_id) }}" class="btn btn-link btn-review" title="Review">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="12" class="text-center text-muted">No beneficiaries found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 