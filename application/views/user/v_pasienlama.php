<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pasien Lama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item">Data Pasien Lama</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pasien Lama</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-9"> </div>
                    <div class="col-sm-12 col-md-3">
                        <form action="<?= base_url('user/pasienlama') ?>" method="post">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-group mb-3">
                                                <label>Search:</label>
                                        </td>
                    </div>
                    <td>
                        <div class="input-group mb-3">
                            <input type="search" name="search" class="form-control form-control-sm" placeholder="Cari data pasien" aria-controls="example1" required oninvalid="this.setCustomValidity('key masih kosong')" oninput="setCustomValidity('')">
                            <span class="input-group-append">
                                <button type="submit" id="btn_submit" class="btn btn-default btn-sm"><span class="fas fa-search"></span></button>
                            </span>
                        </div>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </form>
                </div>
            </div>

            <?php if ($tampil_tabel == 1) { ?>
                <table id="tabelpasienlama" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th width="26%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="6">Cari data pasien lama terlebih dahulu</td>
                        </tr>
                    </tbody>
                </table>
            <?php } else if ($tampil_tabel == 2) { ?>
                <table id="tabelpasienlama" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th width="26%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="6">Data pasien lama <?= $nama_pasien; ?> tidak ditemukan</td>
                        </tr>
                    </tbody>
                </table>
            <?php } else if ($tampil_tabel == 3) { ?>
                <table id="tabelpasienlama" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">No Rekam Medis</th>
                            <th width="10%">No ID Pasien</th>
                            <th width="20%">Nama Lengkap</th>
                            <th width="20%">Alamat</th>
                            <th width="10%">Tanggal Lahir</th>
                            <th width="16%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_pasienlama as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['no_rekam_medis'] ?></td>
                                <td><?= $value['id_pasien'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['tgl_lahir'] ?></td>
                                <td>
                                    <a href="<?= base_url('user/assesment_baru/' . encrypt_url($value['id_pasien'])); ?>" class="btn btn-success btn-sm"><i class="nav-icon fa fa-file-signature"></i>Assessment Baru</a>
                                    <br><br>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="view_ubah_pasien('<?= base_url() ?>', '<?= $value['id_pasien'] ?>')"><i class="fas fa-edit"></i> Ubah</button>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            <?php } ?>
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

<!-- modal lihat tor -->
<div class="modal fade" id="modal-ubah-pasienlama">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Ubah Pasien Lama</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/ubah_pasien') ?>" method="post" id="form_ubah_pasien">
                <div class="modal-body">
                    <div class="row">
                        <!-- posisi kanan -->
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nomor Rekam Medis</label>
                                <input type="text" id="no_rekam" name="no_rekam" class="form-control" placeholder="Masukan Nomor Rekam Medis">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nomor Handphone / Telephone</label>
                                <input type="text" id="no_hp" name="no_hp" class="form-control notelp" placeholder="Masukan Nomor Telpon / HP, misal: 0822xxxxx (*isi jika dilakukan)" onkeyup="formatTelepon('no_hp', this.value)" onkeypress="return hanyaAngka(event)">

                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama lengkap</label>
                                <input type="text" id="nm_lengkap" name="nm_lengkap" class="form-control" placeholder="Masukan Nama Lengkap" onkeypress="return hanyaHuruf(event)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control" placeholder=" Masukan ALamat">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Nama Panggilan</label>
                                <input type="text" id="nm_panggilan" name="nm_panggilan" class="form-control" placeholder="Masukan Nama Panggilan" onkeypress="return hanyaHuruf(event)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select class="form-control select2" id="akabupaten" name="kabupaten" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Sigi">Sigi</option>
                                </select>
                                <div id="kabupaten"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir" onkeypress="return hanyaHuruf(event)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>kecamatan</label>
                                <select class="form-control select2" id="kecamatan" onchange="pilih_desa(this.value)" name="nm_kecamatan" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Dolo">Dolo</option>
                                    <option value="Sigi Biromaru">Sigi Biromaru</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <div id="nm_kecamatan"></div>
                                <!-- <div id="akecamatan"></div> -->
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Desa</label>
                                <select class="form-control select2" name="desa" id="desa-daftar" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih Terlebih Dahulu Kecamatan--</option>
                                </select>
                                <div id="desa"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Usia</label>
                                <input type="text" maxlength="2" id="usia" name="usia" class="form-control" placeholder="Masukan usia, misal: 34" onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select class="form-control select2" id="apendidikan" name="pendidikan" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="DI">DI</option>
                                    <option value="DII">DII</option>
                                    <option value="DIII">DIII</option>
                                    <option value="DIV">DIV</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                    <option value="Belum Sekolah">Belum Sekolah</option>
                                </select>
                                <div id="pendidikan"></div>
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control select2" id="ajenis_kelamin" name="jenis_kelamin" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Transeksual">Transeksual</option>
                                    <option value="Tidak diketahui">Tidak diketahui</option>
                                    <option value="Tidak menentukan">Tidak menentukan</option>
                                </select>
                                <div id="jenis_kelamin"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Masukan Pekerjaan" onkeypress="return hanyaHuruf(event)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control select2" id="aagama" name="agama" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                   <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                                </select>
                                <div id="agama"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Orang Tua / Keluarga</label>
                                <input type="text" id="nm_ortu" name="nm_ortu" class="form-control" placeholder="Masukan Nama Orang tua Dengan Lengkap" onkeypress="return hanyaHuruf(event)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2" id="astatus" name="status" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                    <option value="Janda">Janda</option>
                                    <option value="Duda">Duda</option>
                                </select>
                                <div id="status"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer ">
                    <input type="hidden" id="id_pasien" name="id_pasien" class="form-control" readonly>
                    <button type="submit" class="btn btn-outline-primary float-left"><i class="fas fa-edit"></i> Simpan perubahan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-sign-in-alt"> </i> Kembali</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->