<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

        </ul>
    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('admin/assets/img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a onclick="event.preventDefault();
                    this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Husems</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">Hu</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="active"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                        class="fas fa-fire"></i><span>General
                        Dashboard</span></a>
            </li>


            <li class="menu-header">User Management</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>User Management</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('collegeForm') }}">Add College</a></li>
                    <li><a class="nav-link" href="{{ route('departmentForm') }}">Add Department</a></li>
                    <li><a class="nav-link" href="{{ route('coordinatorForm') }}">Add Exam Coordinator</a></li>
                </ul>
            </li>
            <li class="main-header"><a class="nav-link">Schedule For Exam </a></li>
            <li class="active"><a class="nav-link" href="{{ route('examList') }}"><i
                        class="fas fa-fire"></i><span>Schedule For Exam</span></a>
            </li>

            {{-- <li class="menu-header">Starter</li>

            <li><a class="nav-link" href=""><i class="far fa-square"></i>
                    <span>Slider</span></a>
            </li> --}}
            {{-- <li class="dropdown"> --}}
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
            <li class="dropdown"> --}}

        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>
