<style>
:root {
    --admin-sidebar-width: 305px;
}
.admin-sidebar {
    background: linear-gradient(180deg, #218838 0%, #17a2b8 100%);
    min-height: 100vh;
    padding: 2rem 0 1rem 1rem;
    color: #fff;
    box-shadow: 2px 0 10px rgba(0,0,0,0.08);
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: var(--admin-sidebar-width);
    z-index: 1040;
    overflow-y: auto;
}

/* Add space for main content */
body {
    padding-left: calc(var(--admin-sidebar-width) + 10px);
}

/* Alternative approach for main content spacing */
.main-content, .container-fluid, .container {
    margin-left: 10px;
}

/* Force spacing for any main content area */
div[class*="container"], div[class*="content"], div[class*="main"] {
    margin-left: 10px !important;
}
.admin-sidebar .sidebar-header {
    text-align: center;
    margin-bottom: 2rem;
}
.admin-sidebar .sidebar-header img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #fff;
    margin-bottom: 0.5rem;
}
.admin-sidebar .sidebar-header .name-caret {
    font-weight: 700;
    font-size: 1.2rem;
    color: #fff;
}
.admin-sidebar .sidebar-links {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem 0;
}
.admin-sidebar .sidebar-links li {
    margin-bottom: 0.5rem;
}
.admin-sidebar .sidebar-links a, .admin-sidebar .sidebar-links button {
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
.admin-sidebar .sidebar-links a.active, .admin-sidebar .sidebar-links a:hover, .admin-sidebar .sidebar-links button:hover {
    background: rgba(255,255,255,0.15);
    color: #fff;
}
.admin-sidebar .sidebar-links i {
    margin-right: 0.85rem;
    font-size: 1.3rem;
}
.admin-sidebar .sidebar-section-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #e0f7fa;
    margin: 1.5rem 0 0.5rem 0.5rem;
    letter-spacing: 1px;
}
.admin-sidebar .dropdown-menu {
    display: none;
    background: #218838;
    border: 2px solid #17a2b8;
    border-radius: 0.75rem;
    padding: 0.5rem 0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    margin-top: 0.5rem;
    margin-left: 1rem;
    margin-right: 1rem;
}
.admin-sidebar .dropdown-menu.show {
    display: block;
}
.admin-sidebar .dropdown-menu a {
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: background 0.2s;
}
.admin-sidebar .dropdown-menu a:hover {
    background: #17a2b8;
    color: #fff;
}
.admin-sidebar .dropdown-menu a.active {
    background: #17a2b8;
    color: #fff;
}
.admin-sidebar .nav-item {
    cursor: pointer;
    border-radius: 0.75rem;
    transition: background 0.2s;
    margin-bottom: 0.5rem;
}
.admin-sidebar .nav-item:hover {
    background: rgba(255,255,255,0.1);
}
.admin-sidebar .nav-item.active {
    background: rgba(255,255,255,0.15);
}
.admin-sidebar .nav-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.85rem 1.1rem;
    color: #fff;
    font-weight: 600;
    font-size: 1.15rem;
    letter-spacing: 0.5px;
}
.admin-sidebar .nav-content i {
    margin-right: 0.85rem;
    font-size: 1.3rem;
}
.admin-sidebar .arrow {
    font-size: 0.9rem;
    transition: transform 0.2s;
}
.admin-sidebar .nav-item.active .arrow {
    transform: rotate(90deg);
}
</style>

