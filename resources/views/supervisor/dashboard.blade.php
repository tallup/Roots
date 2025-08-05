<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard - ROOTS</title>
    <link rel="icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'PT Sans', sans-serif;
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
    </style>
</head>

<body>
    @include('supervisor.partials.navbar')
    <div class="main-content">
        <div class="container">
            <!-- Welcome Section -->
            <div class="rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, #0097a7 0%, #00bcd4 100%); color: #fff;">
                <h2 class="fw-bold mb-2">Welcome back, {{ session('supervisor_name') }}!</h2>
                <div class="mb-2">Here's an overview of your supervisor activities and system statistics.</div>
                <div class="p-3 rounded-3" style="background: rgba(0,0,0,0.08); max-width: 420px;">
                    <div class="mb-1"><i class="fa fa-envelope me-2"></i>{{ session('supervisor_email') }}</div>
                    <div class="mb-1"><i class="fa fa-map-marker-alt me-2"></i>Region: {{ session('supervisor_region') }}</div>
                    <div><i class="fa fa-clock me-2"></i>Last Login: {{ session('supervisor_last_login') ?? 'N/A' }}</div>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card beneficiaries">
                        <div class="stats-icon beneficiaries">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="stats-number">{{ number_format($total_beneficiaries) }}</div>
                        <div class="stats-label">Beneficiary Profile</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card activities">
                        <div class="stats-icon activities">
                            <i class="fa fa-chart-line"></i>
                        </div>
                        <div class="stats-number">{{ number_format($indicators ?? 0) }}</div>
                        <div class="stats-label">Indicator</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card contracts">
                        <div class="stats-icon contracts">
                            <i class="fa fa-file-contract"></i>
                        </div>
                        <div class="stats-number">{{ number_format($contracts ?? 0) }}</div>
                        <div class="stats-label">Contract</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card trainings">
                        <div class="stats-icon trainings">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="stats-number">{{ number_format($trainings ?? 0) }}</div>
                        <div class="stats-label">Training</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full width grid -->
        <div class="container-fluid">
            <div class="card border-0 shadow-sm mb-4 w-100" style="border-radius: 1.25rem;">
                <div class="card-header bg-white border-0 fw-bold fs-5" style="border-radius: 1.25rem 1.25rem 0 0;">Recent Beneficiaries</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Region</th>
                                    <th>Activity</th>
                                    <th>Intervention</th>
                                    <th>Beneficiary</th>
                                    <th>Town/Village</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_beneficiaries as $ben)
                                <tr>
                                    <td>{{ $ben->regid }}</td>
                                    <td>{{ $ben->activity }}</td>
                                    <td>{{ $ben->intervenid }}</td>
                                    <td>{{ $ben->beneficiary_no }}</td>
                                    <td>{{ $ben->community }}</td>
                                    <td>{{ $ben->contact }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No recent beneficiaries found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>