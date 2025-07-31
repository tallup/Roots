<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard - ROOTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'PT Sans', sans-serif;
        }
        .main-content {
            padding: 30px 0;
            margin-left: var(--finance-sidebar-width);
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
        .stats-card.transactions {
            border-left-color: #00796b;
        }
        .stats-card.components {
            border-left-color: #00bcd4;
        }
        .stats-card.disbursements {
            border-left-color: #ff9800;
        }
        .stats-card.subcomponents {
            border-left-color: #9c27b0;
        }
        .stats-card.allocation {
            border-left-color: #f44336;
        }
        .stats-card.balance {
            border-left-color: #2196f3;
        }
        .stats-card.pending {
            border-left-color: #e91e63;
        }
        .stats-card.accounts {
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
        .stats-icon.transactions {
            background: linear-gradient(135deg, #00796b, #00bcd4);
        }
        .stats-icon.components {
            background: linear-gradient(135deg, #00bcd4, #00796b);
        }
        .stats-icon.disbursements {
            background: linear-gradient(135deg, #ff9800, #ff5722);
        }
        .stats-icon.subcomponents {
            background: linear-gradient(135deg, #9c27b0, #673ab7);
        }
        .stats-icon.allocation {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }
        .stats-icon.balance {
            background: linear-gradient(135deg, #2196f3, #1976d2);
        }
        .stats-icon.pending {
            background: linear-gradient(135deg, #e91e63, #c2185b);
        }
        .stats-icon.accounts {
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
            background: linear-gradient(135deg, #0097a7 0%, #00bcd4 100%);
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
    </style>
</head>
<body>
    @include('finance.partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container" style="max-width: 1100px;">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1 class="welcome-title">Welcome back, {{ session('finance_name') ?? 'Finance User' }}!</h1>
                <p class="welcome-subtitle">Here's an overview of your finance activities and system statistics.</p>
                
                <div class="user-info">
                    <div class="user-info-item">
                        <i class="fa fa-envelope user-info-icon"></i>
                        <span>{{ session('finance_email') ?? 'N/A' }}</span>
                    </div>
                    <div class="user-info-item">
                        <i class="fa fa-clock user-info-icon"></i>
                        <span>Last Login: {{ now()->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- First Row of Statistics -->
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stats-card transactions">
                        <div class="stats-icon transactions">
                            <i class="fa fa-exchange-alt"></i>
                        </div>
                        <div class="stats-number">{{ number_format($total_transactions) }}</div>
                        <div class="stats-label">Total Transactions</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stats-card components">
                        <div class="stats-icon components">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="stats-number">{{ number_format($total_components) }}</div>
                        <div class="stats-label">Total Components</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stats-card disbursements">
                        <div class="stats-icon disbursements">
                            <i class="fa fa-hand-holding-usd"></i>
                        </div>
                        <div class="stats-number">{{ number_format($total_disbursements) }}</div>
                        <div class="stats-label">Total Disbursements</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stats-card subcomponents">
                        <div class="stats-icon subcomponents">
                            <i class="fa fa-layer-group"></i>
                        </div>
                        <div class="stats-number">{{ number_format($total_subcomponents) }}</div>
                        <div class="stats-label">Total Subcomponents</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stats-card allocation">
                        <div class="stats-icon allocation">
                            <i class="fa fa-money-bill-wave"></i>
                        </div>
                        <div class="stats-number">{{ number_format($total_allocation) }}</div>
                        <div class="stats-label">Total Allocation</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stats-card balance">
                        <div class="stats-icon balance">
                            <i class="fa fa-balance-scale"></i>
                        </div>
                        <div class="stats-number">{{ number_format($total_balance) }}</div>
                        <div class="stats-label">Total Balance</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>