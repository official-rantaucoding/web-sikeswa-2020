<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Aktivitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Aktivitas</li>
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
                <h3 class="card-title">Data Aktivitas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>No Aktivitas</th>
                            <th>Nara Sumber</th>
                            <th>Aktivitas</th>
                            <th>Jumlah Peserta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_laporan_aktivitas as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['kd_aktiv'] ?></td>
                                <td><?= $value['nara_sumber'] ?></td>
                                <td><?= $value['nm_aktivitas'] ?></td>
                                <td><?= $value['jml_peserta'] ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm mb-2" onclick="view_lihat_aktifitas('<?= base_url() ?>', '<?= $value['kd_aktiv'] ?>')"><i class="fa fa-eye"></i> Lihat</button>
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

<!-- modal lihat Laporan Aktifitas -->
<div class="modal fade" id="modal-lihat-aktifitas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat Data Laporan Aktifitas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <!-- posisi kanan -->
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Pilihan Aktifitas</label>
                            <textarea class="form-control rounded-0" id="" name="lht_pilih_aktifitas" rows="4" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kode Aktifitas</label>
                            <input type="text" name="lht_kode_aktifitas" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Peserta</label>
                            <textarea class="form-control rounded-0" id="" name="lht_peserta" rows="4" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Jumlah Peserta</label>
                            <input type="text" name="lht_jumlah_peserta" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Dana</label>
                            <input type="text" name="lht_dana" class="form-control" readonly>
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


                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nara Sumber</label>
                            <input type="text" name="lht_narasumber" class="form-control" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Lokasi Kegiatan</label>
                            <input type="text" name="lht_lokasi" class="form-control" readonly>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Hasil Kegiatan</label>
                            <textarea class="form-control rounded-0" id="" name="lht_hasil_kegiatan" rows="4" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Kesimpulan</label>
                            <textarea class="form-control rounded-0" id="" name="lht_kesimpulan" rows="6" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Dokumentasi</label>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
                <div class="row" id="dokumentasi"></div>
                <br /><br />
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-sign-in-alt"> </i> Kembali</button>
                </div>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->