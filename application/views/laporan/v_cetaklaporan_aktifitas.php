<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Laporan Aktifitas - <?= $data_aktifivitas['kd_aktiv']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_laporan.css') ?>">

    <script src="<?= base_url('assets/jsuser/js_jquery.js'); ?>"></script>

</head>
<body style="background-image: url('<?= base_url('assets/image/img_laporan/center.png') ?>'); background-repeat: no-repeat; background-size: cover">
    <header>
        <img src="<?= base_url('assets/image/img_laporan/header.png') ?>" width="100%" height="100%"/>
    </header>
    <footer>
        <img src="<?= base_url('assets/image/img_laporan/footer.png') ?>" width="100%" height="100%"/>
    </footer>
    <main>
        <center><span>AKTIVITAS - <?= substr($data_aktifivitas['kd_aktiv'], -3); ?><p></span></center><br>
            
        <span>Nama Aktifitas : </span>
        <p class="indent"><?= $data_aktifivitas['nm_aktivitas']; ?></p><br>

        <span>Kode Aktifitas : </span>
        <p><?= $data_aktifivitas['kode_aktivitas']; ?></p><br>

        <span>Data Peserta : </span>
        <table class="tabel">
            <tr>
                <th>No</th>
                <th>No. Pendaftaran</th>
                <th>Nama lengkap</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Usia</th>
            </tr>
            <tbody>
                <?php $no =1; foreach ($peserta as $value) { ?>
                <tr>
                    <td><?= $no; ?>.</td>
                    <td><?= $value['no_pendaftaran']; ?></td>
                    <td><?= $value['nm_lengkap']; ?></td>
                    <td><?= $value['agama']; ?></td>
                    <td><?= $value['alamat'].", Desa ".$value['desa'].", Kecamatan ".$value['kecamatan']; ?></td>
                    <td><?= $value['pendidikan']; ?></td>
                    <td><?= $value['pekerjaan']; ?></td>
                    <td><?= $value['usia']; ?></td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>

        <br><br>
        <span>Jumlah Peserta : </span>
        <p><?= $data_aktifivitas['jml_peserta']; ?></p><br>

        <span>Dana : </span> 
        <p><?= $data_aktifivitas['dana']; ?></p><br>

        <span>Waktu Pelaksanaan :</span>
        <p>
            Tanggal : <?= $data_aktifivitas['tgl']; ?>, <br /> 
            Pukul   : <?= $data_aktifivitas['pukul']; ?><br />
        </p>

        <span>Narasumber:</span>
        <p><?= $data_aktifivitas['nara_sumber']; ?></p><br>
        
        <span>Lokasi :</span> 
        <p><?= $data_aktifivitas['lokasi']; ?>.</p><br>

        <span>Notulensi :</span> 
        <p class="indent"><?= $data_aktifivitas['notulensi']; ?>.</p><br>

        <span>Dokumentasi :</span><br><br><br>
        <?php foreach ($dokumentasi as $key) { ?>
        <div class="row">
            <div class="col-md-12">
                <img src="<?= base_url('assets/image/img_dok_aktivitas/').$key['gambar']; ?>" style="width: 200px; height: 200px;">
            </div>
        </div>
        <br><br>
        <?php } ?>
    </main>
</body>
</html>