<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">E-Commerce</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">EC</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
                <a href="{{ route('dashboard') }}" class=""><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>
            <li>
                <a class="nav-link" href="{{ route('products') }}"><i class="fas fa-box"></i><span>Products</span></a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('order') }}"> <i class="fas fa-archive"></i><span>Order</span></a>
            </li>
            @if (Auth::user()->is_admin)
                <li>
                    <a class="nav-link" href="{{ route('user_management') }}"> <i class="fas fa-user"></i><span>User
                            Management</span></a>
                </li>
            @endif
        
        </ul>
    </aside>
</div>
