<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Seluruh Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Seluruh Pasien</li>
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
                <h3 class="card-title">Data Seluruh Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th width="8%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="data_peserta">
                        <?php $no = 1;
                        foreach ($data_pasien as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['no_rekam_medis'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['tempat_lahir'] ?></td>
                                <td><?= $value['tgl_lahir'] ?></td>
                                <td><?= $value['jk'] ?></td>
                                <td><?= $value['agama'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td>
                                    <a href="<?= base_url('user/assesment/'.encrypt_url('sel').'/') .encrypt_url($value['id_pasien']) ?>" class="btn btn-success btn-sm"><i class="nav-icon fa fa-file-signature"></i> Tambah asesment</a>
                                    <br/><br/>
                                    <button onclick="hapus_pasien('<?= base_url() ?>', '<?= $value['id_pasien'] ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
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