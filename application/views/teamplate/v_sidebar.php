  <!-- Main Sidebar Container -->
  <aside id="tema_colorsidebar" class="main-sidebar elevation-4 <?= $setting[0]['color_sidebar']; ?>">
      <!-- Brand Logo -->
      <a href="#" id="tema_colorlogobar" class="brand-link <?= $setting[0]['color_logobar']; ?>">
          <img src="<?= base_url('assets/image/img_logo/') . $setting[0]['img_logo']; ?>" alt="Caritas Logo" class="brand-image img-circle elevation-0" style="opacity: .8">
          <span class="brand-text font-weight-light">SIKESWA</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <?php if ($this->session->userdata('level') == 1) { ?>
                      <li class="nav-header">SUPER ADMIN</li>
                      <li class="nav-item">
                          <a href="<?= base_url('superadmin/dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'superadmin' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-clinic-medical"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('superadmin/settingtema') ?>" class="nav-link <?= ($this->uri->segment(2) == 'settingtema') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-cogs"></i>
                              <p>
                                  Setting
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('superadmin/akunpengguna') ?>" class="nav-link <?= ($this->uri->segment(1) == 'superadmin' && $this->uri->segment(2) == 'akunpengguna') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-key"></i>
                              <p>
                                  Akun Pengguna
                              </p>
                          </a>
                      </li>

                  <?php }
                    if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) { ?>
                      <li class="nav-header">ADMIN</li>
                      <li class="nav-item">
                          <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-clinic-medical"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?= base_url('admin/akunpengguna') ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'akunpengguna') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-key"></i>
                              <p>
                                  Akun Pengguna
                              </p>
                          </a>
                      </li>
                      <li class="nav-item has-treeview <?= ($this->uri->segment(2) == 'pasienindividu' || $this->uri->segment(2) == 'pasienkelompok') ? 'menu-open' : ''; ?>">
                          <a href="#" class="nav-link <?= ($this->uri->segment(2) == 'pasienindividu' || $this->uri->segment(2) == 'pasienkelompok') ? 'active' : ''; ?>">
                              <i class="nav-icon fa fa-notes-medical"></i>
                              <p>
                                  Daftar Pasien
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="<?= base_url('admin/pasienindividu') ?>" class="nav-link <?= ($this->uri->segment(2) == 'pasienindividu') ? 'active' : ''; ?>">
                                      <i class="fa fa-user nav-icon"></i>
                                      <p>Pasien Individu</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="<?= base_url('admin/pasienkelompok') ?>" class="nav-link <?= ($this->uri->segment(2) == 'pasienkelompok') ? 'active' : ''; ?>">
                                      <i class="fa fa-user-friends nav-icon"></i>
                                      <p>Pasien Kelompok</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item has-treeview <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukankader' || $this->uri->segment(1) == 'admin' && $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukandokter') ? 'menu-open' : ''; ?>">
                          <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukankader' || $this->uri->segment(1) == 'admin' && $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukandokter') ? 'active' : ''; ?>">
                              <i class="nav-icon fa fa-paste"></i>
                              <p>
                                  Laporan Layanan
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview" <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukankader' || $this->uri->segment(1) == 'admin' && $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukandokter') ? 'style="display: block;"' : ''; ?>>
                              <ul class="nav nav-treeview" <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukankader' || $this->uri->segment(1) == 'admin' && $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukandokter') ? 'style="display: block;"' : ''; ?>>
                                  <li class="nav-item has-treeview <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukankader' || $this->uri->segment(1) == 'admin' && $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukandokter') ? 'menu-open' : ''; ?>">
                                      <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukankader' || $this->uri->segment(1) == 'admin' && $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'rujukandokter') ? 'active' : ''; ?>">
                                          <i class="fa fa-newspaper nav-icon"></i>
                                          <p>
                                              Rujukan
                                              <i class="right fas fa-angle-left"></i>
                                          </p>
                                      </a>
                                      <ul class="nav nav-treeview">
                                          <li class="nav-item">
                                              <a href="<?= base_url('admin/rujukanpsikolog') ?>" class="nav-link <?= ($this->uri->segment(2) == 'rujukanpsikolog') ? 'active' : ''; ?>">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>Psikolog</p>
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a href="<?= base_url('admin/rujukandokter') ?>" class="nav-link <?= ($this->uri->segment(2) == 'rujukandokter') ? 'active' : ''; ?>">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>Dokter</p>
                                              </a>
                                          </li>
                                      </ul>
                                  </li>
                              </ul>
                          </ul>
                      </li>

                      <li class="nav-item has-treeview <?= ($this->uri->segment(2) == 'laporantahun' || $this->uri->segment(2) == 'laporanbulan') ? 'menu-open' : ''; ?>">
                          <a href="#" class="nav-link <?= ($this->uri->segment(2) == 'laporantahun' || $this->uri->segment(2) == 'laporanbulan') ? 'active' : ''; ?>">
                              <i class="nav-icon fa fa-clipboard-list"></i>
                              <p>
                                  Laporan Kasus
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="<?= base_url('admin/laporanbulan') ?>" class="nav-link <?= ($this->uri->segment(2) == 'laporanbulan') ? 'active' : ''; ?>">
                                      <i class="fa fa-list-alt nav-icon"></i>
                                      <p>Laporan Bulanan</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="<?= base_url('admin/laporantahun') ?>" class="nav-link <?= ($this->uri->segment(2) == 'laporantahun') ? 'active' : ''; ?>">
                                      <i class="fa fa-list-alt nav-icon"></i>
                                      <p>Laporan Tahunan</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('admin/laporanaktifitasadmin') ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'laporanaktifitasadmin') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-chart-line"></i>
                              <p>
                                  Laporan Aktifitas
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('admin/daftartoradmin') ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'daftartoradmin') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-edit"></i>
                              <p>
                                  Daftar TOR
                              </p>
                          </a>
                      </li>

                  <?php }
                    if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4 || $this->session->userdata('level') == 5) { ?>

                      <li class="nav-header">USER</li>
                      <li class="nav-item">
                          <a href="<?= base_url('user/dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-clinic-medical"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>

                      <li class="nav-item has-treeview <?= ($this->uri->segment(2) == 'pasienbaru' || $this->uri->segment(2) == 'pasienlama') ? 'menu-open' : ''; ?>">
                          <a href="#" class="nav-link <?= ($this->uri->segment(2) == 'pasienbaru' || $this->uri->segment(2) == 'pasienlama') ? 'active' : ''; ?>">
                              <i class="nav-icon fa fa-notes-medical"></i>
                              <p>
                                  Pendaftaran Pasien
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="<?= base_url('user/pasienbaru') ?>" class="nav-link <?= ($this->uri->segment(2) == 'pasienbaru') ? 'active' : ''; ?>">
                                      <i class="fa fa-user-plus nav-icon"></i>
                                      <p>Pasien Baru</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="<?= base_url('user/pasienlama') ?>" class="nav-link <?= ($this->uri->segment(2) == 'pasienlama') ? 'active' : ''; ?>">
                                      <i class="fa fa-users nav-icon"></i>
                                      <p>Pasien Lama</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('user/datapasien') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'datapasien') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-book-medical"></i>
                              <p>
                                  Data Pasien
                              </p>
                          </a>
                      </li>

                      <li class="nav-item has-treeview <?= ($this->uri->segment(2) == 'layananindividu' || $this->uri->segment(2) == 'layanankelompok') ? 'menu-open' : ''; ?>">
                          <a href="#" class="nav-link <?= ($this->uri->segment(2) == 'layananindividu' || $this->uri->segment(2) == 'layanankelompok') ? 'active' : ''; ?>">
                              <i class="nav-icon fa fa-file-contract"></i>
                              <p>
                                  Layanan
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="<?= base_url('user/layananindividu') ?>" class="nav-link <?= ($this->uri->segment(2) == 'layananindividu') ? 'active' : ''; ?>">
                                      <i class="fa fa-user nav-icon"></i>
                                      <p> Konseling Individu</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="<?= base_url('user/layanankelompok') ?>" class="nav-link <?= ($this->uri->segment(2) == 'layanankelompok') ? 'active' : ''; ?>">
                                      <i class="fa fa-user-friends nav-icon"></i>
                                      <p> Konseling Kelompok</p>
                                  </a>
                              </li>


                          </ul>
                      </li>
                      <li class="nav-item has-treeview <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'rujukandokter') ? 'menu-open' : ''; ?>">
                          <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'rujukanpsikolog' || $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'rujukandokter') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-book"></i>
                              <p>
                                  Rujukan
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="<?= base_url('user/rujukanpsikolog') ?>" class="nav-link <?= ($this->uri->segment(2) == 'rujukanpsikolog') ? 'active' : ''; ?>">
                                      <i class="nav-icon fa fa-file-contract"></i>
                                      <p> Rujukan Psikolog </p>
                                      <span class="badge badge-danger right" id="counter_rujukan_psikolog"></span>
                                  </a>

                              </li>

                              <li class="nav-item">
                                  <a href="<?= base_url('user/rujukandokter') ?>" class="nav-link <?= ($this->uri->segment(2) == 'rujukandokter') ? 'active' : ''; ?>">
                                      <i class="nav-icon fa fa-file-contract"></i>
                                      <p>Rujukan Ke Dokter</p>
                                      <span class="badge badge-info right" id="counter_rujukan_dokter"></span>

                                  </a>
                              </li>
                          </ul>
                      </li>

                  <?php }
                    if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 6) { ?>

                      <li class="nav-header">USER FIELD OFFICER</li>
                      <li class="nav-item">
                          <a href="<?= base_url('user/pendaftaranpeserta') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'pendaftaranpeserta') ? 'active' : ''; ?>">
                              <i class="nav-icon fa fa-file-signature"></i>
                              <p>
                                  Pendaftaran Peserta
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('user/datapeserta') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'datapeserta') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-user-edit"></i>
                              <p>
                                  Data Peserta
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('user/inputaktivitas') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'inputaktivitas') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-edit"></i>
                              <p>
                                  Inputan Aktivitas
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('user/laporanaktivitas') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'laporanaktivitas') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-chart-line"></i>
                              <p>
                                  Laporan Aktivitas
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?= base_url('user/inputantor') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'inputantor') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-edit"></i>
                              <p>
                                  Inputan TOR
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="<?= base_url('user/daftartor') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'daftartor') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-copy"></i>
                              <p>
                                  Daftar TOR
                              </p>
                          </a>
                      </li>

                  <?php }
                    if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 7) { ?>
                      <li class="nav-header">USER UMUM</li>
                      <li class="nav-item">
                          <a href="<?= base_url('userumum/dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'userumum' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                              <i class="nav-icon fas fa-clinic-medical"></i>
                              <p>
                                  Informasi Terkini
                              </p>
                          </a>
                      </li>
                  <?php } ?>

                  <li class="nav-header">PROFILE PENGGUNA</li>
                  <li class="nav-item">
                      <a href="<?= base_url('other/ubah_profile') ?>" class="nav-link <?= ($this->uri->segment(1) == 'other' && $this->uri->segment(2) == 'ubah_profile') ? 'active' : ''; ?>">
                          <i class="nav-icon fa fa-address-card"></i>
                          <p>
                              Ubah Profile
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="<?= base_url('other/ubah_sandi') ?>" class="nav-link <?= ($this->uri->segment(1) == 'other' && $this->uri->segment(2) == 'ubah_sandi') ? 'active' : ''; ?>">
                          <i class="nav-icon fa fa-user-lock"></i>
                          <p>
                              Ubah Kata Sandi
                          </p>
                      </a>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>