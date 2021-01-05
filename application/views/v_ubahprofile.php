<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url($this->session->userdata('dashboard')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-cogs"></i> Ubah Profile</h3>

                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td width="100%">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="customFile">Ubah Profile Saya</label><br>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img id="img_profil" style="width: 90%" src="<?= base_url('assets/image/img_pengguna/') . $this->session->userdata('foto'); ?>" class="img-circle elevation-1 img-responsive" alt="User Image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <form action="<?= base_url('other/do_ubah_profile') ?>" method="post" enctype="multipart/form-data" id="form-ubah_profile">
                                                    <div class="form-group">
                                                        <label for="customFile">Data Profile</label>
                                                        <input type="text" name="fullname_pengguna" id="fullname_pengguna" class="form-control" placeholder="Masukan Nama Lengkap" value="<?= $this->session->userdata('nama_lengkap'); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/png,image/jpg, image/jpeg" name="photo_pengguna_other" class="custom-file-input" id="customFile" title="Pilih gambar profil">
                                                            <label class="custom-file-label" for="customFile">Pilih gambar profil</label>
                                                        </div>
                                                        <label style="font-size: 10px; font-style: italic;">* Format *.png|*.jpg|*.jpeg || Ukuran Upload File Maksimal 4 MB <br>
                                                         * Isi hanya jika file photo ingin di ubah<br>
                                                         * Ukuran gambar disarankan 512 x 512
                                                        </label>
                                                        <div id="photo_pengguna_other"></div>
                                                    </div>

                                                    <div class="form-group">
                                                         <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah Profile</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card -->
        <!-- /.card -->



    </section>
    <!-- /.content -->
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->