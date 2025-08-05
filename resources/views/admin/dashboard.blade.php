<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROOTS Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #f4f8fb;
            font-family: 'PT Sans', sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
        }

        .navbar-nav .nav-link,
        .navbar-nav .dropdown-toggle {
            color: #fff !important;
            font-weight: 500;
            margin-right: 8px;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .dropdown-toggle:hover,
        .navbar-nav .nav-link.active {
            color: #e0f7fa !important;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .dropdown-item {
            font-weight: 500;
        }

        .dropdown-item:hover,
        .dropdown-item.active {
            background: #00bcd4;
            color: #fff;
        }

        .admin-name {
            color: #fff;
            font-weight: 600;
            margin-left: 16px;
        }

        .main-content {
            padding: 40px 30px;
        }

        .dashboard-widgets {
            margin-bottom: 40px;
        }

        .widget-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .widget-card .widget-icon {
            font-size: 2.5rem;
            color: #00bcd4;
            margin-bottom: 10px;
        }

        .widget-card .widget-title {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 5px;
        }

        .widget-card .widget-value {
            font-size: 2rem;
            font-weight: 700;
            color: #00796b;
        }
    </style>
</head>

<body>
    <!-- Single Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/roots-logo.png') }}" alt="ROOTS Logo" style="height: 45px; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- User Management -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMgmtDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-users"></i> User Management
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userMgmtDropdown">
                            <li><a class="dropdown-item" href="{{ url('/admin/add-admin') }}">Add Admin</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/add-supervisor') }}">Add Supervisor</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/add-finance') }}">Add Finance user</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/add-dataentry') }}">Add Data Entry</a></li>
                        </ul>
                    </li>
                    <!-- Item Types -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="itemTypesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-tachometer-alt"></i> Item Types
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="itemTypesDropdown">
                            <li><a class="dropdown-item" href="{{ url('/admin/contract-types') }}">Contract Types</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/indicator-types') }}">Indicator Types</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/indicator-descriptions') }}">Indicator Descriptions</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/intervention-types') }}">Intervention Types</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/training-types') }}">Training Types</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/beneficiary-types') }}">Beneficiary Types</a></li>
                        </ul>
                    </li>
                    <!-- Key Variables -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="keyVarsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-table"></i> Key Variables
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="keyVarsDropdown">
                            <li><a class="dropdown-item" href="{{ url('/admin/imp-partners') }}">Imp Partners</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/regions') }}">Regions</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/activities') }}">Activities</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/indicator-frequencies') }}">Indicator Reporting Frequencies</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/activity-status') }}">Activities Status</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/units-measurement') }}">Units Measurement</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/persons') }}">Persons</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/contractors') }}">Contractors</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.venues') }}">Venue</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.payment-modes') }}">Payment Modes</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.payment-tranches') }}">Payment Tranches</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.project-frequencies') }}">Project Reporting Frequencies</a></li>
                        </ul>
                    </li>
                    <!-- Components & Sub-Components -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="compsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-layer-group"></i> Comp & SubComp
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="compsDropdown">
                            <li><a class="dropdown-item" href="{{ url('/admin/components') }}">Components</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/sub-components') }}">Sub Components</a></li>
                        </ul>
                    </li>
                    <!-- Quality Checks -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="qualityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-check-circle"></i> Quality Checks
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="qualityDropdown">
                            <li><a class="dropdown-item" href="{{ url('/admin/indicator-performance') }}">Indicator Performance</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/beneficiary-performance') }}">Beneficiary Performance</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/disbursement-performance') }}">Disbursement Performance</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/contract-performance') }}">Contract/MOU Performance</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/training-performance') }}">Training Performance</a></li>
                        </ul>
                    </li>
                    <!-- General Reports -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-file-alt"></i> General Reports
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                            <li><a class="dropdown-item" href="{{ url('/admin/beneficiaries-new') }}">Beneficiaries new</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/indicators') }}">Indicators</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/beneficiaries') }}">Beneficiaries</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/contracts') }}">Contract/MOUs</a></li>
                            <li><a class="dropdown-item" href="{{ url('/admin/trainings') }}">Trainings</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- User Menu -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-1"></i>{{ session('admin_name') ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-user-cog me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row dashboard-widgets">
            <div class="col-md-3">
                <div class="widget-card">
                    <div class="widget-icon"><i class="fa fa-users"></i></div>
                    <div class="widget-title">Total Users</div>
                    <div class="widget-value">{{ $stats['total_users'] ?? '...' }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-card">
                    <div class="widget-icon"><i class="fa fa-users"></i></div>
                    <div class="widget-title">Beneficiaries</div>
                    <div class="widget-value">{{ $stats['total_beneficiaries'] ?? '...' }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-card">
                    <div class="widget-icon"><i class="fa fa-tasks"></i></div>
                    <div class="widget-title">Activities</div>
                    <div class="widget-value">{{ $stats['total_activities'] ?? '...' }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-card">
                    <div class="widget-icon"><i class="fa fa-map-marker-alt"></i></div>
                    <div class="widget-title">Regions</div>
                    <div class="widget-value">{{ $stats['total_regions'] ?? '...' }}</div>
                </div>
            </div>
        </div>
        <!-- Add more dashboard content here -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>