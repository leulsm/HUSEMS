<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        {{-- <script src="{{ asset('admin/assets/js/stisla.js') }}"></script> --}}

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('admin/assets/img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
                <a href="" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
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
            {{--       <li class="active"><a class="nav-link" href="{{ route('student.dashboard') }}"><i
                        class="ml-3 fa-solid fa-table-columns"></i><span>
                        Dashboard</span></a>
            </li> --}}
            <li><a class="nav-link" href="{{ route('invigilator.assigned.index') }}"><i
                        class="ml-3 fa-solid fa-hourglass-start"></i>
                    <span>Assigned Exam</span></a>
            </li>
            <li><a class="nav-link" href="{{ route('student.takenexam.index') }}"><i
                        class="ml-3 fa-solid fa-sheet-plastic"></i>
                    <span>Completed Exam</span></a>
            </li>

        </ul>
    </aside>
</div>
