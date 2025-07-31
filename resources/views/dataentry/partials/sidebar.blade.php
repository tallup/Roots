<style>
    .sidebar-fixed {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        max-height: 100vh;
        background: #fff;
        color: #218838;
        border-right: 1px solid #e0e0e0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
        overflow-y: auto;
    }

    .sidebar-link {
        color: #218838 !important;
        font-weight: 500;
        border-radius: 6px;
        transition: background 0.2s, color 0.2s;
    }

    .sidebar-link:hover,
    .sidebar-link:focus {
        background: #e6f4ea !important;
        color: #17a2b8 !important;
    }

    .sidebar-main-item {
        margin-bottom: 18px;
        position: relative;
    }

    .sidebar-flyout {
        display: none;
        position: static;
        min-width: 180px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        border: 1px solid #e0e0e0;
        padding: 8px 0;
        margin-top: 4px;
    }

    .sidebar-main-item:hover>.sidebar-flyout,
    .sidebar-main-item:focus-within>.sidebar-flyout {
        display: block;
    }

    .sidebar-main-item>.nav-link:after {
        content: '\f105';
        font-family: 'FontAwesome';
        /* float: right; */
        color: #17a2b8;
        font-size: 1rem;
        margin-left: 8px;
    }

    @media (max-width: 991px) {
        .sidebar-fixed {
            position: static;
            width: 100%;
            height: auto;
            border-right: none;
            box-shadow: none;
        }

        .sidebar-flyout {
            /* position: static; */
            left: auto;
            top: auto;
            min-width: 180px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            border: 1px solid #e0e0e0;
            padding: 8px 0;
            margin-top: 4px;
            display: block;
        }

        .sidebar-main-item>.nav-link:after {
            display: none;
        }
    }

    .sidebar-main-item>.nav-link {
        display: block;
        padding: 12px 18px;
        margin-bottom: 8px;
        background: #fff;
        color: #218838 !important;
        font-weight: 600;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        text-align: left;
        cursor: pointer;
    }

    .sidebar-main-item>.nav-link:hover,
    .sidebar-main-item>.nav-link:focus {
        background: #e6f4ea !important;
        color: #17a2b8 !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        border-color: #17a2b8;
    }

    .sidebar-main-item.active>.sidebar-flyout {
        display: block;
    }
</style>

