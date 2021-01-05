<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Tahunan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Tahunan</li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Laporan Tahunan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Tahun</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_laporan_tahun as $value) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $value['tahun']; ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="getlaporankasus_tahun('<?= base_url() ?>', '<?= $value['tahun']; ?>')"><i class="fa fa-eye"></i> Lihat</button>
                                    <a href="<?= base_url('admin/cetak_tahun/').encrypt_url($value['tahun']) ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Cetak</a>
                                </td>
                            </tr>
                        <?php $no++;
                        }  ?>
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->
<!-- modal lihat laporan Tahunan -->
<div class="modal fade" id="modal-laporankasus-tahun">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat Laporan Tahun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <!-- posisi kanan -->
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" id="nama_tahun" name="nama_tahun" class="form-control" readonly>
                        </div>

                        <!-- Tabel nama pasien per bulanan -->
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Laporan Tahunan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="laporantahunviewmodal" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Klien</th>
                                            <th>Usia</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Diagnosa</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datapasien_laporantahun"></tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>

                    <div class="col-md-6 text-center">
                        <label>Jenis Kelamin</label><br>
                        <div class="position-relative mb-4">
                            <canvas id="chartjk_laporankasus_thn" style="height:207px; min-height:207px"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <label>Tindakan</label><br>
                        <div class="position-relative mb-4">
                            <canvas id="charttindakan_laporankasusthn" style="height:207px; min-height:207px"></canvas>
                        </div>
                    </div>
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