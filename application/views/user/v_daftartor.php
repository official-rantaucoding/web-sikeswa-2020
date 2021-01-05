<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar TOR</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Daftar TOR</li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data TOR</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode TOR</th>
                            <th>Judul TOR</th>
                            <th>Narasumber</th>
                            <th width="18%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($daftar_tor as $value) { ?>
                            <tr>
                                <td><?= $no . "."; ?></td>
                                <td><?= $value['kode_tor'] ?></td>
                                <td><?= $value['judul_tor'] ?></td>
                                <td><?= $value['fasilitator'] ?></td>
                                <td>
                                    <?php if ($value['role_rab'] == "Proses") { ?>
                                        <span style="color: blue; font-weight: bold">Proses</span>
                                    <?php } else if ($value['role_rab'] == "Revisi") { ?>
                                        <span style="color: red; font-weight: bold">Revisi :</span><br>
                                        <?= $value['cat_rev'] ?>
                                    <?php } else if ($value['role_rab'] == "Di Setujui") { ?>
                                        <span style="color: green; font-weight: bold">Di Setujui</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">

                                    <button class="btn btn-danger btn-sm" onclick="view_lihatTor('<?= base_url() ?>', '<?= $value['kode_tor'] ?>')"><i class="fa fa-eye"></i> Lihat</button>
                                    <br /><br />
                                    <?php if ($value['role_rab'] == "Revisi") { ?>
                                        <button class="btn btn-success btn-sm" onclick="view_ubahTor('<?= base_url() ?>', '<?= $value['kode_tor'] ?>')"><i class="fas fa-edit"></i> Ubah</button>
                                    <?php } ?>

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
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->

<!-- modal lihat tor -->
<div class="modal fade" id="modal-lihat-tor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat Data TOR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <!-- posisi kanan -->
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Judul TOR</label>
                            <input type="text" name="lht_judul_tor" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Latar Belakang</label>
                            <textarea class="form-control rounded-0" id="" name="lht_ltr_belakang" rows="8" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <textarea class="form-control rounded-0" id="" name="lht_tujuan" rows="4" readonly></textarea>
                        </div>

                        <div class="form-group">
                            <label>Fasilitator / Narasumber</label>
                            <textarea class="form-control rounded-0" id="" name="lht_fasilitator" rows="4" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Jumlah Peserta</label>
                            <input type="text" class="form-control rounded-0" id="lht_jml_peserta" maxlength="3" name="lht_jml_peserta" value="" placeholder="Silahkan Masukan Jumlah Peserta" onkeypress="return hanyaAngka(event)" readonly></input>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <label>Waktu Pelaksanaan</label>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label style="font-size: 14px;">Tanggal Mulai</label>
                            <input type="date" name="lht_tanggal" id="lht_tanggal" value="<?= date('Y-m-d') ?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label style="font-size: 14px;">Tanggal Selesai</label>
                            <input type="date" name="lht_tgl_selesai" id="lht_tgl_selesai" value="<?= date('Y-m-d') ?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lokasi Kegiatan</label>
                            <textarea class="form-control rounded-0" id="" name="lht_lokasi" rows="4" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="lht_kecamatan" class="form-control" readonly>
                            <label>Desa</label>
                            <input type="text" name="lht_desa" class="form-control" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Alokasi Anggaran</label>
                            <input type="text" name="lht_anggaran" class="form-control" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Perlengkapan</label>
                            <textarea class="form-control rounded-0" id="" name="lht_perlengkapan" rows="4" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Penutup</label>
                            <textarea class="form-control rounded-0" id="" name="lht_penutup" rows="6" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-12" id="html_lht_filerab_us"></div>
                </div>
            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-sign-in-alt"> </i> Kembali</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal ubah -->
<div class="modal fade" id="modal-ubah-tor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data TOR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/do_ubahTor') ?>" method="post" id="form_ubah_tor" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- posisi kanan -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Judul TOR</label>
                                <select class="form-control select2" name="ubh_judul_tor" id="tor-judultor" style="width: 100%;">
                                    <option value="">--Pilih--</option>
                                    <option value="1.1.1. Lokakarya bagi pegawai puskesmas dan kader desa sehat jiwa 1 : Asesment dasar, Deteksi dini, dan Sistem Rujukan">1.1.1. Lokakarya bagi pegawai puskesmas dan kader desa sehat jiwa 1 : Asesment dasar, Deteksi dini, dan Sistem Rujukan</option>
                                    <option value="1.1.2. Lokakarya bagi pegawai puskesmas dan kader desa sehat jiwa 2 : Konseling dasar">1.1.2. Lokakarya bagi pegawai puskesmas dan kader desa sehat jiwa 2 : Konseling dasar</option>
                                    <option value="1.1.3. Bimbingan teknis intensi oleh tim sejenkahening.com">1.1.3. Bimbingan teknis intensi oleh tim sejenkahening.com</option>
                                    <option value="1.1.4. Melakukan pembahasan kasus setiap bulan bersama tenaga kesehatan dan kader desa sehat jiwa">1.1.4. Melakukan pembahasan kasus setiap bulan bersama tenaga kesehatan dan kader desa sehat jiwa</option>
                                    <option value="1.1.5. Lokakarya penyusunan draft layanan kesehatan mental pada tingkat puskesmas">1.1.5. Lokakarya penyusunan draft layanan kesehatan mental pada tingkat puskesmas</option>
                                    <option value="1.1.6. Melakukan monitoring setiap tiga bulan sekali oleh tim sejenakhening.com ">1.1.6. Melakukan monitoring setiap tiga bulan sekali oleh tim sejenakhening.com </option>
                                    <option value="1.2.1. Melakukan rapat advokasi, sosialisasi dan sinkronisasi dengan program kerja dinas kesehatan kabupaten Sigi">1.2.1. Melakukan rapat advokasi, sosialisasi dan sinkronisasi dengan program kerja dinas kesehatan kabupaten Sigi</option>
                                    <option value="1.2.2. Promosi kepada masyarakat tentang adanya layanan kesehatan mental di dua puskesmas">1.2.2. Promosi kepada masyarakat tentang adanya layanan kesehatan mental di dua puskesmas</option>
                                    <option value="1.3.1. Penyediaan ruang pemulihan kesehatan mental">1.3.1. Penyediaan ruang pemulihan kesehatan mental</option>
                                    <option value="1.3.2. Melakukan asesment kondisi kesehatan mental penyintas yang tinggal di hunian sementara dan di 4 desa">1.3.2. Melakukan asesment kondisi kesehatan mental penyintas yang tinggal di hunian sementara dan di 4 desa</option>
                                    <option value="1.3.3. Menyediakan layanan kesehatan mental bagi penyintas yang berkolaborasi dengan kader desa sehat jiwa">1.3.3. Menyediakan layanan kesehatan mental bagi penyintas yang berkolaborasi dengan kader desa sehat jiwa</option>
                                    <option value="1.3.4. Menyediakan sistem layanan rujukan bagi penyintas yang mengalami permasalahan mental sedang hingga berat di puskesmas">1.3.4. Menyediakan sistem layanan rujukan bagi penyintas yang mengalami permasalahan mental sedang hingga berat di puskesmas</option>
                                    <option value="1.3.5. Menyediakan konseling kelompok bagi penyintas yang mengalami problem kesehatan mental">1.3.5. Menyediakan konseling kelompok bagi penyintas yang mengalami problem kesehatan mental</option>
                                    <option value="1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya">1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya</option>
                                    <option value="1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid">1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid</option>
                                    <option value="1.3.8. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang pemulihan pasca bencana">1.3.8. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang pemulihan pasca bencana</option>
                                    <option value="1.3.9. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang membangun ketangguhan diri">1.3.9. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang membangun ketangguhan diri</option>
                                    <option value="1.3.10. Melakukan advokasi dengan pemerintah desa dan kelompok PKK untuk kelanjutan program di desa">1.3.10. Melakukan advokasi dengan pemerintah desa dan kelompok PKK untuk kelanjutan program di desa</option>
                                    <option value="1.3.11. Strategy Exit Program : Dissemination of results through lesson learnt meeting at District Level">1.3.11. Strategy Exit Program : Dissemination of results through lesson learnt meeting at District Level</option>
                                    <option value="1.3.12. Strategi untuk mengakhiri program : Diseminai hasil di pemerintah kabupaten Sigi">1.3.12. Strategi untuk mengakhiri program : Diseminai hasil di pemerintah kabupaten Sigi</option>
                                    <option value="2.1.1. Melakukan pelatihan anggota kelompok manajemen kebencanaan desa tentang PFA">2.1.1. Melakukan pelatihan anggota kelompok manajemen kebencanaan desa tentang PFA</option>
                                    <option value="2.1.2. Memfasilitasi tim manajemen kebencanaan desa dalam menyusun manajemen kedaruratan bencana berbasis kesehatan mental">2.1.2. Memfasilitasi tim manajemen kebencanaan desa dalam menyusun manajemen kedaruratan bencana berbasis kesehatan mental</option>
                                    <option value="2.1.3. Menyelenggarakan simulasi PFA dalam manajemen kedaruratan bencana di 4 desa">2.1.3. Menyelenggarakan simulasi PFA dalam manajemen kedaruratan bencana di 4 desa</option>
                                    <option value="2.1.4. Memberikan bimbingan teknis intensif oleh tim sejenkhening.com">2.1.4. Memberikan bimbingan teknis intensif oleh tim sejenkhening.com</option>
                                </select>
                                <div id="ubh_judul_tor"></div>
                            </div>
                            <div class="form-group">
                                <label>Latar Belakang</label>
                                <textarea class="form-control rounded-0" id="ubh_ltr_belakang" name="ubh_ltr_belakang" placeholder="Silahkan Masukan Latar Belakang" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tujuan</label>
                                <textarea class="form-control rounded-0" id="ubh_tujuan" name="ubh_tujuan" placeholder="Silahkan Masukan Tujuan" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Fasilitator / Narasumber</label>
                                <textarea class="form-control rounded-0" id="ubh_fasilitator" name="ubh_fasilitator" placeholder="Silahkan Masukan Narasumber" rows="4"></textarea>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Jumlah Peserta</label>
                                <input type="text" class="form-control rounded-0" id="ubh_jml_peserta" maxlength="3" name="ubh_jml_peserta" placeholder="Silahkan Masukan Jumlah Peserta" onkeypress="return hanyaAngka(event)"></input>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <label>Waktu Pelaksanaan</label>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Tanggal Mulai</label>
                                <input type="date" name="ubh_tanggal" id="ubh_tanggal" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Tanggal Selesai</label>
                                <input type="date" name="ubh_tgl_selesai" id="ubh_tgl_selesai" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>Lokasi Kegiatan</label>
                                <textarea class="form-control rounded-0" id="ubh_lokasi" name="ubh_lokasi" placeholder="Silahkan Masukan Lokasi Kegiatan" rows="5"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-12 col-sm-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control select2" id="tor-kecamatan" onchange="pilih_desa_tor(this.value)" name="ubh_kecamatan" style="width: 100%;">
                                    <option value="">--Pilih--</option>
                                    <option value="Palu">Palu</option>
                                    <option value="Sigi Biromaru dan Dolo">Sigi Biromaru dan Dolo</option>
                                    <option value="Sigi Biromaru">Sigi Biromaru</option>
                                    <option value="Dolo">Dolo</option>
                                </select>
                                <div id="ubh_kecamatan"></div>
                            </div>
                            <div class="form-group">
                                <label>Desa</label>
                                <select class="form-control select2" name="ubh_desa" id="desa-daftar" style="width: 100%;">
                                    <!-- <option value="">--Pilih--</option> -->
                                </select>
                                <div id="ubh_desa"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Alokasi Anggaran</label>
                                <input type="text" name="ubh_anggaran" id="ubh_anggaran" class="form-control" placeholder="Misal, Rp.000.000,00" onkeyup="keyupRupiah('ubh_anggaran',this.value)" style="text-align: right">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Perlengkapan</label>
                                <textarea class="form-control rounded-0" id="ubh_perlengkapan" name="ubh_perlengkapan" value="" placeholder="Silahkan Masukan Perlengkapan" rows="4"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Penutup</label>
                                <textarea class="form-control rounded-0" id="ubh_penutup" name="ubh_penutup" placeholder="Silahkan Masukan Penutup" rows="6"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Upload RAB</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="tor_rab" name="ubh_file_rab" accept="application/pdf" title="Pilih file RAB">
                                    <input type="hidden" name="file_rab_old" readonly>
                                    <label class="custom-file-label file_rab" for="image">Pilih file RAB</label>
                                    <label style="font-size: 9px; font-style: italic;">* Format PDF || Ukuran Upload File Maksimal 100 MB <br>
                                        * Isi hanya jika file RAB-nya ingin di ubah
                                    </label>
                                    <div id="ubh_file_rab"></div>

                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer ">
                    <input type="hidden" name="ubh_kode_tor" readonly="readonly">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-sign-in-alt"> </i> Kembali</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"> </i> Ubah Data</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal