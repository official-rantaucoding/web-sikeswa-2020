<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIKESWA - SISTEM INFORMASI KESEHATAN JIWA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- icon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/image/img_logo/') . $setting[0]['img_logo']; ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css_user/css_user.css">
    <!-- Theme style -->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition" style="background:; overflow-x: hidden">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12 col-md-12" style="margin-bottom: 10px;">
                    <div class="login-logo" style="display: inline-block">
                        <div class="row">
                            <div class="col-12">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <img src="<?= base_url('assets/image/img_logo/logo_kab_sigi.png') ?>" class="img-resposive ukuran-logo">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-judul-aplikasi"><span style="font-weight: bold; margin-top: 5%; font-size:60px"> SIKESWA</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-judul-aplikasi" style="font-size:20px; "><i>Sistem Informasi Kesehatan Jiwa</i></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-judul-aplikasi" style="font-size:20px">Kabupaten Sigi</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-judul-aplikasi" style="font-size: 10px">didukung Oleh :</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="letter-spacing: -7px">
                                                <img src="<?= base_url('assets/image/img_logo/sejenak.png') ?>" class="img-resposive log-support-hening">
                                                <img src="<?= base_url('assets/image/img_logo/caritas_jerman.gif') ?>" class="img-resposive log-support-carits">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-12 text-center">

                    <div class="login-box" style="display: inline-block">
                        <div class="card">

                            <div class="card-body login-card-body">
                                <p class="login-box-msg">Silahkan LogIn di layanan Kami</p>

                                <form action="<?= base_url('auth/verifikasi_log') ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" name="username" class="form-control" placeholder="Username" required oninvalid="this.setCustomValidity('Username masih kosong')" oninput="setCustomValidity('')">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" id="password" data-tampil="hide" name="password" class="form-control" placeholder="Password" required oninvalid="this.setCustomValidity('Password masih kosong')" oninput="setCustomValidity('')">
                                        <span class="input-group-append">
                                            <button type="button" onclick="tampilSandi('password', 'btn_password')" id="btn_password" class="btn btn-default btn-flat"><span class="fas fa-eye"></span></button>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in-alt"></i> LogIn</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
    <script src="<?= base_url('assets/') ?>jsuser/js_admin.js"></script>
    <script src="<?= base_url('assets/') ?>jsuser/js_other.js"></script>

</body>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span class="text-judul-aplikasi" style="font-size:12px">Copyright &copy; <?= date('Y') ?>SIKESWA ( SISTEM INFORMASI KESEHATAN JIWA ) Versi 0.1</span>
        </div>
    </div>
</footer>

</html>