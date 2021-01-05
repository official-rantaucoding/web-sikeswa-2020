<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pasien Baru</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pasien Baru</li>
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
                <h3 class="card-title">Tambah Data Pasien Baru</h3>

                <div class="card-tools">

                </div>
            </div>
            <form method="post" action="<?= base_url('user/tambah_pasien_baru') ?>" id="form-pasien-baru" class="form-horizontal" role="form">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <!-- posisi kanan -->
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nomor Rekam Medis</label>
                                <input type="text" id="no_rekam" name="no_rekam" value="<?= $kode_rekammedis; ?>" class="form-control" placeholder="Masukan Nomor Rekam Medis">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nomor Handphone / Telephone</label>
                                <input type="text" maxlength="12" id="no_hp" name="no_hp" class="form-control notelp" placeholder="Masukan Nomor Telpon / HP, misal: 0822xxxxx (*isi jika dilakukan)" onkeyup="formatTelepon('no_hp', this.value)" onkeypress="return hanyaAngka(event)">
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
                                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan Alamat">
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
                                <select class="form-control select2" name="kabupaten" style="width: 100%;">
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
                                <label>Kecamatan</label>
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
                                <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?= date('Y-m-d') ?>" onchange="hitung_umur(this.value)">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6" id="desaLainnya">
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
                                <select class="form-control select2" name="pendidikan" style="width: 100%;">
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
                                    <option value="Belum Sekolah">Belum Sekolah</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                </select>
                                <div id="pendidikan"></div>
                            </div> <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control select2" name="jenis_kelamin" style="width: 100%;">
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
                                <select class="form-control select2" name="agama" style="width: 100%;">
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
                                <select class="form-control select2" name="status" style="width: 100%;">
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
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary float-left"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
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
<!-- /.content-wrapper