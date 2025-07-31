<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Dashboard - ROOTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        .stats-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .stats-card.beneficiaries {
            border-left-color: #00796b;
        }
        .stats-card.activities {
            border-left-color: #00bcd4;
        }
        .stats-card.contracts {
            border-left-color: #ff9800;
        }
        .stats-card.trainings {
            border-left-color: #9c27b0;
        }
        .stats-card.pending {
            border-left-color: #f44336;
        }
        .stats-card.male {
            border-left-color: #2196f3;
        }
        .stats-card.female {
            border-left-color: #e91e63;
        }
        .stats-card.youth {
            border-left-color: #4caf50;
        }
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 15px;
        }
        .stats-icon.beneficiaries {
            background: linear-gradient(135deg, #00796b, #00bcd4);
        }
        .stats-icon.activities {
            background: linear-gradient(135deg, #00bcd4, #00796b);
        }
        .stats-icon.contracts {
            background: linear-gradient(135deg, #ff9800, #ff5722);
        }
        .stats-icon.trainings {
            background: linear-gradient(135deg, #9c27b0, #673ab7);
        }
        .stats-icon.pending {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }
        .stats-icon.male {
            background: linear-gradient(135deg, #2196f3, #1976d2);
        }
        .stats-icon.female {
            background: linear-gradient(135deg, #e91e63, #c2185b);
        }
        .stats-icon.youth {
            background: linear-gradient(135deg, #4caf50, #388e3c);
        }
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .stats-label {
            font-size: 1rem;
            color: #7f8c8d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .welcome-section {
            background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .user-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
        .user-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .user-info-item:last-child {
            margin-bottom: 0;
        }
        .user-info-icon {
            width: 20px;
            margin-right: 10px;
            opacity: 0.8;
        }
        .page-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 30px;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .nav-card {
            background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .nav-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .nav-card.indicator {
            background: linear-gradient(135deg, #00bcd4 0%, #00796b 100%);
        }
        .nav-card.contract {
            background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%);
        }
        .nav-card.training {
            background: linear-gradient(135deg, #9c27b0 0%, #673ab7 100%);
        }
        .nav-icon {
            margin-bottom: 15px;
        }
        .nav-icon i {
            font-size: 2.5rem;
        }
        .nav-title {
            font-weight: 600;
            margin-bottom: 10px;
        }
        .nav-description {
            opacity: 0.9;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .nav-actions .btn {
            font-size: 0.8rem;
            padding: 0.375rem 0.75rem;
        }
    </style>
</head>
<body>
    @include('admin.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1 class="welcome-title">Welcome back, {{ session('dataentry_name') }}!</h1>
                <p class="welcome-subtitle">Here's an overview of your data entry activities and system statistics.</p>
                
                <div class="user-info">
                    <div class="user-info-item">
                        <i class="fa fa-envelope user-info-icon"></i>
                        <span>{{ session('dataentry_email') }}</span>
                    </div>
                    <div class="user-info-item">
                        <i class="fa fa-map-marker-alt user-info-icon"></i>
                        <span>Region: {{ session('dataentry_region') }}</span>
                    </div>
                    <div class="user-info-item">
                        <i class="fa fa-clock user-info-icon"></i>
                        <span>Last Login: {{ now()->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card beneficiaries">
                        <div class="stats-icon beneficiaries">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_beneficiaries']) }}</div>
                        <div class="stats-label">Total Beneficiaries</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card activities">
                        <div class="stats-icon activities">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_activities']) }}</div>
                        <div class="stats-label">Total Activities</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card contracts">
                        <div class="stats-icon contracts">
                            <i class="fa fa-file-contract"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_contracts']) }}</div>
                        <div class="stats-label">Total Contracts</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card trainings">
                        <div class="stats-icon trainings">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['total_trainings']) }}</div>
                        <div class="stats-label">Total Trainings</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card pending">
                        <div class="stats-icon pending">
                            <i class="fa fa-clock"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['pending_approvals']) }}</div>
                        <div class="stats-label">Pending Approvals</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card male">
                        <div class="stats-icon male">
                            <i class="fa fa-male"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['male_beneficiaries']) }}</div>
                        <div class="stats-label">Male Beneficiaries</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card female">
                        <div class="stats-icon female">
                            <i class="fa fa-female"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['female_beneficiaries']) }}</div>
                        <div class="stats-label">Female Beneficiaries</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card youth">
                        <div class="stats-icon youth">
                            <i class="fa fa-child"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['youth_beneficiaries']) }}</div>
                        <div class="stats-label">Youth Beneficiaries</div>
                    </div>
                </div>
            </div>

            <!-- Data Entry Navigation -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: white;">
                            <h5 class="mb-0"><i class="fa fa-compass me-2"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Beneficiary Section -->
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="nav-card" data-href="{{ route('dataentry.beneficiaries') }}">
                                        <div class="nav-icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h5 class="nav-title">Beneficiary</h5>
                                        <p class="nav-description">Manage beneficiary data, add new beneficiaries, and view existing records</p>
                                        <div class="nav-actions">
                                            <a href="{{ route('dataentry.beneficiaries') }}" class="btn btn-light btn-sm me-2">
                                                <i class="fa fa-list me-1"></i>View All
                                            </a>
                                            <a href="{{ route('dataentry.add-beneficiary') }}" class="btn btn-outline-light btn-sm">
                                                <i class="fa fa-plus me-1"></i>Add New
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Indicator Section -->
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="nav-card indicator" data-href="{{ route('dataentry.indicators') }}">
                                        <div class="nav-icon">
                                            <i class="fa fa-chart-line"></i>
                                        </div>
                                        <h5 class="nav-title">Indicator</h5>
                                        <p class="nav-description">Manage performance indicators, track metrics, and monitor progress</p>
                                        <div class="nav-actions">
                                            <a href="{{ route('dataentry.indicators') }}" class="btn btn-light btn-sm me-2">
                                                <i class="fa fa-list me-1"></i>View All
                                            </a>
                                            <a href="{{ route('dataentry.add-indicator') }}" class="btn btn-outline-light btn-sm">
                                                <i class="fa fa-plus me-1"></i>Add New
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contract Section -->
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="nav-card contract" data-href="{{ route('dataentry.contracts') }}">
                                        <div class="nav-icon">
                                            <i class="fa fa-file-contract"></i>
                                        </div>
                                        <h5 class="nav-title">Contract</h5>
                                        <p class="nav-description">Manage contracts, agreements, and partnership documents</p>
                                        <div class="nav-actions">
                                            <a href="{{ route('dataentry.contracts') }}" class="btn btn-light btn-sm me-2">
                                                <i class="fa fa-list me-1"></i>View All
                                            </a>
                                            <a href="{{ route('dataentry.add-contract') }}" class="btn btn-outline-light btn-sm">
                                                <i class="fa fa-plus me-1"></i>Add New
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Training Section -->
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="nav-card training" data-href="{{ route('dataentry.trainings') }}">
                                        <div class="nav-icon">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <h5 class="nav-title">Training</h5>
                                        <p class="nav-description">Manage training programs, schedules, and participant records</p>
                                        <div class="nav-actions">
                                            <a href="{{ route('dataentry.trainings') }}" class="btn btn-light btn-sm me-2">
                                                <i class="fa fa-list me-1"></i>View All
                                            </a>
                                            <a href="{{ route('dataentry.add-training') }}" class="btn btn-outline-light btn-sm">
                                                <i class="fa fa-plus me-1"></i>Add New
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle nav-card clicks
            $(document).on('click', '.nav-card', function(e) {
                // Don't trigger if clicking on buttons inside the card
                if ($(e.target).closest('.nav-actions').length === 0) {
                    const href = $(this).data('href');
                    if (href && href !== '#') {
                        window.location.href = href;
                    }
                }
            });
        });
    </script>
</body>
</html> 