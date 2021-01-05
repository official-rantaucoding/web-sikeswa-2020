<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pasien Individu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pasien Individu</li>
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
                <h3 class="card-title">Data Pasien Individu</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Lengkap</th>
                            <th width="13%">Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Tindakan</th>
                            <th>Diagnosa</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pasien_individu as $value) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['no_rekam_medis'] ?></td>
                                <td><?= $value['nm_lengkap'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= $value['tgl_lahir'] ?></td>
                                <td><?= $value['tindakan'] ?></td>
                                <td><?= $value['diagnosa'] ?></td>
                                <td>
                                    <button type="button" onclick="view_ubah_asessment('<?= base_url() ?>', '<?= $value['id_pasien'] ?>', '<?= $value['id_assesment'] ?>')" class="btn btn-primary btn-sm mb-2"><i class="fas fa-edit"></i> Ubah</button>
                                    <a href="<?= base_url('admin/cetak_individu/') . encrypt_url($value['id_assesment']); ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-print"></i> Cetak PDF</a>
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
</div>
<!-- /.content-wrapper -->

<!-- modal lihat ubah asessment -->
<div class="modal fade" id="modal-ubah-asessment">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Asessment dan Rekammedis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-ubah-asessment" action="<?= base_url('admin/do_ubah_asessment') ?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <!-- start datapasien -->
                    <div class="col-md-12 col-sm-12" id="data_pasien">
                        <div class="card card-default ">
                            <div class="card-header">
                                <h3 class="card-title"><span style="font-weight: bold; font-style:italic">Data Pasien</span></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- posisi kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No ID</label>
                                            <input type="text" id="id" name="id" class="form-control" placeholder="Belum Ada Data" readonly>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" placeholder=" Belum Ada Data" readonly>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Rekam Medis</label>
                                            <input type="text" id="no_rkm_medis" name="no_rkm_medis" class="form-control" placeholder=" Belum Ada Data" readonly>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Usia</label>
                                            <input type="text" id="usia" name="usia" class="form-control" placeholder=" Belum Ada Data" readonly>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Belum Ada Data" readonly>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Belum Ada Data" readonly>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end datapasien -->

                    <!-- start asessment -->
                    <div class="col-md-12 col-sm-12" id="data_asessment">
                        <div class="card card-default ">
                            <div class="card-header">
                                    <di class="col-md-6">
                                        <h3 class="card-title"><span style="font-weight: bold; font-style:italic">Data Asessment</span></h3>
                                    </di>
                                    <div class="form-group row float-right col-md-6">
                                        <label class="col-md-4">Pilih Assesment :</label>
                                        <div class="col-md-8">
                                            <select class="form-control select2" name="urut_assesment" id="urut_assesment" onchange="geturutassesment('<?= base_url() ?>',this.value)" style="width: 100%;"></select>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class = "col-md-12">
                                        <div class="form-group">
                                            <label>Tanggal Assesment</label>
                                            <input type="date" id="tgl_assesment" name="tgl_assesment" class="form-control">
                                            <input type="hidden" id="id_assesment" name="id_assesment" class="form-control">
                                            <input type="hidden" id="id_menindak" name="id_menindak" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Informasi Assesment</label>
                                            <textarea class="form-control rounded-0" id="info_konseling" name="info_konseling" rows="3" placeholder="--Belum ada kegiatan--" readonly></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keluhan</label>
                                            <textarea class="form-control rounded-0" id="keluhan" name="keluhan" rows="3"></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Status Medis</label><br>
                                            <label style="font-size: 14px;">Riwayat Penyakit</label><br>
                                            <input type="text" id="riwayat_penyakit" name="riwayat_penyakit" class="form-control" placeholder="Masukan Riwayat Penyakit">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label style="font-size: 14px;">Pengobatan</label>
                                            <input type="text" id="pengobatan" name="pengobatan" class="form-control" placeholder="Masukan pegobatan">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Hasil Asesment</label><br>
                                            <textarea class="form-control rounded-0" id="wawancara_psikologis" name="wawancara_psikologis" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Psikotest</label>
                                            <select class="form-control select2" name="psikotest" id="psikotes" onchange="getpsikotestHasil(this.value)" style="width: 100%;">
                                                <option selected="selected" value="">--Pilih--</option>
                                                <option value="Grafis">Grafis</option>
                                                <option value="Kepribadian">Kepribadian</option>
                                                <option value="Intelegensi (WAIS)">Intelegensi (WAIS)</option>
                                                <option value="Intelegensi (WISC)">Intelegensi (WISC)</option>
                                                <option value="tor SPM">tor SPM</option>
                                                <option value="CFIT">CFIT</option>
                                                <option value="Ist">Ist</option>
                                            </select>
                                            <label style="font-size: 10px; font-style: italic;">* Isi Jika Dilakukan</label>
                                            <div id="psikotest"></div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="col-12 col-sm-12" id="set_hasil_psikotest"></div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosa</label>
                                            <select class="form-control select2" name="diagnosa" style="width: 100%;">
                                                <option selected="selected" value="">--Pilih--</option>
                                                <option value="F00 – F09 Gangguan mental organik">F00 – F09 Gangguan mental organik</option>
                                                <option value="F10. – Gangguan mental dan perilaku akibat penggunaan alkohol">F10. – Gangguan mental dan perilaku akibat penggunaan alkohol</option>
                                                <option value="F11. – Ganguan mental dan perilaku akibat penggunaan opioida">F11. – Ganguan mental dan perilaku akibat penggunaan opioida</option>
                                                <option value="F12. – Gangguan mental dan perilaku akibat penggunaan kanabinoida">F12. – Gangguan mental dan perilaku akibat penggunaan kanabinoida</option>
                                                <option value="F13. – Gangguan mental dan perilaku akibat penggunaan Sedativa atau hipnotika">F13. – Gangguan mental dan perilaku akibat penggunaan Sedativa atau hipnotika</option>
                                                <option value="F14. – Gangguan mental dan perilaku akibat penggunaan Kokain">F14. – Gangguan mental dan perilaku akibat penggunaan Kokain</option>
                                                <option value="F15. – Gangguan mental dan perilaku akibat penggunaan stimulansia lain termasuk kafein">F15. – Gangguan mental dan perilaku akibat penggunaan stimulansia lain termasuk kafein</option>
                                                <option value="F16. – Gangguan dan perilaku akibat penggunaan halusinogenika"> F16. – Gangguan dan perilaku akibat penggunaan halusinogenika</option>
                                                <option value="F17. – Gangguan mental dan perilaku akibat penggunaan tembakau">F17. – Gangguan mental dan perilaku akibat penggunaan tembakau</option>
                                                <option value="F18. – Gangguan mental dan perilaku akibat penggunaan pelarut yang mudah menguap">F18. – Gangguan mental dan perilaku akibat penggunaan pelarut yang mudah menguap</option>
                                                <option value="F19. – Gangguan mental dan perilaku akibat penggunaan zat multipel dan penggunaan zat psikoaktif lainnya">F19. – Gangguan mental dan perilaku akibat penggunaan zat multipel dan penggunaan zat psikoaktif lainnya</option>
                                                <option value="F20.1 Skizofrenia hebefrenik">F20.1 Skizofrenia hebefrenik</option>
                                                <option value="F20.2 Skizofrenia katatonik">F20.2 Skizofrenia katatonik</option>
                                                <option value="F20.3 Skizofrenia tak terinci">F20.3 Skizofrenia tak terinci</option>
                                                <option value="F20.4 Depresi pasca-skizofrenia">F20.4 Depresi pasca-skizofrenia</option>
                                                <option value="F21 Gangguan Skizotipal">F21 Gangguan Skizotipal</option>
                                                <option value="F22 Gangguan Waham Menetap">F22 Gangguan Waham Menetap</option>
                                                <option value="F23 Gangguan Psikotik Akut Dan Sementara">F23 Gangguan Psikotik Akut Dan Sementara</option>
                                                <option value="F24 Gangguan Waham Induksi">F24 Gangguan Waham Induksi</option>
                                                <option value="F25.0 Gangguan skizoafektif tipe manik">F25.0 Gangguan skizoafektif tipe manik</option>
                                                <option value="F25.1 Gangguan skizoafektif tipe depresi">F25.1 Gangguan skizoafektif tipe depresi</option>
                                                <option value="F25.2 Gangguan skizoafektif tipe campuran">F25.2 Gangguan skizoafektif tipe campuran</option>
                                                <option value="F30 Episode manik">F30 Episode manik</option>
                                                <option value="F31 Gangguan afektif bipolar">F31 Gangguan afektif bipolar</option>
                                                <option value="F32.0 Episode depresif ringan">F32.0 Episode depresif ringan</option>
                                                <option value="F32.1 Episode depresif sedang">F32.1 Episode depresif sedang</option>
                                                <option value="F32.2 Episode depresif berat tanpa gejala psikotik">F32.2 Episode depresif berat tanpa gejala psikotik</option>
                                                <option value="F32.3 Episode depresif berat dengan gejala psikotik">F32.3 Episode depresif berat dengan gejala psikotik</option>
                                                <option value="F33 Gangguan depresif berulang">F33 Gangguan depresif berulang</option>
                                                <option value="F40.0 Agorafobia">F40.0 Agorafobia</option>
                                                <option value="F40.1 Fobia sosial">F40.1 Fobia sosial</option>
                                                <option value="F41.0 Gangguan panik (anxietas paroksismal episodik)">F41.0 Gangguan panik (anxietas paroksismal episodik)</option>
                                                <option value="F41.1 Gangguan anxietas menyeluruh">F41.1 Gangguan anxietas menyeluruh</option>
                                                <option value="F41.2 Gangguan campuran anxietas dan depresif">F41.2 Gangguan campuran anxietas dan depresif</option>
                                                <option value="F42 Gangguan obsesif-kompulsif">F42 Gangguan obsesif-kompulsif</option>
                                                <option value="F43.0 Reaksi stres akut">F43.0 Reaksi stres akut</option>
                                                <option value="F43.1 Gangguan stres pasca-trauma">F43.1 Gangguan stres pasca-trauma</option>
                                                <option value="F43.8 Reaksi stres berat lainnya">F43.8 Reaksi stres berat lainnya</option>
                                                <option value="F44 Gangguan dlsosiatif [konversi]">F44 Gangguan dlsosiatif [konversi]</option>
                                                <option value="F45.0 Gangguan somatisasi">F45.0 Gangguan somatisasi</option>
                                                <option value="F45.1 Gangguan somatoform tak terinci">F45.1 Gangguan somatoform tak terinci</option>
                                                <option value="F45.2 Gangguan hipokondrik">F45.2 Gangguan hipokondrik</option>
                                                <option value="F50 Gangguan makan">F50 Gangguan makan</option>
                                                <option value="F51 Gangguan tidur non-organik">F51 Gangguan tidur non-organik</option>
                                                <option value="F54 Gaktor psikologis dan perilaku yang berhubungan dengan gangguan atau penyakit (psikosomatis)">F54 Gaktor psikologis dan perilaku yang berhubungan dengan gangguan atau penyakit (psikosomatis)</option>
                                                <option value="F60.0 Gangguan kepribadian paranoid">F60.0 Gangguan kepribadian paranoid</option>
                                                <option value="F60.1 Gangguan kepribadian skizoid">F60.1 Gangguan kepribadian skizoid</option>
                                                <option value="F60.2 Gangguan kepribadian dissosial">F60.2 Gangguan kepribadian dissosial</option>
                                                <option value="F60.3 Gangguan kepribadian emosional tak stabil">F60.3 Gangguan kepribadian emosional tak stabil</option>
                                                <option value="F60.4 Gangguan kepribadian histrionic">F60.4 Gangguan kepribadian histrionic</option>
                                                <option value="F60.5 Gangguan kepribadian anankastik">F60.5 Gangguan kepribadian anankastik</option>
                                                <option value="F60.5 Gangguan kepribadian anankastik">F60.5 Gangguan kepribadian anankastik</option>
                                                <option value="F60.6 Gangguan kepribadian cemas (menghindar)">F60.6 Gangguan kepribadian cemas (menghindar)</option>
                                                <option value="F60.7 Gangguan kepribadian dependen">F60.7 Gangguan kepribadian dependen</option>
                                                <option value="F60.8 Gangguan kepribadian khas lainnya">F60.8 Gangguan kepribadian khas lainnya</option>
                                                <option value="F70 Reterdasi mental ringan">F70 Reterdasi mental ringan</option>
                                                <option value="F71 Retardasi mental sedang">F71 Retardasi mental sedang</option>
                                                <option value="F72 Retardasi mental berat">F72 Retardasi mental berat</option>
                                                <option value=" F73 Retardasi mental sangat berat"> F73 Retardasi mental sangat berat</option>
                                                <option value="F80 Gangguan perkembangan khas berbicara dan berbahasa">F80 Gangguan perkembangan khas berbicara dan berbahasa</option>
                                                <option value="F81 Gangguan perkembangan belajar khas">F81 Gangguan perkembangan belajar khas</option>
                                                <option value=" F82 Gangguan perkembangan motorik khas"> F82 Gangguan perkembangan motorik khas</option>
                                                <option value=" F83 Gangguan perkembangan khas campuran"> F83 Gangguan perkembangan khas campuran</option>
                                                <option value="F84 Gangguan perkembangan pervasif">F84 Gangguan perkembangan pervasif</option>
                                                <option value="F91.0 Gangguan tingkah laku yang terbatas pada lingkungan keluarga"> F91.0 Gangguan tingkah laku yang terbatas pada lingkungan keluarga</option>
                                                <option value="F91.1 Gangguan tingkah laku tak berkelompok">F91.1 Gangguan tingkah laku tak berkelompok</option>
                                                <option value=" F91.2 Gangguan tingkah laku berkelompok">F91.2 Gangguan tingkah laku berkelompok</option>
                                                <option value="F91.3 Gangguan sikap menentang (membangkang)">F91.3 Gangguan sikap menentang (membangkang)</option>
                                                <option value="F93.0 Gangguan anxietas perpisahan masa kanak">F93.0 Gangguan anxietas perpisahan masa kanak</option>
                                                <option value="F93.1 Gangguan anxietas fobik masa kanak">F93.1 Gangguan anxietas fobik masa kanak</option>
                                                <option value="F93.2 Gangguan anxietas sosial masa kanak">F93.2 Gangguan anxietas sosial masa kanak</option>
                                                <option value="F93.3 Gangguan persaingan antar saudara">F93.3 Gangguan persaingan antar saudara</option>
                                                <option value="F93.8 Gangguan emosional masa kanak lainnya">F93.8 Gangguan emosional masa kanak lainnya</option>
                                                <option value="F98.0 Enuresis non-organik">F98.0 Enuresis non-organik</option>
                                                <option value="F98.1 Enkopresis nonorganik">F98.1 Enkopresis nonorganik</option>
                                                <option value="F98.2 Gangguan makan masa bayi dan kanak">F98.2 Gangguan makan masa bayi dan kanak</option>
                                                <option value="F98.3 Pika masa bayi dan kanak">F98.3 Pika masa bayi dan kanak</option>
                                                <option value="F98.4 Gangguan gerakan stereotipik">F98.4 Gangguan gerakan stereotipik</option>
                                                <option value="F98.5 Gagap (Stuttering / Stammering)">F98.5 Gagap (Stuttering / Stammering)</option>
                                                <option value="F98.6 Berbicara cepat dan tersendat (Cluttering)">F98.6 Berbicara cepat dan tersendat (Cluttering)</option>
                                                <option value="Z63.7 Masalah dalam hubungan yang berkaitan dengan gangguan jiwa atau kondisi medik umum">Z63.7 Masalah dalam hubungan yang berkaitan dengan gangguan jiwa atau kondisi medik umum</option>
                                                <option value="Z63.8 Masalah hubungan orangtua - anak">Z63.8 Masalah hubungan orangtua - anak</option>
                                                <option value="Z63.0 Masalah dalam hubungan dengan pasangan">Z63.0 Masalah dalam hubungan dengan pasangan</option>
                                                <option value="Z63.4 Masalah berkaitan dengan kehilangan dan kematian anggota keluarga">Z63.4 Masalah berkaitan dengan kehilangan dan kematian anggota keluarga</option>
                                                <option value="Z56.8 Masalah berkaitan dengan pekerjaan">Z56.8 Masalah berkaitan dengan pekerjaan</option>
                                                <option value="Z60.0 Masalah penyesuaian pada masa Transisi Siklus Kehidupan">Z60.0 Masalah penyesuaian pada masa Transisi Siklus Kehidupan</option>
                                            </select>
                                            <div id="diagnosa"></div>
                                            <label style="font-size: 10px; font-style: italic;">* Isi Jika Diperlukan</label>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Diagnosa Banding</label>
                                            <input type="text" id="diagnosa_penyerta" name="diagnosa_penyerta" class="form-control" placeholder="Silahkan input">
                                            <label style="font-size: 10px; font-style: italic;">* Isi Jika Diperlukan</label>
                                        </div>

                                    </div>

                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Diagnosa Khusus</label>
                                            <select class="form-control select2" name="diagnosa_khusus" style="width: 100%;">
                                                <option selected="selected" value="">--Pilih--</option>
                                                <option value="Kekerasan Seksual Pada Anak">Kekerasan Seksual Pada Anak</option>
                                                <option value="Kekerasan Seksual">Kekerasan Seksual</option>
                                                <option value="Kekerasan Dalam Rumah Tangga">Kekerasan Dalam Rumah Tangga</option>
                                                <option value="Kekerasan Non Seksual Pada Anak">Kekerasan Non Seksual Pada Anak</option>
                                                <option value="Kekerasan Non Seksual">Kekerasan Non Seksual</option>
                                                <option value="Kekerasan Laki-laki">Kekerasan Laki-laki</option>
                                                <option value="Korban Pernikahan Anak">Korban Pernikahan Anak</option>
                                            </select>
                                            <label style="font-size: 10px; font-style: italic;">* Isi Jika Perlukan</label>
                                            <div id="diagnosa_khusus"></div>
                                        </div>
                                    </div>

                                    <!-- /.form-group -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tindakan</label>
                                            <select class="form-control select2" name="tindakan" id="tindakan_catatan_assesment" onchange="gettindakanCatatan()" style="width: 100%;">
                                                <option selected="selected" value="">--Pilih--</option>
                                                <option catatan-tindakan="konseling" value="Konseling Individu">Konseling Individu</option>
                                                <option catatan-tindakan="konseling" value="Konseling Kelompok">Konseling Kelompok</option>
                                                <?php if ($this->session->userdata('level') <> 3) { ?>
                                                    <option catatan-tindakan="rujuk" value="Rujuk Psikolog">Rujuk Psikolog</option>
                                                <?php } ?>
                                                <?php if ($this->session->userdata('level') <> 4) { ?>
                                                    <option catatan-tindakan="rujuk" value="Rujuk ke Dokter">Rujuk ke Dokter</option>
                                                <?php } ?>
                                            </select>
                                            <div id="tindakan"></div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-12" id="catatan-tindakan-html"></div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                    <!-- end asessment -->
                    
                    <!-- start rekammedis -->
                    <div class="col-md-12 col-sm-12" id="data_rekam">
                        <div class="card card-default ">
                             <div class="card-header">
                                    <div class="col-md-6">
                                        <h3 class="card-title"><span style="font-weight: bold; font-style:italic">Data Rekammedis</span></h3>
                                    </div>
                                    <div class="form-group row float-right col-md-6">
                                        <label class="col-md-4">Pilih Rekam Medis :</label>
                                        <div class="col-md-8">
                                            <select class="form-control select2" name="urut_rekam" id="urut_rekam" onchange="geturutrekam('<?= base_url() ?>',this.value)" style="width: 100%;"></select>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class = "form-group">
                                            <label>Tanggal Kegiatan Konseling</label>
                                            <input type="date" id="tgl_rekam" name="tgl_rekam" class="form-control">
                                            <input type="hidden" id="id_rekam" name="id_rekam" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Informasi Kegiatan Konseling Pasien</label>
                                            <textarea class="form-control rounded-0" id="keg_konseling" name="keg_konseling" rows="3" placeholder="--Belum ada kegiatan--" readonly></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>   
                                    <div class="col-12 col-sm-12" id="jns_terapi_html">
                                        <div class="form-group">
                                            <label>Hasil Intervensi</label>
                                            <textarea class="form-control rounded-0" id="jns_terapi" name="jns_terapi" rows="5"></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-12" id="kesimpulan_html">
                                        <div class="form-group">
                                            <label>Kesimpulan</label>
                                            <textarea class="form-control rounded-0" id="kesimpulan" name="kesimpulan" rows="5"></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Hasil Akhir</label>
                                            <select class="form-control select2" id="id_hasil_akhir" name="hasil_akhir" onchange="gethasilakhirCatatan(this.value, '<?= base_url() ?>')" style="width: 100%;">
                                                <option selected="selected" value="">--Pilih--</option>
                                                <option value="Konseling Lanjutan">Konseling Lanjutan</option>
                                                <option value="Rujukan ke Dokter / Dokter Spesialis">Rujukan ke Dokter / Dokter Spesialis</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                            <div id="hasil_akhir"></div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-12" id="set_hasilakhirCatatan"></div>
                                </div>          
                            </div>
                        </div>
                    </div>
                    <!-- end rekammedis -->
                </div>
            </div>
            <div class="modal-footer ">
                <button type="submit" class="btn btn-primary btn-xl"><i class="fas fa-edit"></i> Ubah</button>
                <button type="button" class="btn btn-danger btn-xl" data-dismiss="modal"><i class="fa fa-sign-in-alt"> </i> Batal</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal