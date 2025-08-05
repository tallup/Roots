<style>
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
</style>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('supervisor.dashboard') }}">
            <img src="{{ asset('images/roots-logo.png') }}" alt="ROOTS Logo" style="height: 45px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}" href="{{ route('supervisor.dashboard') }}">
                        <i class="fa fa-tachometer-alt me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('supervisor.beneficiaries') ? 'active' : '' }}" href="{{ route('supervisor.beneficiaries') }}">
                        <i class="fa fa-users me-1"></i>Beneficiary
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['supervisor.indicators', 'supervisor.indicators.review']) ? 'active' : '' }}" href="{{ route('supervisor.indicators') }}">
                        <i class="fa fa-chart-line me-1"></i>Indicator
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('supervisor.contracts') ? 'active' : '' }}" href="{{ route('supervisor.contracts') }}">
                        <i class="fa fa-file-contract me-1"></i>Contract
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['supervisor.trainings', 'supervisor.trainings.review']) ? 'active' : '' }}" href="{{ route('supervisor.trainings') }}">
                        <i class="fa fa-graduation-cap me-1"></i>Training
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fa fa-user me-1"></i>{{ session('supervisor_name') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ request()->routeIs('supervisor.profile') ? 'active' : '' }}" href="{{ route('supervisor.profile') }}"><i class="fa fa-user-cog me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('supervisor.settings') ? 'active' : '' }}" href="{{ route('supervisor.settings') }}"><i class="fa fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('supervisor.logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="cursor:pointer;">
                                    <i class="fa fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> 