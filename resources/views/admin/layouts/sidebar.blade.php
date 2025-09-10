<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Profile -->
                {{--  
                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}" 
                       class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                --}}
                <!-- Contacts -->
                {{-- 
                <li class="nav-item">
                    <a href="{{ route('admin.cms.contact') }}" 
                       class="nav-link {{ request()->routeIs('admin.cms.contact') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>Contacts</p>
                    </a>
                </li>
                --}}
                <!-- Users -->
                {{--  
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                --}}

                <!-- Blogs -->
                <li class="nav-item">
                    <a href="{{ route('admin.blog.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>Blogs</p>
                    </a>
                </li>

                <!-- CMS -->
                {{-- 
                <li class="nav-item">
                    <a href="{{ route('admin.cms.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.cms.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>CMS</p>
                    </a>
                </li>
                --}}
            </ul>
        </nav>
    </div>
</aside>
