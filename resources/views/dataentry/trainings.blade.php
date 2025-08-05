<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainings - Data Entry - ROOTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <style>
        body { background: #f8f9fa; font-family: 'PT Sans', sans-serif; }
        .navbar { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; margin-right: 0 !important; padding-left: 0 !important; text-align: left; }
        .nav-link { color: rgba(255, 255, 255, 0.9) !important; font-weight: 500; font-size: 1.1rem; padding: 0.75rem 1.25rem !important; margin: 0 0.25rem; border-radius: 8px; transition: all 0.3s ease; }
        .nav-link:hover { color: white !important; background-color: rgba(255, 255, 255, 0.1); transform: translateY(-2px); }
        .nav-link.active { background-color: rgba(255, 255, 255, 0.2); color: white !important; font-weight: 600; }
        .nav-link i { font-size: 1.2rem; margin-right: 0.5rem; }
        .main-content { padding: 30px 0; }
        .page-header { background: white; border-radius: 15px; padding: 25px; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); }
        .page-title { color: #2c3e50; font-weight: 700; margin-bottom: 10px; }
        .page-subtitle { color: #7f8c8d; font-size: 1.1rem; }
        .filter-buttons { margin-bottom: 30px; }
        .filter-btn { margin-right: 10px; margin-bottom: 10px; border-radius: 25px; padding: 10px 25px; font-weight: 500; transition: all 0.3s ease; }
        .filter-btn.active { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); }
        .data-card { background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); overflow: hidden; width: 100%; }
        .table-responsive { width: 100%; overflow-x: auto; }
        #trainingsTable { width: 100% !important; min-width: 100%; }
        .dataTables_wrapper { width: 100%; }
        .container-fluid { padding-left: 20px; padding-right: 20px; }
        .dataTables_scrollBody, .dataTables_scrollHead, .dataTables_scroll { width: 100% !important; }
        .table { margin-bottom: 0; }
        .table th { background: #f8f9fa; border-bottom: 2px solid #dee2e6; font-weight: 600; color: #495057; padding: 12px 8px; }
        .table td { vertical-align: middle; border-bottom: 1px solid #dee2e6; padding: 12px 8px; }
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-approved { background: #d1edff; color: #0c5460; }
        .status-reject { background: #f8d7da; color: #721c24; }
        .action-btn { padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 0.75rem; margin: 1px 0; display: block; min-width: 45px; text-align: center; border: none; transition: all 0.3s ease; line-height: 1.2; }
        .btn-view { background: #00796b; color: white; }
        .btn-view:hover { background: #005a52; color: white; transform: translateY(-1px); }
        .btn-edit { background: #ff9800; color: white; }
        .btn-edit:hover { background: #e68900; color: white; transform: translateY(-1px); }
        .actions-cell { min-width: 80px; white-space: nowrap; vertical-align: top; padding: 6px !important; }
        .alert { border-radius: 10px; border: none; }
    </style>
</head>
<body>
    @include('dataentry.partials.navbar')
    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="page-title">
                            <i class="fa fa-graduation-cap me-2"></i>Training Performance Monitoring
                        </h1>
                        <p class="page-subtitle">Data Entry View - Manage training data</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('dataentry.add-training') }}" class="btn" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: white; border: none; font-weight: 600;"><i class="fa fa-plus me-2"></i>Add New Training</a>
                        <a href="{{ route('dataentry.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
            <!-- Filter Buttons -->
            <div class="filter-buttons text-center">
                <a href="{{ route('dataentry.trainings', ['status' => 'approved']) }}" 
                   class="btn btn-success filter-btn {{ $status === 'approved' ? 'active' : '' }}">
                    <i class="fa fa-check-circle me-2"></i>Approved Data
                </a>
                <a href="{{ route('dataentry.trainings', ['status' => 'pending']) }}" 
                   class="btn btn-warning filter-btn {{ $status === 'pending' ? 'active' : '' }}">
                    <i class="fa fa-clock me-2"></i>Pending Data
                </a>
                <a href="{{ route('dataentry.trainings', ['status' => 'reject']) }}" 
                   class="btn btn-danger filter-btn {{ $status === 'reject' ? 'active' : '' }}">
                    <i class="fa fa-times-circle me-2"></i>Rejected Data
                </a>
                <a href="{{ route('dataentry.trainings', ['status' => 'all']) }}" 
                   class="btn btn-info filter-btn {{ $status === 'all' ? 'active' : '' }}">
                    <i class="fa fa-list me-2"></i>All Data
                </a>
            </div>
            <!-- Data Table -->
            <div class="data-card">
                <div class="table-responsive">
                    <table id="trainingsTable" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>Status</th>
                                <th>Year</th>
                                <th>Quarter</th>
                                <th>Training Type</th>
                                <th>Component</th>
                                <th>Subcomponent</th>
                                <th>Actor</th>
                                <th>Person</th>
                                <th>Venue</th>
                                <th>Cost</th>
                                <th>Description</th>
                                <th>Total Targeted</th>
                                <th>Total Achieved</th>
                                <th>Key Issues</th>
                                <th>Recommendation</th>
                               
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainings as $training)
                                <tr>
                                    <td>{{ $training->train_Id }}</td>
                                    <td class="actions-cell">
                                        <div class="d-flex flex-column gap-1">
                                            <a href="#" class="action-btn btn-view view-training" title="View Details" 
                                               data-id="{{ $training->train_Id }}">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            @if(strtolower(trim($training->status)) === 'pending' || strtolower(trim($training->status)) === 'reject')
                                                <a href="#" class="action-btn btn-edit" title="Edit">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($training->status) }}">
                                            {{ $training->status }}
                                        </span>
                                    </td>
                                    <td>{{ $training->year }}</td>
                                    <td>{{ $training->proId }}</td>
                                    <td>{{ $training->traId }}</td>
                                    <td>{{ $training->component_name }}</td>
                                    <td>{{ $training->sub_name }}</td>
                                    <td>{{ $training->actorId }}</td>
                                    <td>{{ $training->personId }}</td>
                                    <td>{{ $training->venId }}</td>
                                    <td>{{ $training->cost }}</td>
                                    <td>{{ $training->train_desc }}</td>
                                    <td>{{ $training->total_target }}</td>
                                    <td>{{ $training->total_acheived }}</td>
                                    <td>{{ $training->key_issue }}</td>
                                    <td>{{ $training->recommendation }}</td>
                                    
                                    <td>{{ $training->rmk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#trainingsTable').DataTable({
                pageLength: 25,
                order: [[0, 'desc']],
                responsive: false,
                autoWidth: false,
                scrollX: true,
                scrollCollapse: true,
                language: {
                    search: "Search trainings:",
                    lengthMenu: "Show _MENU_ trainings per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ trainings",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                initComplete: function() {
                    $(this).DataTable().columns.adjust();
                    $('.dataTables_scroll').css('width', '100%');
                    $('.dataTables_scrollHead').css('width', '100%');
                    $('.dataTables_scrollBody').css('width', '100%');
                }
            });
            $(window).resize(function() {
                $('#trainingsTable').DataTable().columns.adjust();
            });
            // View logic
            $(document).on('click', '.view-training', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                viewTraining(id);
            });
            // Edit logic
            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault();
                var row = $(this).closest('tr');
                var id = row.find('td:first').text();
                window.location.href = '/data-entry/trainings/' + id + '/edit';
            });
        });
        function viewTraining(id) {
            // Show modal
            if ($('#viewTrainingModal').length === 0) {
                $('body').append('<div class="modal fade" id="viewTrainingModal" tabindex="-1" aria-labelledby="viewTrainingModalLabel" aria-hidden="true"><div class="modal-dialog modal-xl"><div class="modal-content"><div class="modal-header" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: white;"><h5 class="modal-title" id="viewTrainingModalLabel"><i class="fa fa-eye me-2"></i>Training Details</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body" id="trainingDetails"><div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading training details...</p></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary" id="editTrainingBtn" style="display: none;"><i class="fa fa-edit me-2"></i>Edit Training</button></div></div></div></div>');
            }
            $('#viewTrainingModal').modal('show');
            // Load details via AJAX
            $.ajax({
                url: "{{ route('dataentry.view-training') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#trainingDetails').html(response.html);
                    if (response.canEdit) {
                        $('#editTrainingBtn').show().off('click').on('click', function() {
                            window.location.href = response.editUrl;
                        });
                    } else {
                        $('#editTrainingBtn').hide();
                    }
                },
                error: function() {
                    $('#trainingDetails').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle me-2"></i>Error loading training details.</div>');
                }
            });
        }
    </script>
</body>
</html> 