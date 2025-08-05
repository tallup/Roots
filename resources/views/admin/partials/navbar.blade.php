<!-- Admin Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #00796b 0%, #00bcd4 100%); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/roots-logo.png') }}" alt="ROOTS Logo" style="height: 45px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-weight: 500;">
                <!-- User Management -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userMgmtDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff !important; font-weight: 500; margin-right: 8px;">
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
                    <a class="nav-link dropdown-toggle" href="#" id="itemTypesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff !important; font-weight: 500; margin-right: 8px;">
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
                    <a class="nav-link dropdown-toggle" href="#" id="keyVarsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff !important; font-weight: 500; margin-right: 8px;">
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
                    <a class="nav-link dropdown-toggle" href="#" id="compsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff !important; font-weight: 500; margin-right: 8px;">
                        <i class="fa fa-layer-group"></i> Comp & SubComp
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="compsDropdown">
                        <li><a class="dropdown-item" href="{{ url('/admin/components') }}">Components</a></li>
                        <li><a class="dropdown-item" href="{{ url('/admin/sub-components') }}">Sub Components</a></li>
                    </ul>
                </li>
                <!-- Quality Checks -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="qualityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff !important; font-weight: 500; margin-right: 8px;">
                        <i class="fa fa-check-circle"></i> Quality Checks
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="qualityDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.indicator-performance') }}">Indicator Performance</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.beneficiary-performance') }}">Beneficiary Performance</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.disbursement-performance') }}">Disbursement Performance</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.contract-performance') }}">Contract/MOU Performance</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.training-performance') }}">Training Performance</a></li>
                    </ul>
                </li>

                <!-- General Reports -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff !important; font-weight: 500; margin-right: 8px;">
                        <i class="fa fa-file-alt"></i> General Reports
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                        <li><a class="dropdown-item" href="{{ url('/admin/beneficiaries-new') }}">Beneficiaries</a></li>
                        <li><a class="dropdown-item" href="{{ url('/admin/indicators') }}">Indicators</a></li>
                        <!-- <li><a class="dropdown-item" href="{{ url('/admin/beneficiaries') }}">Beneficiaries</a></li> -->
                        <li><a class="dropdown-item" href="{{ url('/admin/contracts') }}">Contract/MOUs</a></li>
                        <li><a class="dropdown-item" href="{{ url('/admin/trainings') }}">Trainings</a></li>
                    </ul>
                </li>
            </ul>
            <!-- User Menu -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff !important; font-weight: 600;">
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