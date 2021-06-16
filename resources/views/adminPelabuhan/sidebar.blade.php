<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
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
                <a href="#" class="d-block">Admin Pelabuhan</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('adminPelabuhanHome') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('createPembelian')}}" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p class="text">Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('transaksi-pa')}}" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p class="text">Transaksi</p>
                    </a>
                </li>
                <li class="nav-header">Manajemen Pelabuhan</li>
                <li class="nav-item">
                    <a href="{{ route('verifkapal-view') }}" class="nav-link">
                        <i class="nav-icon fas fa-ship"></i>
                        <p class="text">Verifikasi Kapal</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-edit nav-icon"></i>
                        <p>Manajemen Jadwal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/AdminPelabuhan/JadwalData/senin" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Senin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdminPelabuhan/JadwalData/selasa" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Selasa</p>
                            </a>
                        <li class="nav-item">
                            <a href="/AdminPelabuhan/JadwalData/rabu" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Rabu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdminPelabuhan/JadwalData/kamis" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Kamis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdminPelabuhan/JadwalData/jumat" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Jumat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdminPelabuhan/JadwalData/sabtu" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Sabtu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdminPelabuhan/JadwalData/minggu" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Minggu</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master-jadwal') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-week"></i>
                        <p class="text">Master Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pelabuhan-view') }}" class="nav-link">
                        <i class="nav-icon fas fa-monument"></i>
                        <p class="text">Pelabuhan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dermaga-pa') }}" class="nav-link">
                        <i class="nav-icon fas fa-anchor"></i>
                        <p class="text">Dermaga</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('golongan-pa') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle-notch"></i>
                        <p class="text">Golongan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita-pelabuhan-pa') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p class="text">Berita Pelabuhan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
