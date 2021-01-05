<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rujukan Psikolog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Rujukan Psikolog</li>

                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Rujukan Psikolog</h3>
            </div>
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
                            <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3) { ?>
                                <th width="26%">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_rujukan_psikolog as $value) { ?>
                            <tr>
                                <td><?= $no; ?>.</td>
                                <td><?= $value['no_rekam_medis'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['tgl_lahir'] ?></td>
                                <td>
                                    <?= $value['tindakan'] . "<br><br>" . "<b>Catatan : </b><br>" . $value['catatan']; ?>
                                </td>
                                <td><?= $value['diagnosa'] ?></td>

                                <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3) { ?>
                                    <td>
                                        <a href="<?= base_url('user/assesment/' . encrypt_url('rp') . '/') . encrypt_url($value['id_pasien']) . '/' . encrypt_url($value['id_assesment']) ?>" class="btn btn-success btn-sm"><i class="nav-icon fa fa-file-signature"></i>Form Assesment</a>
                                        <!--  <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-edit"></i> Ubah</button> -->
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </section>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>