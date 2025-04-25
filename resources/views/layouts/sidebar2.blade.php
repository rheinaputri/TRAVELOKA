<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Search Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ url('/index') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Data Destinasi -->
            <li class="nav-header">Informasi Wisata</li>



            <!-- Wisatawan -->
            <li class="nav-item">
                <a href="{{ url('/wisatawan') }}"
                    class="nav-link {{ $activeMenu == 'wisatawan' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Wisatawan</p>
                </a>
            </li>


            <!-- Pemesanan -->
            <li class="nav-header">Transaksi</li>
            <li class="nav-item">
                <a href="{{ url('/pemesanan') }}" class="nav-link {{ $activeMenu == 'pemesanan' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>Pemesanan</p>
                </a>
            </li>

            <br>
            <!-- Logout -->
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'logout' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
