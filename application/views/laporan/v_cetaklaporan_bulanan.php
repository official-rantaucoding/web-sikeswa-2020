<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Laporan Bulanan - Bulan <?= $data_bulan; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css_user/css_laporan.css') ?>">
</head>

<body style="background-image: url('<?= base_url('assets/image/img_laporan/center.png') ?>'); background-repeat: no-repeat; background-size: cover" id="bodyHtml">
    <header>
        <img src="<?= base_url('assets/image/img_laporan/header.png') ?>" width="100%" height="100%" />
    </header>
    <footer>
        <img src="<?= base_url('assets/image/img_laporan/footer.png') ?>" width="100%" height="100%" />
    </footer>
    <main>
        <center><span>Laporan <br> Rekapitulasi Pasien</span></center>
        <span>Bulan : </span>
        <p><?= $data_bulan; ?></p><br>

        <span>Data Laporan bulanan : </span>
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
                <?php $no = 1;
                foreach ($data_pasien as $value) { ?>
                    <tr>
                        <td><?= $no; ?>.</td>
                        <td><?= $value['nm_lengkap']; ?></td>
                        <td><?= $value['usia']; ?></td>
                        <td><?= $value['jk']; ?></td>
                        <td><?= $value['diagnosa']; ?></td>
                        <td><?= $value['tindakan']; ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>

        <br><br>
        <div class="row text-center">
            <div class="col-md-12 col-sm-12">
                <label>Jenis Kelamin</label><br>
                <canvas id="chartjkbln" style="height:20px; min-height:20px"></canvas>
                <div id="imgWrapjk"></div>
            </div>
        </div>

        <br>
        <div class="row text-center">
            <div class="col-md-12 col-sm-12">
                <label>Tindakan</label><br>
                <canvas id="charttindakanbln" style="height:20px; min-height:20px"></canvas>
                <div id="imgWraptindakan"></div>
            </div>
        </div>

    </main>

    <script src="<?= base_url('assets/jsuser/js_jquery.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
    <script>
        var jkChart = null;
        var tindakanChart = null;

        jkChart = new Chart(document.getElementById('chartjkbln').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ["Laki-Laki (" + <?= $chartjk[0]; ?> + ")", "Perempuan (" + <?= $chartjk[1]; ?> + ")", "Transeksual (" + <?= $chartjk[2]; ?> + ")", "Tidak diketahui (" + <?= $chartjk[3]; ?> + ")", "Tidak menentukan (" + <?= $chartjk[4]; ?> + ")"],
                datasets: [{
                    data: [<?= $chartjk[0]; ?>, <?= $chartjk[1]; ?>, <?= $chartjk[2]; ?>, <?= $chartjk[3]; ?>, <?= $chartjk[4]; ?>],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                }]
            },
            option: {
                title: {
                    display: true,
                    text: 'Jenis Kelamin'
                },
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position: 'bottom',
                },
                animation: false
            },
            plugins: [{
                afterRender: function() {
                    renderIntoImagejk()
                },
            }],
        });

        tindakanChart = new Chart(document.getElementById('charttindakanbln').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ["Konseling Individu (" + <?= $charttindakan[0]; ?> + ")", "Konseling Kelompok (" + <?= $charttindakan[1]; ?> + ")", "Rujukan Psikolog (" + <?= $charttindakan[2]; ?> + ")", "Rujuk Ke Dokter (" + <?= $charttindakan[3]; ?> + ")"],
                datasets: [{
                    data: [<?= $charttindakan[0]; ?>, <?= $charttindakan[1]; ?>, <?= $charttindakan[2]; ?>, <?= $charttindakan[3]; ?>],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                }]
            },
            option: {
                title: {
                    display: true,
                    text: 'Tindakan User'
                },
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position: 'bottom',
                },
                animation: false
            },
            plugins: [{
                afterRender: function() {
                    renderIntoImagetindakan()
                },
            }],

        });

        const renderIntoImagejk = () => {
            const canvasjk = document.getElementById('chartjkbln')
            const imgWrapjk = document.getElementById('imgWrapjk')
            var imgjk = new Image();
            imgjk.src = canvasjk.toDataURL()
            imgWrapjk.appendChild(imgjk)
            canvasjk.style.display = 'none'
        }

        const renderIntoImagetindakan = () => {
            const canvastindakan = document.getElementById('charttindakanbln')
            const imgWraptindakan = document.getElementById('imgWraptindakan')
            var imgtindakan = new Image();
            imgtindakan.src = canvastindakan.toDataURL()
            imgWraptindakan.appendChild(imgtindakan)
            canvastindakan.style.display = 'none'
        }
    </script>
</body>

</html>