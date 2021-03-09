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
                    <a href="{{ route('viewuser-direktur') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Direktur</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('viewuser-admin') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Admin</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('viewuser-superadmin') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Super Admin</p>
                    </a>
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
                <a href="{{ route('viewpelabuhan') }}" class="nav-link">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Pelabuhan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('viewjadwal') }}" class="nav-link">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Jadwal</p>
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
            <a href="{{ route('pelabuhan') }}" class="nav-link">
              <i class="nav-icon fas fa-monument"></i>
              <p class="text">Pelabuhan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('berita') }}" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p class="text">Berita</p>
            </a>
          </li>
          </li>

          <li class="nav-header">About Us</li>
          <li class="nav-item">
            <a href="{{ route('admin-contact') }}" class="nav-link">
              <i class="nav-icon fas fa-id-card-alt text-danger"></i>
              <p class="text">Contact Us</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('speedboat-contact') }}" class="nav-link">
              <i class="nav-icon fas fa-ship text-warning"></i>
              <p>Speedboat Conntact</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pelabuhan-contact') }}" class="nav-link">
              <i class="nav-icon fas fa-monument text-info"></i>
              <p>Harbour Contact</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>