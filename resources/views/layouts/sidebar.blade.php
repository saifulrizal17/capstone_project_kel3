<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary bg-primary elevation-4">
    <!-- Brand Logo -->
    <div>
        <a href="{{ route('frondend') }}" class="brand-link">
            <img src="{{ asset('/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-header">HOME</li>

                {{-- Role Admin --}}
                @if (Auth::check() && Auth::user()->role_id == '1')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif

                {{-- Role User --}}
                @if (Auth::check() && Auth::user()->role_id == '2')
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">INTERFACE</li>

                {{-- Role Admin --}}
                @if (Auth::check() && Auth::user()->role_id == '1')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Arus Kas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-light">
                            <li class="nav-item">
                                <a href="{{ route('aruskas.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Catatan Keuangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kategori.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Role User --}}
                @if (Auth::check() && Auth::user()->role_id == '2')
                    <li class="nav-item">
                        <a href="{{ route('aruskas.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Arus Kas</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('labarugi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Laba/Rugi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('perubahanmodal.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Perubahan Modal</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('neraca.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>Neraca</p>
                    </a>
                </li>


                <li class="nav-item">
                    <hr class="solid" style="border-top: 1px solid #b1a9a9;">
                </li>

                {{-- Role Admin --}}
                @if (Auth::check() && Auth::user()->role_id == '1')
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Manajemen Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contact.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Contact Messages</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                    <a href="javascript:void(0)" class="nav-link" onclick="$('#logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
