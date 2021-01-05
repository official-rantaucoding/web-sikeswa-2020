<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Laporan Rujukan Psikolog</title>
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
        <center><span>DATA LAPORAN RUJUKAN PSIKOLOG <BR><?= $data_laporan['id_pasien']; ?></span></center><br>

        <div class="row">
            <div class="col-md-4 col-sm-4">No Rekam Medis</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['no_rekam_medis']<>'') ? $data_laporan['no_rekam_medis']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">ID Assesment</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['id_assesment']<>'') ? $data_laporan['id_assesment']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">No Urut Assesment</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['no_urut_assesment']<>'') ? $data_laporan['no_urut_assesment']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Nama Lengkap</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['nm_lengkap']<>'') ? $data_laporan['nm_lengkap']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Alamat</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['alamat']<>'') ? $data_laporan['alamat']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Tempat Lahir</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['tempat_lahir']<>'') ? $data_laporan['tempat_lahir']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Tanggal Lahir</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['tgl_lahir']<>'') ? $data_laporan['tgl_lahir']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Jenis Kelamin</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['jk']<>'') ? $data_laporan['jk']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Usia Pasien</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['usia']<>'') ? $data_laporan['usia']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Agama</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['agama']<>'') ? $data_laporan['agama']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Status</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['status']<>'') ? $data_laporan['status']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Desa</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['desa']<>'') ? $data_laporan['desa']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Kecamatan</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['kecamatan']<>'') ? $data_laporan['kecamatan']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Kabupaten</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['kabupaten']<>'') ? $data_laporan['kabupaten']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Nomor HP / Telpon</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['no_hp']<>'') ? $data_laporan['no_hp']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Pendidikan</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['pendidikan']<>'') ? $data_laporan['pendidikan']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Pekerjaan</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['pekerjaan']<>'') ? $data_laporan['pekerjaan']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Keluhan</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['keluhan']<>'') ? $data_laporan['keluhan']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Riwayat Penyakit</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['riwayat_penyakit']<>'') ? $data_laporan['riwayat_penyakit']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Pengobatan</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['pengobatan']<>'') ? $data_laporan['pengobatan']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Wawancara Psikologis</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['wawancara_psikologis']<>'') ? $data_laporan['wawancara_psikologis']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Psikotes</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['psikotest']<>'') ? $data_laporan['psikotest']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Hasil psikotest</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['hasil_psikotes']<>'') ? $data_laporan['hasil_psikotes']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Diagnosa</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['diagnosa']<>'') ? str_replace('–', '-', $data_laporan['diagnosa']): '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Diagnosa Khusus</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['diagnosa_khusus']<>'') ? $data_laporan['diagnosa_khusus']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Diagnosa Penyerta</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['diagnosa_penyerta']<>'') ? $data_laporan['diagnosa_penyerta']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Menindak</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['id_menindak']<>'') ? $data_laporan['id_menindak']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Tindakan</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['tindakan']<>'') ? $data_laporan['tindakan']: '-'; ?></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">Catatan</div>
            <div class="col-md-8 col-sm-8">:&nbsp;&nbsp;&nbsp;<?= ($data_laporan['catatan']<>'') ? $data_laporan['catatan']: '-'; ?></div>
        </div>
    </main>
</body>
</html>