<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #0097a7 0%, #00bcd4 100%);">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dataentry.dashboard') }}" style="margin-right: 0; padding-left: 0;">
            <i class="fa fa-database me-2"></i>ROOTS Data Entry
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dataentry.dashboard') ? 'active' : '' }}" href="{{ route('dataentry.dashboard') }}">
                        <i class="fa fa-tachometer-alt me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dataentry.beneficiaries') ? 'active' : '' }}" href="{{ route('dataentry.beneficiaries') }}">
                        <i class="fa fa-users me-1"></i>Beneficiary
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dataentry.indicators') ? 'active' : '' }}" href="{{ route('dataentry.indicators') }}">
                        <i class="fa fa-chart-line me-1"></i>Indicator
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dataentry.contracts') ? 'active' : '' }}" href="{{ route('dataentry.contracts') }}">
                        <i class="fa fa-file-contract me-1"></i>Contract
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dataentry.trainings') ? 'active' : '' }}" href="{{ route('dataentry.trainings') }}">
                        <i class="fa fa-graduation-cap me-1"></i>Training
                    </a>
                </li>
                <!-- <li class="nav-item"><a class="nav-link" href="{{ route('dataentry.profile') }}"><i class="fa fa-user me-1"></i>Profile</a></li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fa fa-user me-1"></i>{{ session('dataentry_name') ?? session('supervisor_name') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ request()->routeIs('dataentry.profile') ? 'active' : '' }}" href="{{ route('dataentry.profile') }}"><i class="fa fa-user-cog me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('dataentry.settings') ? 'active' : '' }}" href="{{ route('dataentry.settings') }}"><i class="fa fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('dataentry.logout') }}"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> 