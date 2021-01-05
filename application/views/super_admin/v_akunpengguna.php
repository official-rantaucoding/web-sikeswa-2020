<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Akun Pengguna Super Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('superadmin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pengguna Super admin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Pengguna</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <form id="form_pengguna_superadm" class="form-pengguna" action="<?= base_url('superadmin/tambah_pengguna') ?>" method="post" enctype="multipart/form-data">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fullname </label>
                                <input type="hidden" name="kd_pggn" readonly="readonly">
                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Masukan Fullname">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Masukan Username">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="idubah">Password</label>
                                <div class="input-group">
                                    <input type="password" id="apassword" name="password" data-tampil="hide" class="form-control" placeholder="Masukan Password...">
                                    <span class="input-group-append">
                                        <button type="button" onclick="tampilSandi('apassword', 'btn_password')" id="btn_password" class="btn btn-default btn-flat"><span class="fas fa-eye"></span></button>
                                    </span>
                                </div>
                                <div id="password"></div>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Status Akun</label>
                                <select class="form-control select2 status" name="status" id="a_status" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak</option>

                                </select>
                                <div id="status"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Level Akun</label>
                                <select class="form-control select2 level" name="level" id="a_level" onchange="s_getJabatan()" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option jabatan='Super Admin' value="1">Super Admin</option>
                                    <option jabatan='Admin' value="2">Admin</option>
                                    <option jabatan='Psikolog' value="3">Psikolog</option>
                                    <option jabatan='Dokter' value="4">Dokter</option>
                                    <option jabatan='Kader' value="5">Kader</option>
                                    <option jabatan='Field Officer' value="6">Field Officer</option>
                                    <option jabatan='User Umum' value="7">User Umum</option>
                                </select>
                                <input type="hidden" name="jabatan" class="form-control">
                                <div id="level"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="customFile">Upload Photo</label>
                                <div class="custom-file">
                                    <input type="hidden" name="photo_old" readonly="readonly">
                                    <input type="file" accept="image/png, image/jpg, image/jpeg" name="photo" class="custom-file-input" id="customFile" title="Pilih gambar profil">
                                    <label class="custom-file-label" for="customFile">Pilih gambar profil</label>
                                </div>
                                <label style="font-size: 10px; font-style: italic;">* Format *.png|*.jpg|*.jpeg || Ukuran Upload File Maksimal 4 MB <span id="lbl_ubah_photo"></span>
                                </label>
                                <div id="photo"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="btn_ubah_pengguna" type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                <button id="btn_ubah_pengguna_batal" type="button" onclick="batalUbah('<?= base_url('superadmin/tambah_pengguna') ?>')" class="btn btn-outline-primary" style="display: none"><i class="fas fa-times"></i> Batal</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengguna</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th width="10%">Photo</th>
                            <th width="22%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_pengguna as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['fullname'] ?></td>
                                <td><?= $value['username'] ?></td>
                                <td><?= $value['jabatan'] ?></td>
                                <td><?= $value['status'] ?></td>
                                <td>
                                    <img style="width: 80%" src="<?= base_url('assets/image/img_pengguna/') . $value['foto'] ?>" class="img-circle elevation-1" alt="User Image">
                                </td>
                                <td>
                                    <button type="button" onclick="ubah_pengguna('<?= base_url('superadmin/ubahpengguna') ?>','<?= $value['id_pengguna'] ?>')" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Ubah</button>
                                    <button type="button" onclick="hapus_pengguna('<?= base_url('superadmin/hapuspengguna') ?>','<?= $value['id_pengguna'] ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
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