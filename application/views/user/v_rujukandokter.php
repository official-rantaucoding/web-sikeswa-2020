<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rujukan Dokter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Rujukan Dokter</li>


                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Rujukan Dokter</h3>
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
                            <th width="20%">Tindakan</th>
                            <th width="10%">Diagnosa</th>
                            <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 4) { ?>
                                <th width="26%">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_rujukan_dokter as $value) { ?>
                            <tr>
                                <td><?= $no; ?>.</td>
                                <td><?= $value['no_rekam_medis'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['tgl_lahir'] ?></td>
                                <td>
                                    <?=
                                        $value['tindakan'] . "<br><br>" . "<b>Catatan : </b><br>" . $value['catatan'];
                                    ?>

                                </td>
                                <td><?= $value['diagnosa'] ?></td>
                                <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 4) { ?>
                                    <td>
                                        <a href="<?= base_url('user/assesment/' . encrypt_url('rd') . '/') . encrypt_url($value['id_pasien']) . '/' . encrypt_url($value['id_assesment']) ?>" class="btn btn-success btn-sm"><i class="nav-icon fa fa-file-signature"></i>Form Assesment</a>
                                        <!-- <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-edit"></i> Ubah</button> -->
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php $no++;
                        }

                        foreach ($data_rujukan_dokter_konseling as $value) { ?>
                            <tr>
                                <td><?= $no; ?>.</td>
                                <td><?= $value['no_rekam_medis'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['tgl_lahir'] ?></td>
                                <td>
                                    <?=
                                        $value['tindakan'] . " <b>>></b> " . $value['hasil_akhir'] . "<br><br>" . "<b>Catatan : </b><br>" . $value['catatankonseling'];
                                    ?>
                                </td>
                                <td><?= $value['diagnosa'] ?></td>
                                <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 4) { ?>
                                    <td>
                                        <a href="<?= base_url('user/assesment/' . encrypt_url('rd') . '/') . encrypt_url($value['id_pasien']) . '/' . encrypt_url($value['id_assesment']) ?>" class="btn btn-success btn-sm"><i class="nav-icon fa fa-file-signature"></i>Form Assesment</a>
                                        <!-- <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-edit"></i> Ubah</button> -->
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php $no++;
                        }

                        ?>
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