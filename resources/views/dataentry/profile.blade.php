<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Data Entry Officer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'PT Sans', sans-serif; }
        .navbar { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; margin-right: 0 !important; padding-left: 0 !important; text-align: left; }
        .nav-link { color: rgba(255,255,255,0.9) !important; font-weight: 500; font-size: 1.1rem; padding: 0.75rem 1.25rem !important; margin: 0 0.25rem; border-radius: 8px; transition: all 0.3s ease; }
        .nav-link:hover { color: white !important; background-color: rgba(255,255,255,0.1); transform: translateY(-2px); }
        .nav-link.active { background-color: rgba(255,255,255,0.2); color: white !important; font-weight: 600; }
        .nav-link i { font-size: 1.2rem; margin-right: 0.5rem; }
        .main-content { padding: 30px 0; }
        .profile-card { background: white; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.10); padding: 48px 36px 36px 36px; max-width: 600px; margin: 48px auto; border: 3px solid; border-image: linear-gradient(135deg, #00796b 0%, #00bcd4 100%) 1; position: relative; transition: box-shadow 0.3s; }
        .profile-card:hover { box-shadow: 0 10px 32px rgba(0, 188, 212, 0.18); }
        .profile-avatar { position: absolute; top: -40px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(0,0,0,0.10); border: 4px solid #fff; }
        .profile-avatar i { color: #fff; font-size: 2.5rem; }
        .profile-title { color: #00796b; font-weight: 800; margin-bottom: 32px; text-align: center; margin-top: 56px; font-size: 2.2rem; letter-spacing: 1px; }
        .profile-info-table { width: 100%; margin: 0 auto; }
        .profile-info-table td { padding: 12px 8px; vertical-align: middle; font-size: 1.08rem; }
        .profile-info-table td.label { color: #0097a7; font-weight: 600; width: 38%; text-align: right; }
        .profile-info-table td.value { color: #2c3e50; font-weight: 500; text-align: left; }
        .profile-info-table td i { color: #00bcd4; margin-right: 8px; font-size: 1.15rem; vertical-align: middle; }
        @media (max-width: 767px) {
            .profile-card { padding: 32px 8px 24px 8px; }
            .profile-title { font-size: 1.3rem; margin-top: 48px; }
            .profile-info-table td { font-size: 0.98rem; }
            .profile-info-table td.label { width: 45%; }
        }
    </style>
</head>
<body>
    @include('admin.partials.navbar')
    <div class="main-content">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow-lg border-0" style="max-width: 600px; width: 100%; padding: 2.5rem 2.5rem 2rem 2.5rem; border-radius: 2rem;">
                <div class="d-flex flex-column align-items-center mb-4">
                    <div class="bg-info d-flex align-items-center justify-content-center rounded-circle shadow" style="width: 100px; height: 100px; margin-top: -70px; border: 6px solid #fff;">
                        <i class="fa fa-user fa-3x text-white"></i>
                    </div>
                    <h2 class="fw-bold mt-3 mb-1" style="font-size: 2.2rem; color: #00796b;">My Profile</h2>
                </div>
                <div class="row g-4 mb-2">
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-id-badge me-2"></i>ID</div>
                        <div class="fs-5">{{ $user->ID ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-map-marker-alt me-2"></i>Region</div>
                        <div class="fs-5">{{ $user->region_name ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-user me-2"></i>Name</div>
                        <div class="fs-5">{{ $user->CompanyName ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-building me-2"></i>Company</div>
                        <div class="fs-5">{{ $user->CompanyName ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-envelope me-2"></i>Email</div>
                        <div class="fs-5">{{ $user->Email ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-calendar-plus me-2"></i>Creation Date</div>
                        <div class="fs-5">{{ $user->CreationDate ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-phone me-2"></i>Phone</div>
                        <div class="fs-5">{{ $user->Workphnumber ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="fw-bold text-secondary mb-1"><i class="fa fa-sign-in-alt me-2"></i>Last Login</div>
                        <div class="fs-5">{{ $user->last_login ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 