<div class="sidebar-fixed d-flex flex-column flex-shrink-0 p-3">
    <div class="text-center mb-3">
        <img src="/images/roots-logo.png" alt="ROOTS Logo" style="width: 80px; height: 80px; border-radius: 50%; background: #fff; margin-bottom: 10px;">
        <div class="fw-bold fs-5" style="color: #218838;">ROOTS M&E</div>
        <div class="mt-2" style="font-size: 1rem; color: #17a2b8;">
            {{ session('admin_name') ?? 'Admin User' }}
        </div>
    </div>
    <hr style="border-color: #17a2b8;">
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- User Management -->
        <li class="sidebar-main-item">
            <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;"> <i class="fa fa-users me-2" style="color: #17a2b8;"></i>User Management</a>
            <div class="sidebar-flyout">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                    <li><a href="{{ url('/admin/add-admin') }}" class="nav-link sidebar-link">Add Admin</a></li>
                    <li><a href="{{ url('/admin/profile') }}" class="nav-link sidebar-link">Profile</a></li>
                    <li><a href="{{ url('/admin/settings') }}" class="nav-link sidebar-link">Settings</a></li>
                    <li><a href="{{ url('/admin/logout') }}" class="nav-link sidebar-link">Log out</a></li>
                    <li><a href="{{ url('/admin/add-supervisor') }}" class="nav-link sidebar-link">Add Supervisor</a></li>
                    <li><a href="{{ url('/admin/add-finance') }}" class="nav-link sidebar-link">Add Finance user</a></li>
                    <li><a href="{{ url('/admin/add-dataentry') }}" class="nav-link sidebar-link">Add Data Entry</a></li>
                </ul>
            </div>
        </li>
        <!-- Item Types -->
        <li class="sidebar-main-item">
            <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;"> <i class="fa fa-tachometer-alt me-2" style="color: #17a2b8;"></i>Item Types</a>
            <div class="sidebar-flyout">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                    <li><a href="{{ url('/admin/contract-types') }}" class="nav-link sidebar-link">Contract Types</a></li>
                    <li><a href="{{ url('/admin/indicator-types') }}" class="nav-link sidebar-link">Indicator Types</a></li>
                    <li><a href="{{ url('/admin/indicator-descriptions') }}" class="nav-link sidebar-link">Indicator Descriptions</a></li>
                    <li><a href="{{ url('/admin/intervention-types') }}" class="nav-link sidebar-link">Intervention Types</a></li>
                    <li><a href="{{ url('/admin/training-types') }}" class="nav-link sidebar-link">Training Types</a></li>
                    <li><a href="{{ url('/admin/beneficiary-types') }}" class="nav-link sidebar-link">Beneficiary Types</a></li>
                </ul>
            </div>
        </li>
        <!-- Key Variables -->
        <li class="sidebar-main-item">
            <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;"> <i class="fa fa-table me-2" style="color: #17a2b8;"></i>Key Variables</a>
            <div class="sidebar-flyout">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                    <li><a href="{{ url('/admin/imp-partners') }}" class="nav-link sidebar-link">Imp Partners</a></li>
                    <li><a href="{{ url('/admin/regions') }}" class="nav-link sidebar-link">Regions</a></li>
                    <li><a href="{{ url('/admin/activities') }}" class="nav-link sidebar-link">Activities</a></li>
                    <li><a href="{{ url('/admin/indicator-frequencies') }}" class="nav-link sidebar-link">Indicator Reporting Frequencies</a></li>
                    <li><a href="{{ url('/admin/activity-status') }}" class="nav-link sidebar-link">Activities Status</a></li>
                    <li><a href="{{ url('/admin/units-measurement') }}" class="nav-link sidebar-link">Units Measurement</a></li>
                    <li><a href="{{ url('/admin/persons') }}" class="nav-link sidebar-link">Persons</a></li>
                    <li><a href="{{ url('/admin/contractors') }}" class="nav-link sidebar-link">Contractors</a></li>
                    <li><a href="{{ route('admin.venues') }}" class="nav-link sidebar-link">Venue</a></li>
                    <li><a href="{{ route('admin.payment-modes') }}" class="nav-link sidebar-link">Payment Modes</a></li>
                    <li><a href="{{ route('admin.payment-tranches') }}" class="nav-link sidebar-link">Payment Tranches</a></li>
                    <li><a href="{{ route('admin.project-frequencies') }}" class="nav-link sidebar-link">Project Reporting Frequencies</a></li>
                </ul>
            </div>
        </li>
        <!-- Comps & SubComps -->
        <li class="sidebar-main-item">
            <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;"> <i class="fa fa-layer-group me-2" style="color: #17a2b8;"></i>Comp & SubComp</a>
            <div class="sidebar-flyout">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                    <li><a href="{{ route('admin.components') }}" class="nav-link sidebar-link">Components</a></li>
                    <li><a href="{{ route('admin.sub-components') }}" class="nav-link sidebar-link">Sub Components</a></li>
                </ul>
            </div>
        </li>
        <!-- Data Entry -->
        <li class="sidebar-main-item">
            <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;"> <i class="fa fa-database me-2" style="color: #17a2b8;"></i>Data Entry</a>
            <div class="sidebar-flyout">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                    <li><a href="{{ url('/admin/add-dataentry') }}" class="nav-link sidebar-link">Add Data Entry</a></li>
                    <li><a href="{{ url('/admin/manage-dataentry') }}" class="nav-link sidebar-link">Manage Data Entry</a></li>
                </ul>
            </div>
        </li>
        <!-- Quality Checks -->
        <li class="sidebar-main-item">
            <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;"> <i class="fa fa-check-circle me-2" style="color: #17a2b8;"></i>Quality Checks</a>
            <div class="sidebar-flyout">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                    <li><a href="{{ url('/admin/indicator-performance') }}" class="nav-link sidebar-link">Indicator Performance</a></li>
                    <li><a href="{{ url('/admin/beneficiary-performance') }}" class="nav-link sidebar-link">Beneficiary Performance</a></li>
                    <li><a href="{{ url('/admin/disbursement') }}" class="nav-link sidebar-link">Disbursement</a></li>
                    <li><a href="{{ url('/admin/contract-performance') }}" class="nav-link sidebar-link">Contract/MOU Performance</a></li>
                    <li><a href="{{ url('/admin/training-performance') }}" class="nav-link sidebar-link">Training Performance</a></li>
                </ul>
            </div>
        </li>
        <!-- General Reports -->
        <li class="sidebar-main-item">
            <a class="nav-link" style="color: #218838; font-weight: 600; cursor:pointer;"> <i class="fa fa-file-alt me-2" style="color: #17a2b8;"></i>General Reports</a>
            <div class="sidebar-flyout">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-0">
                    <li><a href="{{ url('/admin/beneficiaries-new') }}" class="nav-link sidebar-link">Beneficiaries new</a></li>
                    <li><a href="{{ url('/admin/indicators') }}" class="nav-link sidebar-link">Indicators</a></li>
                    <li><a href="{{ url('/admin/beneficiaries') }}" class="nav-link sidebar-link">Beneficiaries</a></li>
                    <li><a href="{{ url('/admin/contracts') }}" class="nav-link sidebar-link">Contract/MOUs</a></li>
                    <li><a href="{{ url('/admin/trainings') }}" class="nav-link sidebar-link">Trainings</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<script>
    document.querySelectorAll('.sidebar-main-item > .nav-link').forEach(function(navLink) {
        navLink.addEventListener('click', function(e) {
            e.preventDefault();
            var parent = navLink.parentElement;
            // Toggle active class
            document.querySelectorAll('.sidebar-main-item').forEach(function(item) {
                if (item !== parent) {
                    item.classList.remove('active');
                }
            });
            parent.classList.toggle('active');
        });
    });
</script>