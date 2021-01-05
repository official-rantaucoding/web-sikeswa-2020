<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konseling kelompok</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Konseling Kelompok</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pasien Konseling Kelompok</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Tindakan</th>
                            <th>Diagnosa</th>
                            <th width="26%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_layanan_kelompok as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['no_rekam_medis'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['tgl_lahir'] ?></td>
                                <td><?= $value['tindakan'] ?></td>
                                <td><?= $value['diagnosa'] ?></td>
                                <td>
                                    <a href="<?= base_url('user/rekammedis/') . encrypt_url('lyk') . '/' . encrypt_url($value['id_assesment']) ?>" class="btn btn-success btn-sm"><i class="nav-icon fa fa-file-signature"></i> Tambah Rekam Medis</a>
                                    <button class="btn btn-danger btn-sm" onclick="view_lihatLayanan_konseling('<?= base_url() ?>', '<?= $value['id_pasien'] ?>', 'Konseling Kelompok')"><i class="fa fa-eye"></i> Lihat</button>
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
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->

<!-- modal lihat tor -->
<div class="modal fade" id="modal-lihat-layanaindkel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat Data Konseling Individu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Informasi Assesment</label>
                            <textarea class="form-control rounded-0" id="info_konseling" name="info_konseling" rows="3" placeholder="--Belum ada kegiatan--" readonly></textarea>

                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- posisi kanan -->
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>No ID</label>
                            <input type="text" id="id" name="id" class="form-control" placeholder="Belum Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" placeholder=" Belum Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Rekam Medis</label>
                            <input type="text" id="no_rkm_medis" name="no_rkm_medis" class="form-control" placeholder=" Belum Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Usia</label>
                            <input type="text" id="usia" name="usia" class="form-control" placeholder=" Belum Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Belum Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Belum Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keluhan</label>
                            <textarea class="form-control rounded-0" id="keluhan" name="keluhan" value="" rows="3" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Status Medis</label><br>
                            <label style="font-size: 14px;">Riwayat Penyakit</label><br>
                            <input type="text" id="riwayat_penyakit" name="riwayat_penyakit" class="form-control" placeholder="Masukan Riwayat Penyakit" readonly>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label style="font-size: 14px;">Pengobatan</label>
                            <input type="text" id="pengobatan" name="pengobatan" class="form-control" placeholder="Masukan pegobatan" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Wawancara Psikologis</label><br>
                            <textarea class="form-control rounded-0" id="wawancara_psikologis" name="wawancara_psikologis" value="" rows="5" readonly></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Psikotest (Jika dilakukan)</label>
                            <input type="text" name="psikotest" id="psikotes" class="form-control" placeholder="Masukan pegobatan" readonly>
                            <div id="psikotest"></div>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="col-12 col-sm-12" id="set_hasil_psikotest"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <input type="text" name="diagnosa" id="diagnosa" class="form-control" placeholder="Tidak Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Diagnosa Penyerta</label>
                            <input type="text" id="diagnosa_penyerta" name="diagnosa_penyerta" class="form-control" placeholder="Tidak Ada Data" readonly>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Diagnosa Khusus</label>
                            <input type="text" id="diagnosa_khusus2" name="diagnosa_khusus" class="form-control" placeholder="Tidak Ada Data" readonly>
                        </div>
                    </div>

                    <!-- /.form-group -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tindakan</label>
                            <input type="text" name="tindakan" id="tindakan_catatan_assesment" class="form-control" placeholder="Tidak Ada Data" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-12" id="catatan-tindakan-html"></div>
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