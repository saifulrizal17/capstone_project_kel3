<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}"
                class="nav-link">Dashboard</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->profile_photo ? asset('/upload/profile photo/' . Auth::user()->profile_photo) : asset('/upload/profile photo/profile-default.png') }}"
                    class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline" id="userDropdownTrigger" onclick="toggleDropdown()">
                    {{ Auth::user()->name }} &nbsp;
                </span>
                <i id="caretIcon" class="fas fa-caret-down" onclick="toggleDropdown()"></i>

                <script>
                    var isDropdownOpen = false;

                    function toggleDropdown() {
                        isDropdownOpen = !isDropdownOpen;
                        var caretIcon = document.getElementById('caretIcon');

                        if (isDropdownOpen) {
                            caretIcon.classList.remove('fa-caret-down');
                            caretIcon.classList.add('fa-caret-up');
                        } else {
                            caretIcon.classList.remove('fa-caret-up');
                            caretIcon.classList.add('fa-caret-down');
                        }
                    }
                </script>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ Auth::user()->profile_photo ? asset('/upload/profile photo/' . Auth::user()->profile_photo) : asset('/upload/profile photo/profile-default.png') }}"
                        class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{ Auth::user()->name }} - {{ Auth::user()->job_title }}
                        <small>Anggota Sejak {{ Auth::user()->created_at->locale('id')->isoFormat('MMMM Y') }}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>

                    <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">My Profile</a>

                    <a href="javascript:void(0)" class="nav-link btn btn-default btn-flat float-right"
                        onclick="$('#logout-form').submit();">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
