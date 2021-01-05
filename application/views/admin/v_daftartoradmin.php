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
                            <th width="10%">Nara Sumber</th>
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
                                <td>
                                    <button class="btn btn-danger btn-sm mb-2" onclick="view_lihatTor_admin('<?= base_url() ?>', '<?= $value['kode_tor'] ?>')"><i class="fa fa-eye"></i> Lihat</button>
                                    <br />
                                    <?php if ($value['role_rab'] == "Di Setujui") { ?>
                                        <a href="<?= base_url('admin/cetak_tor/') . encrypt_url($value['kode_tor']); ?>" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-print"></i> Cetak</a>
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

                        <div class="form-group">
                            <label>Jumlah Peserta</label>
                            <input type="text" class="form-control rounded-0" id="lht_jml_peserta" maxlength="3" name="lht_jml_peserta" value="" placeholder="Silahkan Masukan Jumlah Peserta" onkeypress="return hanyaAngka(event)"></input>
                        </div>
                        <!-- /.form-group -->
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
                            <label>Lokasi Kegiatan</label>
                            <textarea class="form-control rounded-0" id="" name="lht_lokasi" rows="4" readonly></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-sm-12 col-md-6">
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

                    <div class="col-md-12" id="html_lht_filerab"></div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control rounded-0" id="lht_catatan_revisi" name="lht_catatan_revisi" rows="6"></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
            </div>

            <div class="modal-footer ">
                <button onclick="prosesTor('<?= base_url() ?>', 'Revisi')" name="prosesTor" class="btn btn-danger"><i class="fa fa fa-eraser"> </i> Revisi</button>
                <button onclick="prosesTor('<?= base_url() ?>', 'Di Setujui')" name="prosesTor" class="btn btn-primary"><i class="fa fa-check"> </i> Setuju</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-sign-in-alt"> </i> Kembali</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->