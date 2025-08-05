<style>
:root {
    --finance-sidebar-width: 370px;
}
.finance-sidebar {
    background: linear-gradient(180deg, #00796b 0%, #00bcd4 100%);
    min-height: 100vh;
    padding: 2rem 0 1rem 1rem;
    color: #fff;
    /* border-radius: 1.5rem 0 0 1.5rem; */
    box-shadow: 2px 0 10px rgba(0,0,0,0.08);
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: var(--finance-sidebar-width);
    z-index: 1040;
}
.finance-sidebar .sidebar-header {
    text-align: center;
    margin-bottom: 2rem;
}
.finance-sidebar .sidebar-header img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #fff;
    margin-bottom: 0.5rem;
}
.finance-sidebar .sidebar-header .name-caret {
    font-weight: 700;
    font-size: 1.2rem;
    color: #fff;
}
.finance-sidebar .sidebar-links {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem 0;
}
.finance-sidebar .sidebar-links li {
    margin-bottom: 0.5rem;
}
.finance-sidebar .sidebar-links a, .finance-sidebar .sidebar-links button {
    display: flex;
    align-items: center;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.15rem;
    padding: 0.85rem 1.1rem;
    border-radius: 0.75rem;
    transition: background 0.2s;
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    letter-spacing: 0.5px;
}
.finance-sidebar .sidebar-links a.active, .finance-sidebar .sidebar-links a:hover, .finance-sidebar .sidebar-links button:hover {
    background: rgba(255,255,255,0.15);
    color: #fff;
}
.finance-sidebar .sidebar-links i {
    margin-right: 0.85rem;
    font-size: 1.3rem;
}
.finance-sidebar .sidebar-section-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #e0f7fa;
    margin: 1.5rem 0 0.5rem 0.5rem;
    letter-spacing: 1px;
}
</style>
<div class="finance-sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/roots-logo.png') }}" alt="Finance Logo">
        <div class="name-caret">{{ session('finance_name') ?? 'Finance User' }}</div>
        <div style="font-size:0.95rem; color:#e0f7fa;">Finance Users</div>
        <div class="d-flex justify-content-center align-items-center gap-3 mt-3 mb-4">
            <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Profile" style="background:none; color:#fff; font-size:1.4rem;">
                <i class="fa fa-user"></i>
            </a>
            <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Settings" style="background:none; color:#fff; font-size:1.4rem;">
                <i class="fa fa-cog"></i>
            </a>
            <form method="POST" action="{{ route('finance.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout" style="background:none; color:#fff; font-size:1.4rem;">
                    <i class="fa fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
    <ul class="sidebar-links">
        <li><a href="{{ route('finance.dashboard') }}" class="{{ request()->routeIs('finance.dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt"></i>Dashboard</a></li>
        <li><a href="{{ route('finance.components') }}" class="{{ request()->routeIs(['finance.components', 'finance.components.add', 'finance.components.report']) ? 'active' : '' }}"><i class="fa fa-layer-group"></i>Component Allocations</a></li>
        <li><a href="{{ route('finance.subcomponents') }}" class="{{ request()->routeIs(['finance.subcomponents', 'finance.subcomponents.add', 'finance.subcomponents.edit', 'finance.subcomponents.report']) ? 'active' : '' }}"><i class="fa fa-sitemap"></i>Subcomponent Allocations</a></li>
        <li><a href="{{ route('finance.disbursements.index') }}" class="{{ request()->routeIs(['finance.disbursements.*']) ? 'active' : '' }}"><i class="fa fa-hand-holding-usd"></i>Disbursement</a></li>
        <li><a href="{{ route('finance.result-transactions.index') }}" class="{{ request()->routeIs(['finance.result-transactions.*']) ? 'active' : '' }}"><i class="fa fa-list-ul"></i>Results Transactions</a></li>
        <li><a href="{{ route('finance.transaction-list.index') }}" class="{{ request()->routeIs(['finance.transaction-list.*']) ? 'active' : '' }}"><i class="fa fa-list-ul"></i>Transaction List</a></li>
        <li><a href="{{ route('finance.transaction-report.index') }}" class="{{ request()->routeIs(['finance.transaction-report.*']) ? 'active' : '' }}"><i class="fa fa-file-invoice"></i>Transaction Reports</a></li>
    </ul>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</div> 