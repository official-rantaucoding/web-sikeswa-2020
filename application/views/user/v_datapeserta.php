<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Peserta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Peserta</li>
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
                <h3 class="card-title">Data Peserta</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor HP /Telpon</th>
                            <th>Alamat</th>
                            <th>Aktivitas</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data_peserta">
                        <?php $no = 1;
                        foreach ($data_peserta as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['no_pendaftaran'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['nomor_hp'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['aktivitas'] ?></td>
                                <td>
                                    <button onclick="view_ubahPeserta('<?= base_url() ?>', '<?= $value['id_pendaftaran'] ?>')" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>Ubah</button>
                                    <button onclick="hapus_pendaftaran('<?= base_url() ?>', '<?= $value['id_pendaftaran'] ?>', '<?= $value['nm_lengkap'] ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
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
</div>
<!-- /.content-wrapper -->
<!-- modal lihat tor -->
<div class="modal fade" id="modal-ubah-peserta">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Ubah Peserta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/ubah_peserta') ?>" method="post" id="form_ubah_peserta">
                <div class="modal-body">
                    <div class="row">
                        <!-- posisi kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_pendaftaran">Nomor Pendaftaran</label>
                                <input type="text" id="no_pendaftaran" name="no_pendaftaran" class="form-control" placeholder="Masukan Nomor Pendafataran">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="alamat" class="control-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control" placeholder=" Masukan ALamat" value="">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama lengkap</label>
                                <input type="text" id="nm_lengkap" name="nm_lengkap" class="form-control" placeholder="Masukan Nama Lengkap" value="" onkeypress="return hanyaHuruf(event)">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select class="form-control select2" id="kab" name="kabupaten" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Sigi">Sigi</option>
                                </select>
                                <div id="kabupaten"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Telpon / HP</label>
                                <input type="text" maxlength="12" id="nomor_hp" name="nomor_hp" class="form-control notelp" placeholder="Masukan Nomor Telpon / HP, misal: 0822xxxxx (*isi jika dilakukan)" onkeyup="formatTelepon('nomor_hp', this.value)" onkeypress="return hanyaAngka(event)">
                            </div>

                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control select2" id="kec" onchange="pilih_desa(this.value)" name="kecamatan" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Dolo">Dolo</option>
                                    <option value="Sigi Biromaru">Sigi Biromaru</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <div id="kecamatan"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control select2" id="jns_kelamin" name="jenis_kelamin" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Transeksual">Transeksual</option>
                                    <option value="Tidak diketahui">Tidak diketahui</option>
                                    <option value="Tidak menentukan">Tidak menentukan</option>
                                </select>
                                <div id="jenis_kelamin"></div>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-12 col-sm-6" id="desaLainnya">
                            <div class="form-group">
                                <label>Desa</label>
                                <select class="form-control select2" id="desa-daftar" name="desa" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih Terlebih Dahulu Kecamatan--</option>
                                </select>
                                <div id="desa"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select class="form-control select2" id="pendidik" name="pendidikan" style="width: 100%;">
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
                                <label>Agama</label>
                                <select class="form-control select2" id="agm" name="agama" style="width: 100%;">
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
                                <label>Status</label>
                                <select class="form-control select2" id="stts" name="status" style="width: 100%;">
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Usia / Umur</label>
                                <input type="text" maxlength="2" id="usia" name="usia" class="form-control" placeholder="Masukan usia, misal: 34" onkeypress="return hanyaAngka(event)">
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Aktivitas</label>
                                <select class="form-control select2" id="aktiv" name="aktivitas" style="width: 100%;">
                                    <option selected="selected" value="">--Pilih--</option>
                                    <option value="1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 1)">1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 1)</option>
                                    <option value="1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 2)">1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 2)</option>
                                    <option value="1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 3)">1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 3)</option>
                                    <option value="1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 4)">1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 4)</option>
                                    <option value="1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 5)">1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 5)</option>
                                    <option value="1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 6)">1.3.6. Melakukan sesi penyuluhan kepada masyarakat tentang kebencanaan dan dampak psikologisnya (Kelompok 6)</option>
                                    <option value="1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 1)">1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 1)</option>
                                    <option value="1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 2)">1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 2)</option>
                                    <option value="1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 3)">1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 3)</option>
                                    <option value="1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 4)">1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 4)</option>
                                    <option value="1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 5)">1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 5)</option>
                                    <option value="1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 6)">1.3.7. Melakukan sesi penyuluhan kepada masyarakat tentang Psychological First Aid (Kelompok 6)</option>
                                    <option value="1.3.8. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang pemulihan pasca bencana (Kelompok 1)">1.3.8. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang pemulihan pasca bencana (Kelompok 1)</option>
                                    <option value="1.3.8. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang pemulihan pasca bencana (Kelompok 2)">1.3.8. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang pemulihan pasca bencana (Kelompok 2)</option>
                                    <option value="1.3.9. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang membangun ketangguhan diri (Kelompok 1)">1.3.9. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang membangun ketangguhan diri (Kelompok 1)</option>
                                    <option value="1.3.9. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang membangun ketangguhan diri (Kelompok 2)">1.3.9. Melakukan sesi penyuluhan kepada remaja, siswa, dan organisasi pemuda tentang membangun ketangguhan diri (Kelompok 2)</option>
                                </select>
                                <div id="aktivitas"></div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer ">
                    <input type="hidden" id="id_pendaftaran" name="id_pendaftaran" class="form-control" readonly>
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