<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiaries - Data Entry - ROOTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <style>
        body {
            background: #f8f9fa;
            font-family: 'PT Sans', sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            margin-right: 0 !important;
            padding-left: 0 !important;
            text-align: left;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 0.75rem 1.25rem !important;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white !important;
            font-weight: 600;
        }
        .nav-link i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }
        .main-content {
            padding: 30px 0;
        }
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .page-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .page-subtitle {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        .filter-buttons {
            margin-bottom: 30px;
        }
        .filter-btn {
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .filter-btn.active {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .data-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            width: 100%;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        #beneficiariesTable {
            width: 100% !important;
            min-width: 100%;
        }
        .dataTables_wrapper {
            width: 100%;
        }
        .container-fluid {
            padding-left: 20px;
            padding-right: 20px;
        }
        .dataTables_scrollBody {
            width: 100% !important;
        }
        .dataTables_scrollHead {
            width: 100% !important;
        }
        .dataTables_scroll {
            width: 100% !important;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            padding: 12px 8px;
        }
        .table td {
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 8px;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-approved {
            background: #d1edff;
            color: #0c5460;
        }
        .status-reject {
            background: #f8d7da;
            color: #721c24;
        }
        .action-btn {
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.75rem;
            margin: 1px 0;
            display: block;
            min-width: 45px;
            text-align: center;
            border: none;
            transition: all 0.3s ease;
            line-height: 1.2;
        }
        .btn-view {
            background: #00796b;
            color: white;
        }
        .btn-view:hover {
            background: #005a52;
            color: white;
            transform: translateY(-1px);
        }
        .btn-edit {
            background: #ff9800;
            color: white;
        }
        .btn-edit:hover {
            background: #e68900;
            color: white;
            transform: translateY(-1px);
        }
        .actions-cell {
            min-width: 80px;
            white-space: nowrap;
            vertical-align: top;
            padding: 6px !important;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
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
                            <i class="fa fa-users me-2"></i>Beneficiary Performance Monitoring
                        </h1>
                        <p class="page-subtitle">Data Entry View - Manage beneficiary data</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('dataentry.add-beneficiary') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border: none; font-weight: 600;">
                            <i class="fa fa-plus me-2"></i>Add New Beneficiary
                        </a>
                        <a href="{{ route('dataentry.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="filter-buttons text-center">
                <a href="{{ route('dataentry.beneficiaries', ['status' => 'approved']) }}" 
                   class="btn btn-success filter-btn {{ $status === 'approved' ? 'active' : '' }}">
                    <i class="fa fa-check-circle me-2"></i>Approved Data
                </a>
                <a href="{{ route('dataentry.beneficiaries', ['status' => 'pending']) }}" 
                   class="btn btn-warning filter-btn {{ $status === 'pending' ? 'active' : '' }}">
                    <i class="fa fa-clock me-2"></i>Pending Data
                </a>
                <a href="{{ route('dataentry.beneficiaries', ['status' => 'reject']) }}" 
                   class="btn btn-danger filter-btn {{ $status === 'reject' ? 'active' : '' }}">
                    <i class="fa fa-times-circle me-2"></i>Rejected Data
                </a>
                <a href="{{ route('dataentry.beneficiaries', ['status' => 'all']) }}" 
                   class="btn btn-info filter-btn {{ $status === 'all' ? 'active' : '' }}">
                    <i class="fa fa-list me-2"></i>All Data
                </a>
            </div>

            <!-- Data Table -->
            <div class="data-card">
                <div class="table-responsive">
                    <table id="beneficiariesTable" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>Supervisor Status</th>
                                <th>Admin Status</th>
                                <th>Year</th>
                                <th>Quarter</th>
                                <th>Region</th>
                                <th>Activity</th>
                                <th>Intervention</th>
                                <th>Beneficiary</th>
                                <th>PWD</th>
                                <th>Youth</th>
                                <th>Female</th>
                                <th>Total Ben</th>
                                <th>Town/Village</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beneficiaries as $beneficiary)
                                <tr>
                                    <td>{{ $beneficiary->profile_id }}</td>
                                    <td class="actions-cell">
                                        <div class="d-flex flex-column gap-1">
                                            <a href="#" class="action-btn btn-view view-beneficiary" title="View Details" 
                                               data-id="{{ $beneficiary->profile_id }}">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            @if(strtolower(trim($beneficiary->status)) === 'pending' || strtolower(trim($beneficiary->status)) === 'reject')
                                                <a href="{{ route('dataentry.edit-beneficiary', $beneficiary->profile_id) }}" 
                                                   class="action-btn btn-edit" title="Edit">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($beneficiary->status) }}">
                                            {{ $beneficiary->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($beneficiary->admstatus) }}">
                                            {{ $beneficiary->admstatus }}
                                        </span>
                                    </td>
                                    <td>{{ $beneficiary->year }}</td>
                                    <td>{{ $beneficiary->proid }}</td>
                                    <td>{{ $beneficiary->regid }}</td>
                                    <td>{{ $beneficiary->activity }}</td>
                                    <td>{{ $beneficiary->intervenid }}</td>
                                    <td>{{ $beneficiary->benid }}</td>
                                    <td>{{ $beneficiary->npwd }}</td>
                                    <td>{{ $beneficiary->nyouth }}</td>
                                    <td>{{ $beneficiary->female }}</td>
                                    <td>{{ $beneficiary->beneficiary_no }}</td>
                                    <td>{{ $beneficiary->community }}</td>
                                    <td>{{ $beneficiary->contact }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Beneficiary Modal -->
    <div class="modal fade" id="viewBeneficiaryModal" tabindex="-1" aria-labelledby="viewBeneficiaryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: white;">
                    <h5 class="modal-title" id="viewBeneficiaryModalLabel">
                        <i class="fa fa-eye me-2"></i>Beneficiary Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="beneficiaryDetails">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading beneficiary details...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editBeneficiaryBtn" style="display: none;">
                        <i class="fa fa-edit me-2"></i>Edit Beneficiary
                    </button>
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
            $('#beneficiariesTable').DataTable({
                pageLength: 25,
                order: [[0, 'desc']],
                responsive: false,
                autoWidth: false,
                scrollX: true,
                scrollCollapse: true,
                language: {
                    search: "Search beneficiaries:",
                    lengthMenu: "Show _MENU_ beneficiaries per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ beneficiaries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                initComplete: function() {
                    // Force full width
                    $(this).DataTable().columns.adjust();
                    $('.dataTables_scroll').css('width', '100%');
                    $('.dataTables_scrollHead').css('width', '100%');
                    $('.dataTables_scrollBody').css('width', '100%');
                }
            });
            
            // Adjust columns on window resize
            $(window).resize(function() {
                $('#beneficiariesTable').DataTable().columns.adjust();
            });

            // Handle view beneficiary button click
            $(document).on('click', '.view-beneficiary', function(e) {
                e.preventDefault(); // Prevent default link behavior
                var id = $(this).data('id');
                viewBeneficiary(id);
            });
        });

        function viewBeneficiary(id) {
            // Show modal
            $('#viewBeneficiaryModal').modal('show');
            
            // Load beneficiary details via AJAX
            $.ajax({
                url: "{{ route('dataentry.view-beneficiary') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#beneficiaryDetails').html(response.html);
                    
                    // Show edit button if beneficiary can be edited
                    if (response.canEdit) {
                        $('#editBeneficiaryBtn').show().attr('onclick', 'window.location.href="' + response.editUrl + '"');
                    } else {
                        $('#editBeneficiaryBtn').hide();
                    }
                },
                error: function() {
                    $('#beneficiaryDetails').html(`
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle me-2"></i>Error loading beneficiary details.
                        </div>
                    `);
                }
            });
        }
    </script>
</body>
</html> 