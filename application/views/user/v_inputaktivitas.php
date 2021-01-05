<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inputan Aktivitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Inputan Aktivitas</li>
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
                <h3 class="card-title">Form Inputan Aktivitas</h3>

                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form id="form-input-aktifitas" action="<?= base_url('user/inputanAktifitas') ?>" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pilih aktivitas</label>
                                <select class="form-control select2" name="nameAktivitas" style="width: 100%;" onchange="selectAktivitas('<?= base_url() ?>' ,this.value)">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <?php foreach ($dataAktifitas as $value) { ?>
                                        <option value="<?= $value['aktivitas']; ?>"><?= $value['aktivitas']; ?></option>
                                    <?php } ?>
                                </select>
                                <div id="nameAktivitas"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div><br>
                    <div class="row">
                        <!-- posisi kanan -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Aktifitas</label>
                                <input type="text" id="kodeAktivitas" name="kodeAktivitas" class="form-control" placeholder="Data Otomatis terisi">
                            </div>
                            <div class="form-group">
                                <label>Nama Peserta</label>
                                <textarea class="form-control rounded-0" id="namaPeserta" name="namaPeserta" placeholder=" --Belum ada nama--" rows="8" readonly></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Jumlah Peserta</label>
                                <input type="text" name="jmlPeserta" id="jmlPeserta" class="form-control" maxlength="4" placeholder="Belum Ada Data" onkeypress="return hanyaAngka(event)" readonly>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Dana</label>
                                <input type="text" id="dana" name="dana" class="form-control" placeholder="Misal, Rp.100.000,00" onkeyup="keyupRupiah('dana',this.value)" style="text-align: right">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <label>Waktu Pelaksanaan</label>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Tanggal Mulai</label>
                                <input type="date" name="lht_tgl" id="tgl" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Tanggal Selesai</label>
                                <input type="date" name="lihat_tgl_selesai" id="tgl_selesai" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Nara Sumber</label>
                                <input type="text" name="naraSumber" id="naraSumber" class="form-control" placeholder="Masukan Narasumber">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select class="form-control select2" name="lokasi" style="width: 100%;">
                                        <option selected="selected" value="">--Pilih--</option>
                                        <option value="Kota Palu">Kota Palu</option>
                                        <option value="Solowe">Soulowe</option>
                                        <option value="Potoya">Potoya</option>
                                        <option value="Karawana">Karawana</option>
                                        <option value="Sidera">Sidera</option>

                                    </select>
                                    <div id="lokasi"></div>

                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Hasil Kegiatan</label>
                                <textarea class="form-control rounded-0" id="notulensi" name="notulensi" value="" rows="6"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Kesimpulan</label>
                                <textarea class="form-control rounded-0" id="kesimpulan" name="kesimpulan" value="" rows="6"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Dokumentasi</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img_dok" name="imageAktifitas[]" accept="image/*" multiple title="Pilih gambar dokumentasi">
                                    <label class="custom-file-label" for="image">Pilih gambar dokumentasi</label>
                                    <label class="label-image" style="font-size: 9px; font-style: italic;">* Upload Maksimal 5 gambar Format JPG, JPEG, PNG || Ukuran size Maksimal 4 MB </label>
                                </div>
                                <div id="imageAktifitas"></div>
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

                </form>
                <!-- /.row -->
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