<div class="admin-sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/roots-logo.png') }}" alt="Admin Logo">
        <div class="name-caret">{{ session('admin_name') ?? 'Admin User' }}</div>
        <div style="font-size:0.95rem; color:#e0f7fa;">Administrator</div>
        <div class="d-flex justify-content-center align-items-center gap-3 mt-3 mb-4">
            <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Profile" style="background:none; color:#fff; font-size:1.4rem;">
                <i class="fa fa-user"></i>
            </a>
            <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Settings" style="background:none; color:#fff; font-size:1.4rem;">
                <i class="fa fa-cog"></i>
            </a>
            <a href="{{ route('admin.logout') }}" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout" style="background:none; color:#fff; font-size:1.4rem;">
                <i class="fa fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
    
    <ul class="sidebar-links">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt"></i>Dashboard</a></li>
        
        <li>
            <div class="nav-item" data-dropdown="user-management">
                <div class="nav-content">
                    <div>
                        <i class="fa fa-users"></i>
                        <span>User Management</span>
                    </div>
                    <i class="fa fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="dropdown-menu" id="user-management">
                <a href="{{ url('/admin/add-admin') }}" class="{{ request()->routeIs('admin.add-admin') ? 'active' : '' }}"><i class="fa fa-user-plus"></i>Add Admin</a>
                <a href="{{ url('/admin/add-supervisor') }}" class="{{ request()->routeIs('admin.add-supervisor') ? 'active' : '' }}"><i class="fa fa-user-shield"></i>Add Supervisor</a>
                <a href="{{ url('/admin/add-finance') }}" class="{{ request()->routeIs('admin.add-finance') ? 'active' : '' }}"><i class="fa fa-dollar-sign"></i>Add Finance user</a>
                <a href="{{ url('/admin/add-dataentry') }}" class="{{ request()->routeIs('admin.add-dataentry') ? 'active' : '' }}"><i class="fa fa-database"></i>Add Data Entry</a>
            </div>
        </li>
        
        <li>
            <div class="nav-item" data-dropdown="item-types">
                <div class="nav-content">
                    <div>
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Item Types</span>
                    </div>
                    <i class="fa fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="dropdown-menu" id="item-types">
                <a href="{{ url('/admin/contract-types') }}" class="{{ request()->routeIs('admin.contract-types') ? 'active' : '' }}"><i class="fa fa-file-contract"></i>Contract Types</a>
                <a href="{{ url('/admin/indicator-types') }}" class="{{ request()->routeIs('admin.indicator-types') ? 'active' : '' }}"><i class="fa fa-chart-bar"></i>Indicator Types</a>
                <a href="{{ url('/admin/indicator-descriptions') }}" class="{{ request()->routeIs('admin.indicator-descriptions') ? 'active' : '' }}"><i class="fa fa-file-text"></i>Indicator Descriptions</a>
                <a href="{{ url('/admin/intervention-types') }}" class="{{ request()->routeIs('admin.intervention-types') ? 'active' : '' }}"><i class="fa fa-wrench"></i>Intervention Types</a>
                <a href="{{ url('/admin/training-types') }}" class="{{ request()->routeIs('admin.training-types') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i>Training Types</a>
                <a href="{{ url('/admin/beneficiary-types') }}" class="{{ request()->routeIs('admin.beneficiary-types') ? 'active' : '' }}"><i class="fa fa-user-tag"></i>Beneficiary Types</a>
            </div>
        </li>
        
        <li>
            <div class="nav-item" data-dropdown="key-variables">
                <div class="nav-content">
                    <div>
                        <i class="fa fa-table"></i>
                        <span>Key Variables</span>
                    </div>
                    <i class="fa fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="dropdown-menu" id="key-variables">
                <a href="{{ url('/admin/imp-partners') }}" class="{{ request()->routeIs('admin.imp-partners') ? 'active' : '' }}"><i class="fa fa-handshake"></i>Imp Partners</a>
                <a href="{{ url('/admin/regions') }}" class="{{ request()->routeIs('admin.regions') ? 'active' : '' }}"><i class="fa fa-globe"></i>Regions</a>
                <a href="{{ url('/admin/activities') }}" class="{{ request()->routeIs('admin.activities') ? 'active' : '' }}"><i class="fa fa-tasks"></i>Activities</a>
                <a href="{{ url('/admin/indicator-frequencies') }}" class="{{ request()->routeIs('admin.indicator-frequencies') ? 'active' : '' }}"><i class="fa fa-clock"></i>Indicator Reporting Frequencies</a>
                <a href="{{ url('/admin/activity-status') }}" class="{{ request()->routeIs('admin.activity-status') ? 'active' : '' }}"><i class="fa fa-info-circle"></i>Activities Status</a>
                <a href="{{ url('/admin/units-measurement') }}" class="{{ request()->routeIs('admin.units-measurement') ? 'active' : '' }}"><i class="fa fa-ruler"></i>Units Measurement</a>
                <a href="{{ url('/admin/persons') }}" class="{{ request()->routeIs('admin.persons') ? 'active' : '' }}"><i class="fa fa-user"></i>Persons</a>
                <a href="{{ url('/admin/contractors') }}" class="{{ request()->routeIs('admin.contractors') ? 'active' : '' }}"><i class="fa fa-hard-hat"></i>Contractors</a>
                <a href="{{ route('admin.venues') }}" class="{{ request()->routeIs('admin.venues') ? 'active' : '' }}"><i class="fa fa-map-marker-alt"></i>Venue</a>
                <a href="{{ route('admin.payment-modes') }}" class="{{ request()->routeIs('admin.payment-modes') ? 'active' : '' }}"><i class="fa fa-credit-card"></i>Payment Modes</a>
                <a href="{{ route('admin.payment-tranches') }}" class="{{ request()->routeIs('admin.payment-tranches') ? 'active' : '' }}"><i class="fa fa-money-bill-wave"></i>Payment Tranches</a>
                <a href="{{ route('admin.project-frequencies') }}" class="{{ request()->routeIs('admin.project-frequencies') ? 'active' : '' }}"><i class="fa fa-calendar-alt"></i>Project Reporting Frequencies</a>
            </div>
        </li>
        
        <li>
            <div class="nav-item" data-dropdown="comps-subcomps">
                <div class="nav-content">
                    <div>
                        <i class="fa fa-layer-group"></i>
                        <span>Comp & SubComp</span>
                    </div>
                    <i class="fa fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="dropdown-menu" id="comps-subcomps">
                <a href="{{ url('/admin/components') }}" class="{{ request()->routeIs('admin.components') ? 'active' : '' }}"><i class="fa fa-layer-group"></i>Components</a>
                <a href="{{ url('/admin/sub-components') }}" class="{{ request()->routeIs('admin.sub-components') ? 'active' : '' }}"><i class="fa fa-sitemap"></i>Sub Components</a>
            </div>
        </li>
        
        <li>
            <div class="nav-item" data-dropdown="quality-checks">
                <div class="nav-content">
                    <div>
                        <i class="fa fa-check-circle"></i>
                        <span>Quality Checks</span>
                    </div>
                    <i class="fa fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="dropdown-menu" id="quality-checks">
                <a href="{{ route('admin.indicator-performance') }}" class="{{ request()->routeIs('admin.indicator-performance*') ? 'active' : '' }}"><i class="fa fa-chart-line"></i>Indicator Performance</a>
                <a href="{{ url('/admin/beneficiary-performance') }}" class="{{ request()->routeIs('admin.beneficiary-performance') ? 'active' : '' }}"><i class="fa fa-users"></i>Beneficiary Performance</a>
                <a href="{{ url('/admin/disbursement-performance') }}" class="{{ request()->routeIs('admin.disbursement-performance') ? 'active' : '' }}"><i class="fa fa-money-bill"></i>Disbursement Performance</a>
                <a href="{{ route('admin.contract-performance') }}" class="{{ request()->routeIs('admin.contract-performance*') ? 'active' : '' }}"><i class="fa fa-file-contract"></i>Contract/MOU Performance</a>
                <a href="{{ url('/admin/training-performance') }}" class="{{ request()->routeIs('admin.training-performance') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i>Training Performance</a>
            </div>
        </li>
        
        <li>
            <div class="nav-item" data-dropdown="general-reports">
                <div class="nav-content">
                    <div>
                        <i class="fa fa-file-alt"></i>
                        <span>General Reports</span>
                    </div>
                    <i class="fa fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="dropdown-menu" id="general-reports">
                <a href="{{ url('/admin/beneficiaries-new') }}" class="{{ request()->routeIs('admin.beneficiaries-new') ? 'active' : '' }}"><i class="fa fa-users"></i>Beneficiaries</a>
                <a href="{{ url('/admin/indicators') }}" class="{{ request()->routeIs('admin.indicators') ? 'active' : '' }}"><i class="fa fa-chart-bar"></i>Indicators</a>
                <!-- <a href="{{ url('/admin/beneficiaries') }}" class="{{ request()->routeIs('admin.beneficiaries') ? 'active' : '' }}"><i class="fa fa-user-friends"></i>Beneficiaries</a> -->
                <a href="{{ url('/admin/contracts') }}" class="{{ request()->routeIs('admin.contracts') ? 'active' : '' }}"><i class="fa fa-file-contract"></i>Contract/MOUs</a>
                <a href="{{ url('/admin/trainings') }}" class="{{ request()->routeIs('admin.trainings') ? 'active' : '' }}"><i class="fa fa-graduation-cap"></i>Trainings</a>
            </div>
        </li>
    </ul>
