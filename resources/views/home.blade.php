<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROOTS || Home Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amaranth:wght@400;700&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/roots-logo.png') }}" type="image/png">

    <style>
        :root {
            --primary-color: #28a745;
            --secondary-color: #17a2b8;
            --accent-color: #6f42c1;
            --dark-color: #343a40;
        }

        body {
            font-family: 'PT Sans', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .header-brand {
            font-family: 'Amaranth', sans-serif;
            font-weight: 700;
            color: white;
            text-decoration: none;
            font-size: 2.5rem;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="world" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23world)"/></svg>');
            opacity: 0.3;
        }

        .nav-link {
            color: white !important;
            font-weight: 600;
            padding: 15px 20px;
            border-radius: 10px;
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .module-btn {
            background: linear-gradient(45deg, var(--accent-color), var(--secondary-color));
            border: none;
            border-radius: 15px;
            padding: 15px 25px;
            margin: 25px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .module-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .module-btn a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            margin: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-circle {
            width: 120px;
            height: 120px;
            border: 4px solid var(--primary-color);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            background: white;
        }

        .logo-circle i {
            font-size: 3rem;
            color: var(--primary-color);
        }

        .system-title {
            font-family: 'Amaranth', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .system-subtitle {
            font-size: 1.3rem;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            border-top: 2px solid var(--primary-color);
            color: var(--dark-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }

            .main-content {
                margin: 10px;
                padding: 20px;
            }

            .system-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4 sidebar position-relative">
                <div class="position-relative z-index-1 p-4">
                    <div class="text-center mb-5">
                        <a href="/" class="header-brand">ROOTS M&E</a>
                    </div>

                    <nav class="nav flex-column">
                        <!-- <a class="nav-link active" href="/">
                            <i class="fas fa-home me-2"></i>Home
                        </a> -->

                        <div class="module-btn">
                            <a href="/admin">
                                <i class="fas fa-user-shield me-2"></i>Administrator
                            </a>
                        </div>

                        <div class="module-btn">
                            <a href="/supervisor/login">
                                <i class="fas fa-user-tie me-2"></i>Supervisor
                            </a>
                        </div>

                        <div class="module-btn">
                            <a href="/data-entry">
                                <i class="fas fa-edit me-2"></i>Data Entry
                            </a>
                        </div>

                        <div class="module-btn">
                            <a href="/finance/login">
                                <i class="fas fa-chart-line me-2"></i>Financial Module
                            </a>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <div class="main-content">
                    <div class="logo-container">
                        <div class="logo-circle">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h1 class="system-title">ROOTS</h1>
                        <p class="text-muted mb-0">Resilience of Organisations for Transformation</p>
                        <p class="text-muted">Smallholder Agriculture Project</p>
                    </div>

                    <div class="text-center mb-5">
                        <h2 class="system-subtitle">
                            <span class="text-primary">ROOTS Management</span><br>
                            <span class="text-primary">Information System For</span><br>
                            <span class="text-info">Planning, Monitoring,</span><br>
                            <span class="text-info">Evaluation And Learning</span>
                        </h2>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Beneficiary Management</h5>
                                    <p class="card-text">Manage beneficiary profiles, data entry, and approval workflows.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-bar fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Monitoring & Evaluation</h5>
                                    <p class="card-text">Track project indicators, components, and performance metrics.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marker-alt fa-3x text-info mb-3"></i>
                                    <h5 class="card-title">Regional Management</h5>
                                    <p class="card-text">Region-based access control and data management.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-invoice-dollar fa-3x text-warning mb-3"></i>
                                    <h5 class="card-title">Financial Tracking</h5>
                                    <p class="card-text">Monitor disbursements, transactions, and financial performance.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="footer">
                        <p class="mb-0">
                            <i class="fas fa-copyright me-2"></i>
                            Information systems for Monitoring and Evaluation @ 2024
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add active class to current nav item
        const currentLocation = location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.getAttribute('href') === currentLocation) {
                link.classList.add('active');
            }
        });
    </script>
</body>

</html>