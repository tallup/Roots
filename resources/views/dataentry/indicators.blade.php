<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indicators - ROOTS Data Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
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
        .form-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .status-filter {
            margin-bottom: 30px;
        }
        .status-btn {
            padding: 12px 24px;
            margin: 0 10px 10px 0;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .status-btn.approved {
            background: linear-gradient(135deg, #4caf50, #45a049);
            color: white;
        }
        .status-btn.pending {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
        }
        .status-btn.rejected {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
        }
        .status-btn.all {
            background: linear-gradient(135deg, #2196f3, #1976d2);
            color: white;
        }
        .status-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .status-badge.approved {
            background-color: #d4edda;
            color: #155724;
        }
        .status-badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-badge.reject {
            background-color: #f8d7da;
            color: #721c24;
        }
        .action-btn {
            padding: 4px 8px;
            margin: 1px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            min-width: 50px;
            text-align: center;
            transition: all 0.3s ease;
        }
        .action-btn.view {
            background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
            color: white;
        }
        .action-btn.edit {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            color: white;
        }
        .action-btn.reject {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            color: white;
        }
        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            color: white;
            text-decoration: none;
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
        }
        #indicatorsTable {
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
            padding: 10px 6px;
            font-size: 0.9rem;
        }
        .table td {
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
            padding: 8px 6px;
            font-size: 0.9rem;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .gap-1 {
            gap: 0.25rem;
        }
        .d-flex {
            display: flex;
        }
    </style>
</head>
<body>
    @include('admin.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="page-title">
                            <i class="fa fa-chart-line me-2"></i>Indicator Performance Monitoring
                        </h1>
                        <p class="page-subtitle">Data Entry View - Manage indicator data</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('dataentry.add-indicator') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border: none; font-weight: 600;">
                            <i class="fa fa-plus me-2"></i>Add New Indicator
                        </a>
                        <a href="{{ route('dataentry.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="filter-buttons text-center">
                <a href="{{ route('dataentry.indicators', ['status' => 'approved']) }}" 
                   class="btn btn-success filter-btn {{ $status === 'approved' ? 'active' : '' }}">
                    <i class="fa fa-check-circle me-2"></i>Approved Data
                </a>
                <a href="{{ route('dataentry.indicators', ['status' => 'pending']) }}" 
                   class="btn btn-warning filter-btn {{ $status === 'pending' ? 'active' : '' }}">
                    <i class="fa fa-clock me-2"></i>Pending Data
                </a>
                <a href="{{ route('dataentry.indicators', ['status' => 'reject']) }}" 
                   class="btn btn-danger filter-btn {{ $status === 'reject' ? 'active' : '' }}">
                    <i class="fa fa-times-circle me-2"></i>Rejected Data
                </a>
                <a href="{{ route('dataentry.indicators', ['status' => 'all']) }}" 
                   class="btn btn-info filter-btn {{ $status === 'all' ? 'active' : '' }}">
                    <i class="fa fa-list me-2"></i>All Data
                </a>
            </div>

            <!-- Data Table -->
            <div class="data-card">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="indicatorsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>Status</th>
                                <th>Year</th>
                                <th>Quarter</th>
                                <th>Indicator Type</th>
                                <th>Indicator Description</th>
                                <th>Category</th>
                                <th>Baseline</th>
                                <th>Target</th>
                                <th>Achieved</th>
                                <th>% Achievement</th>
                                <th>Measurement</th>
                                <th>Frequency</th>
                                <th>Remarks</th>
                                <th>Added By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($indicators as $indicator)
                                <tr>
                                    <td>{{ $indicator->indicator_id }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="action-btn view view-indicator" data-id="{{ $indicator->indicator_id }}" title="View Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if(strtolower(trim($indicator->status)) === 'pending' || strtolower(trim($indicator->status)) === 'reject')
                                                <a href="{{ route('dataentry.edit-indicator', $indicator->indicator_id) }}" class="action-btn edit" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ strtolower(trim($indicator->status)) }}">
                                            {{ $indicator->status ?? 'pending' }}
                                        </span>
                                    </td>
                                    <td>{{ $indicator->year }}</td>
                                    <td>{{ $indicator->proId }}</td>
                                    <td>{{ $indicator->indicator_type }}</td>
                                    <td>{{ $indicator->description }}</td>
                                    <td>{{ $indicator->icat }}</td>
                                    <td>{{ $indicator->baseline }}</td>
                                    <td>{{ number_format($indicator->target) }}</td>
                                    <td>{{ number_format($indicator->acheived) }}</td>
                                    <td>{{ number_format($indicator->acheivement, 2) }}%</td>
                                    <td>{{ $indicator->measuId }}</td>
                                    <td>{{ $indicator->data }}</td>
                                    <td>{{ $indicator->rmk }}</td>
                                    <td>
                                        @if($indicator->added_by_name)
                                            {{ $indicator->added_by_name }}
                                        @elseif($indicator->addedby)
                                            Unknown (ID: {{ $indicator->addedby }})
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

                <!-- Pagination -->
                {{-- Removed Laravel paginator links --}}
            </div>
        </div>
    </div>

    <!-- Indicator Details Modal -->
    <div class="modal fade" id="indicatorModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: white;">
                    <h5 class="modal-title">
                        <i class="fa fa-chart-line me-2"></i>Indicator Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="indicatorModalBody">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading indicator details...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editIndicatorBtn" style="display: none;">
                        <i class="fa fa-edit me-2"></i>Edit Indicator
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#indicatorsTable').DataTable({
                pageLength: 25,
                order: [[0, 'desc']],
                displayStart: 0,
                responsive: false,
                autoWidth: false,
                scrollX: true,
                scrollCollapse: true,
                language: {
                    search: "Search indicators:",
                    lengthMenu: "Show _MENU_ indicators per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ indicators",
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
                $('#indicatorsTable').DataTable().columns.adjust();
            });

            // Handle view indicator button click
            $(document).on('click', '.view-indicator', function(e) {
                e.preventDefault(); // Prevent default link behavior
                const id = $(this).data('id');
                viewIndicator(id);
            });
        });

        function viewIndicator(id) {
            // Show modal
            $('#indicatorModal').modal('show');
            
            // Load indicator details via AJAX
            $.ajax({
                url: "{{ route('dataentry.view-indicator') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#indicatorModalBody').html(response.html);
                    
                    // Show edit button if indicator can be edited
                    if (response.canEdit) {
                        $('#editIndicatorBtn').show().attr('onclick', 'window.location.href="' + response.editUrl + '"');
                    } else {
                        $('#editIndicatorBtn').hide();
                    }
                },
                error: function(xhr) {
                    $('#indicatorModalBody').html(`
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle me-2"></i>Error loading indicator details.
                        </div>
                    `);
                }
            });
        }
    </script>
</body>
</html> 