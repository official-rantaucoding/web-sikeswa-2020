<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Kata Sandi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url($this->session->userdata('dashboard')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Kata Sandi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default ">
            <div class="card-header">
                <h3 class="card-title">Nama Pengguna </h3>

                <div class="card-tools">

                </div>
            </div>
            <form method="post" action="<?= base_url('other/do_ubah_sandi') ?>" id="form-ubah-sandi">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <!-- posisi kanan -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <input type="text" id="nama_pengguna" name="nama_pengguna" value="<?= $this->session->userdata('username') ?> " class="form-control" placeholder="Masukan Username">
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <!-- posisi kanan -->
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Masukan Kata Sandi lama</label>
                                <div class="input-group">
                                    <input type="password" id="asandi_lama" name="sandi_lama" data-tampil="hide" class="form-control" placeholder="Masukan Sandi lama">
                                    <span class="input-group-append">
                                        <button type="button" id="btn_sandi_lama" onclick="tampilSandi('asandi_lama', 'btn_sandi_lama')" class="btn btn-default btn-flat"><span class="fas fa-eye"></span></button>
                                    </span>
                                </div>
                                <div id="sandi_lama"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Masukan Kata Sandi Baru </label>
                                <div class="input-group">
                                    <input type="password" id="asandi_baru" name="sandi_baru" data-tampil="hide" class="form-control" placeholder="Masukan Sandi baru">
                                    <span class="input-group-append">
                                        <button type="button" id="btn_sandi_baru" onclick="tampilSandi('asandi_baru', 'btn_sandi_baru')" class="btn btn-default btn-flat"><span class="fas fa-eye"></span></button>
                                    </span>
                                </div>
                                <div id="sandi_baru"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Ulangi Kata sandi Baru</label>
                                <div class="input-group">
                                    <input type="password" id="akonfir_sandi_baru" name="konfir_sandi_baru" data-tampil="hide" class="form-control" placeholder="Konfirmasi sandi baru">
                                    <span class="input-group-append">
                                        <button type="button" id="btn_confsandi_baru" onclick="tampilSandi('akonfir_sandi_baru', 'btn_confsandi_baru')" class="btn btn-default btn-flat"><span class="fas fa-eye"></span></button>
                                    </span>
                                </div>
                                <div id="konfir_sandi_baru"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary float-left"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->