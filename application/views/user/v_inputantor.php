<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inputan TOR</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Inputan TOR</li>
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
                <h3 class="card-title">Form Inputan TOR</h3>

                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="<?= base_url('user/do_inputanTor') ?>" method="post" enctype="multipart/form-data" id="form-input-tor">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode TOR</label>
                                <input type="text" name="kd_tor" id="kode_tor" class="form-control" value="<?= $kode_tor; ?>" readonly>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div><br>
                    <div class="row">

                        <!-- posisi kanan -->
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Judul TOR</label>
                                <select class="form-control select2" name="jdl_tor" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
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
                                <div id="jdl_tor"></div>
                            </div>
                            <div class="form-group">
                                <label>Latar Belakang</label>
                                <textarea class="form-control rounded-0" id="latar_belakang" name="latar_belakang" value="" placeholder="Silahkan Masukan Latar Belakang" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tujuan</label>
                                <textarea class="form-control rounded-0" id="tujuan" name="tujuan" value="" placeholder="Silahkan Masukan Tujuan" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Fasilitator / Narasumber</label>
                                <textarea class="form-control rounded-0" id="narasumber" name="narasumber" value="" placeholder="Silahkan Masukan Fasilitator / Narasumber" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Jumlah Peserta</label>
                                <input type="text" class="form-control rounded-0" id="jml_peserta" maxlength="3" name="jml_peserta" value="" placeholder="Silahkan Masukan Jumlah Peserta" onkeypress="return hanyaAngka(event)"></input>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <label>Waktu Pelaksanaan</label>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Tanggal Mulai</label>
                                <input type="date" name="kalender" id="kalender" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lokasi Kegiatan</label>
                                <textarea class="form-control rounded-0" name="lokasi_kegiatan" id="lokasi_kegiatan" value="" placeholder="Silahkan Masukan Lokasi Kegiatan" rows="5"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control select2" id="kecamatan" onchange="pilih_desa_tor(this.value)" name="nm_kecamatan" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Palu">Palu</option>
                                    <option value="Sigi Biromaru dan Dolo">Sigi Biromaru dan Dolo</option>
                                    <option value="Sigi Biromaru">Sigi Biromaru</option>
                                    <option value="Dolo">Dolo</option>
                                </select>
                                <div id="nm_kecamatan"></div>
                            </div>
                            <div class="form-group">
                                <label>Desa</label>
                                <select class="form-control select2" name="nm_desa" id="desa-daftar" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih Terlebih Dahulu Kecamatan--</option>
                                </select>
                                <div id="nm_desa"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Alokasi Anggaran</label>
                                <input type="text" name="anggaran" id="anggaran" class="form-control" placeholder="Misal, Rp.100.000,00" onkeyup="keyupRupiah('anggaran',this.value)" style="text-align: right">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Perlengkapan</label>
                                <textarea class="form-control rounded-0" id="perlengkapan" name="perlengkapan" value="" placeholder="Silahkan Masukan Perlengkapan" rows="4"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Penutup</label>
                                <textarea class="form-control rounded-0" id="penutup" name="penutup" placeholder="Silahkan Masukan Penutup" value="" rows="6"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Upload RAB</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="tor_rab" name="file_rab" accept="application/pdf" title="Pilih file RAB">
                                    <label class="custom-file-label file_rab" for="image">Pilih file RAB</label>
                                    <label style="font-size: 9px; font-style: italic;">* Format PDF || Ukuran Upload File Maksimal 100 MB </label>
                                </div>
                                <div id="file_rab"></div>
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