<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Konseling (Rekam Medis)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item">Rekam Medis</li>
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
                <h3 class="card-title">Tambah Data Rekam Medis</h3>
            </div>
            <form method="post" action="<?= base_url('user/tambah_rekammedis') ?>" id="form_rekammedis">
                <!-- /.card-header -->
                <?php if ($role_rekam == 1) { ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class = "form-group">
                                    <label>Tanggal Kegiatan Konseling</label>
                                    <input type="date" id="tgl_rekam" name="tgl_rekam" class="form-control" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Informasi Kegiatan Konseling Pasien</label>
                                    <textarea class="form-control rounded-0" id="" name="catt_konseling" value="" rows="3" placeholder="--Belum ada kegiatan--" readonly></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No ID</label>
                                    <input type="hidden" id="id_assesment" name="id_assesment" value="<?= $data_assesment[0]['id_assesment'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>

                                    <input type="text" id="id_pasien" name="id_pasien" value="<?= $data_assesment[0]['id_pasien'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input type="text" id="jk" name="jk" value="<?= $data_assesment[0]['jk'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Rekam Medis </label>
                                    <input type="text" id="no_rekam_medis" name="no_rekam_medis" value="<?= $data_assesment[0]['no_rekam_medis'] ?>" class="form-control" placeholder=" Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Usia </label>
                                    <input type="text" id="usia" name="usia" value="<?= $data_assesment[0]['usia'] ?>" class="form-control" placeholder=" Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama lengkap</label>
                                    <input type="text" id="nm_lengkap" name="nm_lengkap" value="<?= $data_assesment[0]['nm_lengkap'] ?>" class="form-control" placeholder=" Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" id="pekerjaan" name="pekerjaan" value="<?= $data_assesment[0]['pekerjaan'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keluhan </label>
                                    <textarea class="form-control rounded-0" id="keluhan" name="keluhan" placeholder="Belum Ada Data" value="" rows="3" readonly><?= $data_assesment[0]['keluhan'] ?></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Diagnosa</label>
                                    <input type="text" id="diagnosa" name="diagnosa" value="<?= $data_assesment[0]['diagnosa'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Hasil Intervensi</label>
                                    <textarea class="form-control rounded-0" id="jns_terapi" name="jns_terapi" value="" rows="5"></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kesimpulan</label>
                                    <textarea class="form-control rounded-0" id="kesimpulan" name="kesimpulan" value="" rows="5"></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hasil Akhir</label>
                                    <select class="form-control select2" id="id_hasil_akhir" name="hasil_akhir" onchange="gethasilakhirCatatan(this.value, '<?= base_url() ?>')" style="width: 100%;">
                                        <option selected="selected" value="">--Pilih--</option>
                                        <option value="Konseling Lanjutan">Konseling Lanjutan</option>
                                        <option value="Rujukan ke Dokter / Dokter Spesialis">Rujukan ke Dokter / Dokter Spesialis</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                    <div id="hasil_akhir"></div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12" id="set_hasilakhirCatatan"></div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"> </i> Simpan </button>
                                    <a href="<?= base_url('user/datapasien/') ?>" class="btn btn-outline-danger"><i class="fa fa-sign-in-alt"></i> Batal </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- rekam lama -->
                <?php } else { ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if ($selesai_konseling) { ?>
                                    <button type="button" onclick="tambah_rekammedis_pasien('<?= base_url() ?>')" class="btn btn-outline-primary float-right"><i class="fas fa-plus"> </i>Tambah</button><br>
                                <?php } ?>
                                
                                <div class = "form-group">
                                    <label>Tanggal Kegiatan Konseling</label>
                                    <input type="date" id="tgl_rekam" name="tgl_rekam" class="form-control" value="<?= $data_rekam[0]['tgl_rekam'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Informasi Kegiatan Konseling Pasien</label>
                                    <textarea class="form-control rounded-0" id="keg_konseling" name="keg_konseling" rows="3" placeholder="--Belum ada kegiatan--" readonly><?= $kegiatan_rekam; ?></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No ID</label>
                                    <input type="hidden" id="id_assesment" name="id_assesment" value="<?= $data_assesment[0]['id_assesment'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                    <input type="text" id="id_pasien" name="id_pasien" value="<?= $data_assesment[0]['id_pasien'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input type="text" id="jk" name="jk" value="<?= $data_assesment[0]['jk'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Rekam Medis </label>
                                    <input type="text" id="no_rekam_medis" name="no_rekam_medis" value="<?= $data_assesment[0]['no_rekam_medis'] ?>" class="form-control" placeholder=" Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Usia </label>
                                    <input type="text" id="usia" name="usia" value="<?= $data_assesment[0]['usia'] ?>" class="form-control" placeholder=" Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama lengkap</label>
                                    <input type="text" id="nm_lengkap" name="nm_lengkap" value="<?= $data_assesment[0]['nm_lengkap'] ?>" class="form-control" placeholder=" Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" id="pekerjaan" name="pekerjaan" value="<?= $data_assesment[0]['pekerjaan'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keluhan </label>
                                    <textarea class="form-control rounded-0" id="keluhan" name="keluhan" placeholder="Belum Ada Data" value="" rows="3" readonly><?= $data_assesment[0]['keluhan'] ?></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Diagnosa</label>
                                    <input type="text" id="diagnosa" name="diagnosa" value="<?= $data_assesment[0]['diagnosa'] ?>" class="form-control" placeholder="Belum Ada Data" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-12 col-sm-12" id="jns_terapi_html">
                                <div class="form-group">
                                    <label>Hasil Intervensi</label>
                                    <textarea class="form-control rounded-0" id="jns_terapi" name="jns_terapi" rows="5" readonly="readonly"><?= $data_rekam[0]['jns_terapi'] ?></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12" id="kesimpulan_html">
                                <div class="form-group">
                                    <label>Kesimpulan</label>
                                    <textarea class="form-control rounded-0" id="kesimpulan" name="kesimpulan" rows="5" readonly="readonly"><?= $data_rekam[0]['kesimpulan'] ?></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12" id="hasil_akhir_html">
                                <div class="form-group">
                                    <label>Hasil Akhir</label>
                                    <input type="id_hasil_akhir" name="hasil_akhir" class="form-control" value="<?= $data_rekam[0]['hasil_akhir'] ?>" readonly="readonly">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12" id="set_hasilakhirCatatan">
                                <?php if ($data_rekam[0]['role_rekam'] == "Rujukan ke Dokter / Dokter Spesialis") { ?>
                                    <div class='form-group'>
                                        <label>Catatan</label>
                                        <textarea class='form-control rounded-0' id='catt_akhir' name='catt_akhir' value='' rows='5'></textarea>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="form-group" id="btn_simpan_rekam_baru">
                                    <a href="<?= base_url('user/datapasien/') ?>" class="btn btn-outline-danger"><i class="fa fa-sign-in-alt"></i> Batal</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                <?php } ?>
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