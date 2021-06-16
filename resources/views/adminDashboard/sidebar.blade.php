<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin-home') }}" class="brand-link">
        <img src="/Lte/dist/img/Logo.png" alt="E-Tiket Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">E-Tiket Speedboat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('Lte/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Super Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('admin-home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                    <li class="nav-header">Jadwal</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-week"></i>
                                <p>
                                    Manajemen Jadwal
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/Dashboard/JadwalData/senin" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Senin</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Dashboard/JadwalData/selasa" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Selasa</p>
                                    </a>
                                <li class="nav-item">
                                    <a href="/Dashboard/JadwalData/rabu" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Rabu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Dashboard/JadwalData/kamis" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Kamis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Dashboard/JadwalData/jumat" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Jumat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Dashboard/JadwalData/sabtu" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Sabtu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Dashboard/JadwalData/minggu" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Minggu</p>
                                    </a>
                                </li>
                                
                                </li>
                                </li>
                            </ul>

                            <li class="nav-item">
                            <a href="{{ route('master-jadwal-sa') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>Master Jadwal</p>
                            </a>
                        </li>


                <li class="nav-header">CRUD Master Data</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Database
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('viewuser-customer') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Customer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('viewuser-superadmin') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Super Admin</p>
                                    </a>
                                <li class="nav-item">
                                    <a href="{{ route('viewuser-direktur') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Head Admin</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('viewuser-adminpelabuhan') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Admin Pelabuhan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('viewuser-admin') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Admin</p>
                                    </a>
                                </li>
                                
                                </li>
                                </li>
                            </ul>

                        <li class="nav-item">
                            <a href="{{ route('viewspeedboat') }}" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Speedboat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewkapal') }}" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Kapal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewpelabuhan') }}" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Pelabuhan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('viewdermaga') }}" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Dermaga</p>
                            </a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a href="{{ route('viewreward') }}" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Reward Speedboat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewcard') }}" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Card</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('viewgolongan') }}" class="nav-link">
                                <i class="far fa-edit nav-icon"></i>
                                <p>Golongan</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header">Page</li>
                <li class="nav-item has-treeview">
                <li class="nav-item">
                    <a href="{{ route('speedboat') }}" class="nav-link">
                        <i class="nav-icon fas fa-ship"></i>
                        <p class="text">Speedboat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kapal') }}" class="nav-link">
                        <i class="nav-icon fas fa-ship"></i>
                        <p class="text">Kapal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pelabuhan') }}" class="nav-link">
                        <i class="nav-icon fas fa-monument"></i>
                        <p class="text">Pelabuhan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('viewpembelian') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p class="text">Pembelian</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p class="text">Berita
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('berita-pelabuhan') }}" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>Berita Pelabuhan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('berita-speedboat') }}" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>Berita Speedboat</p>
                            </a>
                        </li>

                        </li>
                    </ul>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
