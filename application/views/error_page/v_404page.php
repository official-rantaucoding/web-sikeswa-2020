<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- icon -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/image/img_logo/') . $setting[0]['img_logo']; ?>">
  <title>SIKESWA - SISTEM INFORMASI KESEHATAN JIWA</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav id="tema_colorheaderbar" class="main-header navbar navbar-expand-md <?= $setting[0]['color_header']; ?>">
    <div class="container">
     

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        
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
            <?php if ($this->session->userdata('lock') == "false") { ?>
            <a href="<?= base_url('auth/get_lock') ?>" class="btn btn-default btn-flat"><i class="fas fa-lock"></i> Lock</a>
            <?php } if ($this->session->userdata('lock') == "true") { ?>
            <a href="<?= base_url('auth/lockpage') ?>" class="btn btn-default btn-flat"><i class="fas fa-unlock"></i> Unlock</a>
            <?php } ?>
            <a href="<?= base_url('auth/log_out') ?>" class="btn btn-default btn-flat float-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> EROR <small>404</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ERROR 404</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-body">
                        <div class="error-page">
                            <h2 class="headline text-warning"> 404</h2>

                            <div class="error-content">
                              <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Halaman tidak ditemukan.</h3>

                              <p>
                                Kami tidak menemukan halaman yang anda minta.
                                Silahkan masukan halaman yang anda inginkan dengan benar atau pilih salah satu menu pada sidebar.
                              </p>

                              <a href="<?= base_url($this->session->userdata('dashboard')) ?>" class="btn btn-sm btn-primary">Kembali ke Dashboard</a>
                            </div>
                            <!-- /.error-content -->
                          </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
</body>
</html>