</div>

<script>
// Dropdown functionality - doesn't depend on Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin sidebar JavaScript loaded');
    
    // Find all nav items with dropdowns
    var navItems = document.querySelectorAll('.nav-item[data-dropdown]');
    console.log('Found nav items:', navItems.length);
    
    navItems.forEach(function(navItem) {
        navItem.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var dropdownId = this.getAttribute('data-dropdown');
            var dropdownMenu = document.getElementById(dropdownId);
            
            console.log('Clicked dropdown:', dropdownId);
            console.log('Dropdown menu found:', dropdownMenu);
            
            if (dropdownMenu) {
                // Close other open dropdowns
                document.querySelectorAll('.dropdown-menu.show').forEach(function(openMenu) {
                    if (openMenu !== dropdownMenu) {
                        openMenu.classList.remove('show');
                        var prevSibling = openMenu.previousElementSibling;
                        if (prevSibling && prevSibling.classList.contains('nav-item')) {
                            prevSibling.classList.remove('active');
                        }
                    }
                });
                
                // Toggle current dropdown
                dropdownMenu.classList.toggle('show');
                this.classList.toggle('active');
                
                console.log('Dropdown toggled:', dropdownMenu.classList.contains('show'));
                console.log('Dropdown element:', dropdownMenu);
                console.log('Dropdown display style:', dropdownMenu.style.display);
                console.log('Dropdown position:', dropdownMenu.offsetLeft, dropdownMenu.offsetTop);
            } else {
                console.log('Dropdown menu not found for ID:', dropdownId);
            }
        });
    });
    
    // Initialize tooltips only if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>