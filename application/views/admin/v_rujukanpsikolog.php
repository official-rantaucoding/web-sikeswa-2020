<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rujukan Psikolog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Rujukan Psikolog</li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Rujukan Psikolog</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="position-relative">
                                    <canvas id="chartpsikolog" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.card -->
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Rujukan Psikolog</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example6" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="65%">Bulan</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_laporan_bulan as $value) { ?>
                            <tr>
                                <td width="10%"><?= $no . "."; ?></td>
                                <td width="65%"><?= konversiBulan($value['bulan']) . " " . $value['tahun']; ?></td>
                                <td width="25%">
                                    <a href="<?= base_url('admin/cetak_psikolog/') . encrypt_url($value['bulan']) . '/' . encrypt_url($value['tahun']); ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-print"></i> Cetak</a>
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
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->