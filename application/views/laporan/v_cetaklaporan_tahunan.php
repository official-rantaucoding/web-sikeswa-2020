<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Laporan Tahunan - Tahun <?= $data_tahun; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_laporan.css') ?>">
    <script src="<?= base_url('assets/jsuser/js_jquery.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
    <script></script>
    
</head>
<body style="background-image: url('<?= base_url('assets/image/img_laporan/center.png') ?>'); background-repeat: no-repeat; background-size: cover">
    <header>
        <img src="<?= base_url('assets/image/img_laporan/header.png') ?>" width="100%" height="100%"/>
    </header>
    <footer>
        <img src="<?= base_url('assets/image/img_laporan/footer.png') ?>" width="100%" height="100%"/>
    </footer>
    <main>
        <span>Tahun : </span>
        <p><?= $data_tahun; ?></p><br>

        <span>Data Laporan tahunan : </span>
        <table class="tabel">
            <tr>
                <th>No</th>
                <th>Nama Klien</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Diagnosa</th>
                <th>Tindakan</th>
            </tr>
            <tbody>
                <?php $no =1; foreach ($data_pasien as $value) { ?>
                <tr>
                    <td><?= $no; ?>.</td>
                    <td><?= $value['nm_lengkap']; ?></td>
                    <td><?= $value['usia']; ?></td>
                    <td><?= $value['jk']; ?></td>
                    <td><?= $value['diagnosa']; ?></td>
                    <td><?= $value['tindakan']; ?></td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>

        <<div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="field-header">Jenis Kelamin</div>
                <div class="position-relative mb-4">
                    <div id="chartjk_laporankasus_thn" class="chart-laporan"></div>
                </div>
                
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="field-header">Tindakan</div>
                <div class="position-relative mb-4">
                    <div id="charttindakan_laporankasus_thn" class="chart-laporan"></div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>