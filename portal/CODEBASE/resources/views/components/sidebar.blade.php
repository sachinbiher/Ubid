<div class="deznav">
		
    <div class="deznav-scroll">
    <span class="nav-item nav-toggle">
			<a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i data-feather="x"></i></a></span>

        <ul class="metismenu" id="menu">
                    <a href="{{route('dashboard')}}" class="brand-logo dm-none ">
                <span class="logo-text text-dark"><img src="{{url('app-assets/images/logo/logo.png')}}"></span>
                </a>
            <li class="@if($activeMenu=='dashboard') active @endif">
                <a class="ai-icon" href="{{route('dashboard')}}" aria-expanded="false">
                <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
                </a>
            </li>
            <li class="@if($activeMenu=='customer') active @endif">
                <a class="ai-icon" href="{{route('customer')}}" aria-expanded="false">
                <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Customer Management">Customers</span>
                </a>
            </li>
            <li class="@if($activeMenu=='partner') active @endif">
                <a class="ai-icon" href="{{route('partner')}}" aria-expanded="false">
                <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Business Partner Management">Business Partner Management</span>
                </a>
            </li>
            <!-- <li class="@if($activeMenu=='profile') active @endif">
                <a class="ai-icon" href="{{route('profile')}}" aria-expanded="false">
                <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Business Partner Management">Profile Management</span>
                </a>
            </li> -->
            <li class="@if($activeMenu=='category') active @endif">
                <a class="ai-icon" href="{{route('category')}}" aria-expanded="false">
                <i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Category Management">Category Management</span>
                </a>
            </li>
            <!-- <li class="@if($activeMenu=='vendors') active @endif">
                <a class="ai-icon" href="{{route('vendors')}}" aria-expanded="false">
                <i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Sponsored Vendors">Sponsored Vendors</span>
                </a>
            </li> -->
            <li class="@if($activeMenu=='subscription') active @endif">
                <a class="ai-icon" href="{{route('subscription')}}" aria-expanded="false">
                <i data-feather="airplay"></i><span class="menu-title text-truncate" data-i18n="Subscription Management">Subscription Management</span>
                </a>
            </li>
            <li class="@if($activeMenu=='ticket') active @endif">
                <a class="ai-icon" href="{{route('ticket')}}" aria-expanded="false">
                <i data-feather="zap"></i><span class="menu-title text-truncate" data-i18n="Subscription Management">Tickets</span>
                </a>
            </li>
            <!-- <li class="@if($activeMenu=='importantdocs') active @endif">
                <a class="ai-icon" href="{{route('importantdocs')}}" aria-expanded="false">
                <i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Important Documents">Important Documents</span>
                </a>
            </li> -->
            <!--
            <li>
                <a class="ai-icon" href="document-verification-management.html" aria-expanded="false">
                <i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Document Verification Management">Document Verification Management</span>
                </a>
            </li> -->
        </ul>
    </div>
</div>