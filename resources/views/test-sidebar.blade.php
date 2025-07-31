<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sidebar Flyout Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f8fb; }
        .sidebar-fixed {
            position: fixed;
            top: 0; left: 0;
            width: 260px; height: 100vh;
            background: #fff; color: #218838;
            border-right: 1px solid #e0e0e0;
            z-index: 9999 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            overflow-y: auto;
        }
        .sidebar-main-item { margin-bottom: 18px; position: relative; }
        .sidebar-flyout {
            display: none;
            position: absolute;
            left: 100%; top: 0;
            min-width: 200px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            z-index: 10000 !important;
            padding: 10px 0;
        }
        .sidebar-main-item:hover > .sidebar-flyout,
        .sidebar-main-item:focus-within > .sidebar-flyout {
            display: block;
        }
        .main-content-fixed {
            margin-left: 260px;
            padding: 40px 30px;
            background: transparent;
        }
        .add-admin-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            padding: 40px 30px;
            margin: 40px auto;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="sidebar-fixed d-flex flex-column p-3">
        <div class="text-center mb-3">
            <img src="/images/roots-logo.png" alt="ROOTS Logo" style="width: 80px; height: 80px; border-radius: 50%; background: #fff; margin-bottom: 10px;">
            <div class="fw-bold fs-5" style="color: #218838;">ROOTS M&E</div>
            <div class="mt-2" style="font-size: 1rem; color: #17a2b8;">Admin User</div>
        </div>
        <hr style="border-color: #17a2b8;">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="sidebar-main-item">
                <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;">
                    <i class="fa fa-users me-2" style="color: #17a2b8;"></i>User Management
                </a>
                <div class="sidebar-flyout">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                        <li><a href="#" class="nav-link sidebar-link">Add Admin</a></li>
                        <li><a href="#" class="nav-link sidebar-link">Profile</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="main-content-fixed">
        <div class="add-admin-container">
            <h2 class="form-title">Add Admin User</h2>
            <p>Test form content here. Hover over "User Management" to see the flyout.</p>
        </div>
    </div>
</body>
</html> 