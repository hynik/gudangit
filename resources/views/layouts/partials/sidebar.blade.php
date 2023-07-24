  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <!-- <img src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
          <!-- <i class="fa-solid fa-warehouse" style="margin-right: 10px; margin-left:10px;"></i> -->
          <img src="{{asset('logotok.png')}}" alt="" class="brand-image img-circle">
          <span class="brand-text font-weight-light">Management Asset IT</span>
      </a>
  <?php $fitur = json_decode(session()->get('userCredential')[0]['akses_fitur'])->fitur; 
  ?>
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
                      <a href="{{url('dashboard')}}" class="nav-link {{ (Request::segment(1) == 'dashboard') ? 'active' : '' }}">
                          <i class="nav-icon fa-solid fa-chart-simple"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item {{ (Request::segment(1) == 'master') ? 'menu-open' : '' }} {{ (in_array('data_aset', $fitur) || in_array('tambah_kategori', $fitur) || in_array('tambah_aset', $fitur)) ? '' : 'd-none' }}">
                      <a href="#" class="nav-link {{ (Request::segment(1) == 'master') ? 'active' : '' }}">
                          <i class="nav-icon fa-solid fa-box"></i>
                          <p>
                              Master Asset IT
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item {{ (in_array('data_aset', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{url('master/data-aset')}}" class="nav-link {{ (Request::segment(2) == 'data-aset') ? 'active' : '' }}">
                                  <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                                  <p>Data Aset</p>
                              </a>
                          </li>
                          <li class="nav-item {{ (in_array('tambah_kategori', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{url('master/tambah-kat')}}" class="nav-link {{ (Request::segment(2) == 'tambah-kat') ? 'active' : '' }}">
                                  <i class="nav-icon fa-solid fa-lines-leaning"></i>
                                  <p>Kategori Aset</p>
                              </a>
                          </li>
                          <li class="nav-item {{ (in_array('tambah_aset', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{url('master/barang-masuk')}}" class="nav-link {{ (Request::segment(2) == 'barang-masuk') ? 'active' : '' }}">
                                  <i class="nav-icon fa-solid fa-dolly"></i>
                                  <p>
                                      Tambah Aset Baru
                                  </p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item {{ (Request::segment(1) == 'formulir') ? 'menu-open' : '' }} {{ (in_array(['purchase_order'], $fitur) || in_array('daftar_purchase_order', $fitur) || in_array('laporan_purchase_order', $fitur)) ? '' : 'd-none' }}">
                      <a href="#" class="nav-link {{ (Request::segment(1) == 'formulir') ? 'active' : '' }}">
                          <i class="nav-icon fa-regular fa-rectangle-list"></i>
                          <p>
                              Formulir
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item {{ (in_array('purchase_order', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{url('formulir/pengajuan')}}" class="nav-link {{ (Request::segment(2) == 'pengajuan') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Purchase Order</p>
                              </a>
                          </li>
                          <li class="nav-item {{ (in_array('daftar_purchase_order', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{(json_decode(session()->get('userCredential')[0]['akses_fitur'])->approval == true) ? url('formulir/daftar/aprov') : url('formulir/daftar/po')}}" class="nav-link {{ (Request::segment(3) == 'po' || Request::segment(3) == 'aprov') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Daftar Purchase Order</p>
                              </a>
                          </li>
                          <li class="nav-item {{ (in_array('laporan_purchase_order', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{url('formulir/laporan-pembelian')}}" class="nav-link {{ (Request::segment(2) == 'laporan-pembelian') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Laporan Pembelian</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item {{ (in_array('kelola_aset', $fitur)) ? '' : 'd-none' }}">
                      <a href="{{url('kelola-aset')}}" class="nav-link {{ (Request::segment(1) == 'kelola-aset') ? 'active' : '' }}">
                          <i class="nav-icon fa-solid fa-clipboard-list"></i>
                          <p>
                              Kelola Aset
                          </p>
                      </a>
                  </li>
                  <!-- <li class="nav-item">
                      <a href="{{url('his-pengguna')}}" class="nav-link {{ (Request::segment(1) == 'his-pengguna') ? 'active' : '' }}">
                          <i class="nav-icon fa-solid fa-clipboard-list"></i>
                          <p>
                              Aktifitas Pengguna
                          </p>
                      </a>
                  </li> -->
                  <li class="nav-item {{ (Request::segment(1) == 'pengaturan') ? 'menu-open' : '' }}">
                      <a href="{{url('pengaturan')}}" class="nav-link {{ (Request::segment(1) == 'pengaturan') ? 'active' : '' }}">
                          <i class="nav-icon fa fa-cog fa-lg"></i>
                          <p>Pengaturan</p>
                          <i class="fas fa-angle-left right"></i>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item {{ (in_array('tambah_pengguna', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{url('pengaturan/tambah-pengguna')}}" class="nav-link {{ (Request::segment(2) == 'tambah-pengguna') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Tambah Pengguna</p>
                              </a>
                          </li>
                          <li class="nav-item {{ (in_array('daftar_pengguna', $fitur)) ? '' : 'd-none' }}">
                              <a href="{{url('pengaturan/daftar-pengguna')}}" class="nav-link {{ (Request::segment(2) == 'pengguna' || Request::segment(2) == 'daftar-pengguna') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Daftar Pengguna</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{url('pengaturan/ubah-password')}}" class="nav-link {{ (Request::segment(2) == 'ubah-password') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ubah Password</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
  </aside>