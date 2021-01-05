  <!-- Navbar -->
  <nav id="tema_colorheaderbar" class="main-header navbar navbar-expand <?= $setting[0]['color_header']; ?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('other/tentang') ?>" class="nav-link <?= ($this->uri->segment(1) == 'other' && $this->uri->segment(2) == 'tentang') ? 'active' : ''; ?>"><i class="fa fa-info-circle"></i> Tentang</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <li class="breadcrumb-item active"> <a href="<?= base_url('other/bantuan') ?>" class="nav-link <?= ($this->uri->segment(1) == 'other' && $this->uri->segment(2) == 'bantuan') ? 'active' : ''; ?>"><i class="fa fa-question-circle"></i> Bantuan</a></li>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

          <img id="img-pengguna-topbar" src="<?= base_url('assets/image/img_pengguna/') . $this->session->userdata('foto'); ?>" class="user-image img-circle elevation-1" alt="User Image">
          <span class="d-none d-md-inline">
            <span id="nama_lengkap_topbar"><?= $this->session->userdata('nama_lengkap') ?></span> <i class="fas fa-angle-down"></i>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li id="tema_colorprofile" class="user-header <?= $setting[0]['color_profile']; ?>">
            <img id="imgpengguna-topbar-dropdown" src="<?= base_url('assets/image/img_pengguna/') . $this->session->userdata('foto'); ?>" class="img-circle elevation-2" alt="User Image">

            <p>
              <span id="namalengkap_topbar_dropdown"><?= $this->session->userdata('nama_lengkap') ?></span>
              <small><?= $this->session->userdata('jabatan') ?></small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="<?= base_url('auth/get_lock') ?>" class="btn btn-default btn-flat"><i class="fas fa-lock"></i> Lock</a>
            <a href="<?= base_url('auth/log_out') ?>" class="btn btn-default btn-flat float-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </li>
      <!-- <li class="nav-item">
              <a href="#" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->