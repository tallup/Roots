@extends('supervisor.layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm mb-4 w-100" style="border-radius: 1.25rem;">
        <div class="card-header bg-white border-0 fw-bold fs-5" style="border-radius: 1.25rem 1.25rem 0 0;">Training Performance Report - Supervisor View</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table table-striped table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Quarter</th>
                            <th>Training Description</th>
                            <th>Component</th>
                            <th>Subcomponent</th>
                            <th>Actor</th>
                            <th>Venue</th>
                            <th>Status</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trainings as $row)
                            <tr>
                                <td>{{ $row->train_Id }}</td>
                                <td>{{ $row->year }}</td>
                                <td>{{ $row->proId }}</td>
                                <td>{{ $row->train_desc }}</td>
                                <td>{{ $row->component_name }}</td>
                                <td>{{ $row->sub_name }}</td>
                                <td>{{ $row->actorId }}</td>
                                <td>{{ $row->venId }}</td>
                                <td>{{ $row->status }}</td>
                                <td style="text-align: right;">
                                    <a href="{{ route('supervisor.trainings.review', $row->train_Id) }}" class="btn btn-link btn-review" title="Review">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="13" class="text-center text-muted">No trainings found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 