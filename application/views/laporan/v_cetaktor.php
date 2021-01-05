<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Laporan TOR - <?= $data_laporan['kode_tor']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_laporan.css') ?>">

    <script src="<?= base_url('assets/jsuser/js_jquery.js'); ?>"></script>

</head>

<body style="background-image: url('<?= base_url('assets/image/img_laporan/center.png') ?>'); background-repeat: no-repeat; background-size: cover">
    <header>
        <img src="<?= base_url('assets/image/img_laporan/header.png') ?>" width="100%" height="100%" />
    </header>
    <footer>
        <img src="<?= base_url('assets/image/img_laporan/footer.png') ?>" width="100%" height="100%" />
    </footer>
    <main>
        <center><span>Term Of Reference<p><?= substr($data_laporan['judul_tor'], 7); ?></p><br></span></center><br>

        <span>Latar Belakang : </span>
        <p class="indent"><?= $data_laporan['ltr_belakang']; ?>.</p><br>

        <span>Tujuan : </span>
        <p class="indent"><?= $data_laporan['tujuan']; ?>. </p><br>

        <span>Narasumber : </span>
        <p><?= $data_laporan['fasilitator']; ?></p><br>

        <span>Waktu Pelaksanaan : </span><br>
        <span>Tanggal Mulai </span>
        <p><?= $data_laporan['tgl']; ?></p><br>
        <span> Tanggal Selesai </span>
        <p><?= $data_laporan['tgl_selesai']; ?></p><br>

        <span>Lokasi :</span>
        <p>
            <?= $data_laporan['lokasi']; ?>, <br>
            <?= $data_laporan['desa']; ?>, Kecamatan <?= $data_laporan['kecamatan']; ?>, Kabupaten Sigi, Palu.</p><br>

        <span>Alokasi Anggaran:</span>
        <p><?= $data_laporan['anggaran']; ?></p><br>

        <span>Penutup :</span>
        <p class="indent"><?= $data_laporan['penutup']; ?>.</p><br>

        <div class="row text-center">
            <div class="col-md-6 col-sm-6"><br>
                <div class="field-header">Menyetujui,</div>
                <div class="field-ttd">Director</div>
                <div class="field-nama">Eriek Aristya Pradana Putra, MT</div>
            </div>
            <div class="col-md-6 col-sm-6"><BR>
                <div class="field-header">Mengetahui,</div>
                <div class="field-ttd">Project Officer</div>
                <div class="field-nama">Novi Inriyanny Suwendro, SKM., MPH</div>
            </div>
        </div>
    </main>
</body>

</html>