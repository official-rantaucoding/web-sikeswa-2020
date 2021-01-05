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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
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
                            <th>Narasumber</th>
                            <th>Aktivitas</th>
                            <th>Jumlah Peserta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_laporan_aktifitas as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['kd_aktiv'] ?></td>
                                <td><?= $value['nara_sumber'] ?></td>
                                <td><?= $value['nm_aktivitas'] ?></td>
                                <td><?= $value['jml_peserta'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/cetak_aktifitas/') . encrypt_url($value['kd_aktiv']) ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-print"></i>Cetak PDF</a>
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