  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <!-- <img src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
          <i class="fa-solid fa-warehouse" style="margin-right: 10px; margin-left:10px;"></i>
          <span class="brand-text font-weight-light">Management Asset IT</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-2 pb-2 mb-3 d-flex">
              <div class="image align-self-center">
                  <img src="{{url('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">Abdi Arkananta</a>
                  <span class="text-white badge badge-secondary"><small>Staff IT</small></span>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                      <a href="{{url('dashboard')}}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{url('data-barang')}}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Barang
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{url('barang-masuk')}}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Barang Baru Masuk
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{url('data-exim')}}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Import / Export
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{url('pengaturan')}}" class="nav-link">
                          <i class="fa fa-cog fa-lg"></i>
                          <p class="ml-2">
                              Pengaturan
                          </p>
                      </a>
                  </li>

              </ul>
          </nav>
  </aside>