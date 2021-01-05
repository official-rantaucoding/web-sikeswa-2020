/* user keseluruhan */

/*
 * input pasien baru ajax
 * menu pendaftaran pasien => input pasien baru [user]
 */

$('#form-pasien-baru').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const form_pasien_baru = $(this);

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();

            if (response.success) {
                if (response.pesan == "success") {
                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                    form_pasien_baru[0].reset();
                    $('select[name="pendidikan"]').val('').trigger('change');
                    $('select[name="jenis_kelamin"]').val('').trigger('change');
                    $('select[name="agama"]').val('').trigger('change');
                    $('select[name="status"]').val('').trigger('change');

                    Toast.fire({
                        type: response.pesan,
                        title: 'Data Pasien baru berhasil tersimpan'
                    });

                    window.location = response.base_url;

                } else {
                    Toast.fire({
                        type: response.pesan,
                        title: 'Data Pasien baru gagal tersimpan'
                    });
                }

            } else {

                $.each(response.message, function (key, value) {
                    var element = $('#' + key);

                    element.closest('input.form-control')
                        .removeClass('is-invalid')
                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                    element.closest('div.form-group')
                        .find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
})

/*
 * akhir input pasien baru ajax
 * -------------------------------------------------------------------------
 */

$('#form_ubah_pasien').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const form_ubah_pasien = $(this);

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();

            if (response.success) {
                if (response.pesan == "success") {
                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                    form_ubah_pasien[0].reset();
                    $('select[name="pendidikan"]').val('').trigger('change');
                    $('select[name="jenis_kelamin"]').val('').trigger('change');
                    $('select[name="agama"]').val('').trigger('change');
                    $('select[name="status"]').val('').trigger('change');

                    Toast.fire({
                        type: response.pesan,
                        title: 'Data Pasien baru berhasil tersimpan'
                    });

                    window.location = response.base_url;

                } else {
                    Toast.fire({
                        type: response.pesan,
                        title: 'Data Pasien baru gagal tersimpan'
                    });
                }
            } else {

                $.each(response.message, function (key, value) {
                    var element = $('#' + key);

                    element.closest('input.form-control')
                        .removeClass('is-invalid')
                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                    element.closest('div.form-group')
                        .find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
})

function hapus_pasien(url, value) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Proses ini akan menghapus seluruh data pasien\ntermasuk data asessment dan rekam medis pasien",
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#dc3545',
        confirmButtonColor: '#28a745',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'post',
                data: {
                    id_pasien: value
                },
                url: url + 'user/hapus_pasien',
                async: true,
                dataType: 'json',
                beforeSend: function () {
                    $('#page-loading').show();
                },
                success: function (data) {
                    $('#page-loading').hide();
                    if (data.success) {
                        Toast.fire({
                            type: 'success',
                            title: 'Data pasien berhasil terhapus'
                        });
                        window.location.reload();
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: 'Data pasien gagal terhapus'
                        });
                    }
                }
            });
        }
    });
}

function view_ubah_pasien(base_url, id_pasien) {
    $.ajax({
        type: 'post',
        data: {
            id_pasien: id_pasien
        },
        url: base_url + 'user/getdatapasien',
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            $('#page-loading').hide();
            var desa = '';
            var data_pasien = data[0];
            if (data_pasien.kecamatan == "Dolo") {
                desa = "<option value='Desa Kabobona'>Desa Kabobona</option>";
                desa += "<option value='Karawana'>Karawana</option>";
                desa += "<option value='Kotapulu'>Kotapulu</option>";
                desa += "<option value='Kotarindau'>Kotarindau</option>";
                desa += "<option value='Langaleso'>Langaleso</option>";
                desa += "<option value='Maku'>Maku</option>";
                desa += "<option value='Panturabate'>Panturabate</option>";
                desa += "<option value='Potoya'>Potoya</option>";
                desa += "<option value='Soulowe'>Soulowe</option>";
                desa += "<option value='Tulo'>Tulo</option>";
                desa += "<option value='Watubula'>Watubula</option>";
            } else if (data_pasien.kecamatan == "Sigi Biromaru") {
                desa = "<option value='Bora'>Bora</option>";
                desa += "<option value='Jono Oge'>Jono Oge</option>";
                desa += "<option value='Kalukubula'>Kalukubula</option>";
                desa += "<option value='Lolu'>Lolu</option>";
                desa += "<option value='Loru'>Loru</option>";
                desa += "<option value='Maranatha'>Maranatha</option>";
                desa += "<option value='Mpanau'>Mpanau</option>";
                desa += "<option value='Ngatabaru'>Ngatabaru</option>";
                desa += "<option value='Olobuju'>Olobuju</option>";
                desa += "<option value='Pombewe'>Pombewe</option>";
                desa += "<option value='Sidera'>Sidera</option>";
                desa += "<option value='Sidondo I'>Sidondo I</option>";
                desa += "<option value='Sidondo II'>Sidondo II</option>";
                desa += "<option value='Sidondo III'>Sidondo III</option>";
                desa += "<option value='Sidondo IV'>Sidondo IV</option>";
                desa += "<option value='Watunonju'>Watunonju</option>";
            } else {
                desa = "<option selected='selected' value=''>--Pilih Terlebih Dahulu Kecamatan--</option>";
            }
            $("#desa-daftar").html(desa);

            $("input[name='id_pasien']").val(data_pasien.id_pasien);
            $("input[name='no_rekam']").val(data_pasien.no_rekam_medis);
            $("input[name='no_hp']").val(data_pasien.no_hp);
            $("input[name='nm_lengkap']").val(data_pasien.nm_lengkap);
            $("input[name='alamat']").val(data_pasien.alamat);
            $("input[name='nm_panggilan']").val(data_pasien.nm_panggilan);
            $('#akabupaten').val(data_pasien.kabupaten).trigger('change');
            $("input[name='tempat_lahir']").val(data_pasien.tempat_lahir);
            $('#kecamatan').val(data_pasien.kecamatan).trigger('change');
            $("input[name='tgl_lahir']").val(data_pasien.tgl_lahir);
            $('#desa-daftar').val(data_pasien.desa).trigger('change');
            $("input[name='usia']").val(data_pasien.usia);
            $('#apendidikan').val(data_pasien.pendidikan).trigger('change');
            $('#ajenis_kelamin').val(data_pasien.jk).trigger('change');
            $("input[name='pekerjaan']").val(data_pasien.pekerjaan);
            $('#aagama').val(data_pasien.agama).trigger('change');
            $("input[name='nm_ortu']").val(data_pasien.nm_ortu);
            $('#astatus').val(data_pasien.status).trigger('change');
            $('#modal-ubah-pasienlama').modal('show');
        }
    });

}


/*
 * input assesment ajax
 * menu pendaftaran pasien => input pasien baru [user]
 */

$('#form_assesment').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();
            console.log(response);
            if (response.success) {
                if (response.pesan == "success") {
                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                    Toast.fire({
                        type: response.pesan,
                        title: 'Data assesment pasien berhasil tersimpan'
                    });

                    window.location = response.base_url;

                } else {
                    Toast.fire({
                        type: response.pesan,
                        title: 'Data assesment pasien gagal tersimpan'
                    });
                }
            } else {
                var key_post = ["id", "jenis_kelamin", "no_rkm_medis", "usia", "nama_lengkap", "pekerjaan", "diagnosa_penyerta"];
                $.each(response.message, function (key, value) {
                    var key_post_terplih = key_post.includes(key);
                    if (key_post_terplih == false) {
                        var element = $('#' + key);

                        element.closest('input.form-control')
                            .removeClass('is-invalid')
                            .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                        element.closest('div.form-group')
                            .find('.text-danger').remove();
                        element.after(value);
                    }
                });
            }
        }

    });
})


/*
 * akhir input assesment ajax
 * -------------------------------------------------------------------------
 */


function tambah_assesment_pasien(level, base_url) {

    $('#page-loading').show();
    var today = new Date();
    var tgl = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

    setTimeout(function () {
        var diagnosa_html = '';
        var tindakan_html = '';
        var diagnosa_khusus_html = '';
        var diagnosa_html = '';
        var psikotest_html = '';
        var btn_simpan = '';
        var btn_batal = '';
        diagnosa_html = ' <div class="form-group">';
        diagnosa_html += '<label>Diagnosa</label>';
        diagnosa_html += '<select class="form-control select2" name="diagnosa" style="width: 100%;">';
        diagnosa_html += '<option selected="selected" value="">--Pilih--</option>';
        diagnosa_html += '<option value="F00 – F09 Gangguan mental organik">F00 – F09 Gangguan mental organik</option>';
        diagnosa_html += '<option value="F10. – Gangguan mental dan perilaku akibat penggunaan alkohol">F10. – Gangguan mental dan perilaku akibat penggunaan alkohol</option>';
        diagnosa_html += '<option value="F11. – Ganguan mental dan perilaku akibat penggunaan opioida">F11. – Ganguan mental dan perilaku akibat penggunaan opioida</option>';
        diagnosa_html += '<option value="F12. – Gangguan mental dan perilaku akibat penggunaan kanabinoida">F12. – Gangguan mental dan perilaku akibat penggunaan kanabinoida</option>';
        diagnosa_html += '<option value="F13. – Gangguan mental dan perilaku akibat penggunaan Sedativa atau hipnotika">F13. – Gangguan mental dan perilaku akibat penggunaan Sedativa atau hipnotika</option>';
        diagnosa_html += '<option value="F14. – Gangguan mental dan perilaku akibat penggunaan Kokain">F14. – Gangguan mental dan perilaku akibat penggunaan Kokain</option>';
        diagnosa_html += '<option value="F15. – Gangguan mental dan perilaku akibat penggunaan stimulansia lain termasuk kafein">F15. – Gangguan mental dan perilaku akibat penggunaan stimulansia lain termasuk kafein</option>';
        diagnosa_html += '<option value="F16. – Gangguan dan perilaku akibat penggunaan halusinogenika"> F16. – Gangguan dan perilaku akibat penggunaan halusinogenika</option>';
        diagnosa_html += '<option value="F17. – Gangguan mental dan perilaku akibat penggunaan tembakau">F17. – Gangguan mental dan perilaku akibat penggunaan tembakau</option>';
        diagnosa_html += '<option value="F18. – Gangguan mental dan perilaku akibat penggunaan pelarut yang mudah menguap">F18. – Gangguan mental dan perilaku akibat penggunaan pelarut yang mudah menguap</option>';
        diagnosa_html += '<option value="F19. – Gangguan mental dan perilaku akibat penggunaan zat multipel dan penggunaan zat psikoaktif lainnya">F19. – Gangguan mental dan perilaku akibat penggunaan zat multipel dan penggunaan zat psikoaktif lainnya</option>';
        diagnosa_html += '<option value="F20.1 Skizofrenia hebefrenik">F20.1 Skizofrenia hebefrenik</option>';
        diagnosa_html += '<option value="F20.2 Skizofrenia katatonik">F20.2 Skizofrenia katatonik</option>';
        diagnosa_html += '<option value="F20.3 Skizofrenia tak terinci">F20.3 Skizofrenia tak terinci</option>';
        diagnosa_html += '<option value="F20.4 Depresi pasca-skizofrenia">F20.4 Depresi pasca-skizofrenia</option>';
        diagnosa_html += '<option value="F21 Gangguan Skizotipal">F21 Gangguan Skizotipal</option>';
        diagnosa_html += '<option value="F22 Gangguan Waham Menetap">F22 Gangguan Waham Menetap</option>';
        diagnosa_html += '<option value="F23 Gangguan Psikotik Akut Dan Sementara">F23 Gangguan Psikotik Akut Dan Sementara</option>';
        diagnosa_html += '<option value="F24 Gangguan Waham Induksi">F24 Gangguan Waham Induksi</option>';
        diagnosa_html += '<option value="F25.0 Gangguan skizoafektif tipe manik">F25.0 Gangguan skizoafektif tipe manik</option>';
        diagnosa_html += '<option value="F25.1 Gangguan skizoafektif tipe depresi">F25.1 Gangguan skizoafektif tipe depresi</option>';
        diagnosa_html += '<option value="F25.2 Gangguan skizoafektif tipe campuran">F25.2 Gangguan skizoafektif tipe campuran</option>';
        diagnosa_html += '<option value="F30 Episode manik">F30 Episode manik</option>';
        diagnosa_html += '<option value="F31 Gangguan afektif bipolar">F31 Gangguan afektif bipolar</option>';
        diagnosa_html += '<option value="F32.0 Episode depresif ringan">F32.0 Episode depresif ringan</option>';
        diagnosa_html += '<option value="F32.1 Episode depresif sedang">F32.1 Episode depresif sedang</option>';
        diagnosa_html += '<option value="F32.2 Episode depresif berat tanpa gejala psikotik">F32.2 Episode depresif berat tanpa gejala psikotik</option>';
        diagnosa_html += '<option value="F32.3 Episode depresif berat dengan gejala psikotik">F32.3 Episode depresif berat dengan gejala psikotik</option>';
        diagnosa_html += '<option value="F33 Gangguan depresif berulang">F33 Gangguan depresif berulang</option>';
        diagnosa_html += '<option value="F40.0 Agorafobia">F40.0 Agorafobia</option>';
        diagnosa_html += '<option value="F40.1 Fobia sosial">F40.1 Fobia sosial</option>';
        diagnosa_html += '<option value="F41.0 Gangguan panik (anxietas paroksismal episodik)">F41.0 Gangguan panik (anxietas paroksismal episodik)</option>';
        diagnosa_html += '<option value="F41.1 Gangguan anxietas menyeluruh">F41.1 Gangguan anxietas menyeluruh</option>';
        diagnosa_html += '<option value="F41.2 Gangguan campuran anxietas dan depresif">F41.2 Gangguan campuran anxietas dan depresif</option>';
        diagnosa_html += '<option value="F42 Gangguan obsesif-kompulsif">F42 Gangguan obsesif-kompulsif</option>';
        diagnosa_html += '<option value="F43.0 Reaksi stres akut">F43.0 Reaksi stres akut</option>';
        diagnosa_html += '<option value="F43.1 Gangguan stres pasca-trauma">F43.1 Gangguan stres pasca-trauma</option>';
        diagnosa_html += '<option value="F43.8 Reaksi stres berat lainnya">F43.8 Reaksi stres berat lainnya</option>';
        diagnosa_html += '<option value="F44 Gangguan dlsosiatif [konversi]">F44 Gangguan dlsosiatif [konversi]</option>';
        diagnosa_html += '<option value="F45.0 Gangguan somatisasi">F45.0 Gangguan somatisasi</option>';
        diagnosa_html += '<option value="F45.1 Gangguan somatoform tak terinci">F45.1 Gangguan somatoform tak terinci</option>';
        diagnosa_html += '<option value="F45.2 Gangguan hipokondrik">F45.2 Gangguan hipokondrik</option>';
        diagnosa_html += '<option value="F50 Gangguan makan">F50 Gangguan makan</option>';
        diagnosa_html += '<option value="F51 Gangguan tidur non-organik">F51 Gangguan tidur non-organik</option>';
        diagnosa_html += '<option value="F54 Gaktor psikologis dan perilaku yang berhubungan dengan gangguan atau penyakit (psikosomatis)">F54 Gaktor psikologis dan perilaku yang berhubungan dengan gangguan atau penyakit (psikosomatis)</option>';
        diagnosa_html += '<option value="F60.0 Gangguan kepribadian paranoid">F60.0 Gangguan kepribadian paranoid</option>';
        diagnosa_html += '<option value="F60.1 Gangguan kepribadian skizoid">F60.1 Gangguan kepribadian skizoid</option>';
        diagnosa_html += '<option value="F60.2 Gangguan kepribadian dissosial">F60.2 Gangguan kepribadian dissosial</option>';
        diagnosa_html += '<option value="F60.3 Gangguan kepribadian emosional tak stabil">F60.3 Gangguan kepribadian emosional tak stabil</option>';
        diagnosa_html += '<option value="F60.4 Gangguan kepribadian histrionic">F60.4 Gangguan kepribadian histrionic</option>';
        diagnosa_html += '<option value="F60.5 Gangguan kepribadian anankastik">F60.5 Gangguan kepribadian anankastik</option>';
        diagnosa_html += '<option value="F60.5 Gangguan kepribadian anankastik">F60.5 Gangguan kepribadian anankastik</option>';
        diagnosa_html += '<option value="F60.6 Gangguan kepribadian cemas (menghindar)">F60.6 Gangguan kepribadian cemas (menghindar)</option>';
        diagnosa_html += '<option value="F60.7 Gangguan kepribadian dependen">F60.7 Gangguan kepribadian dependen</option>';
        diagnosa_html += '<option value="F60.8 Gangguan kepribadian khas lainnya">F60.8 Gangguan kepribadian khas lainnya</option>';
        diagnosa_html += '<option value="F70 Reterdasi mental ringan">F70 Reterdasi mental ringan</option>';
        diagnosa_html += '<option value="F71 Retardasi mental sedang">F71 Retardasi mental sedang</option>';
        diagnosa_html += '<option value="F72 Retardasi mental berat">F72 Retardasi mental berat</option>';
        diagnosa_html += '<option value=" F73 Retardasi mental sangat berat"> F73 Retardasi mental sangat berat</option>';
        diagnosa_html += '<option value="F80 Gangguan perkembangan khas berbicara dan berbahasa">F80 Gangguan perkembangan khas berbicara dan berbahasa</option>';
        diagnosa_html += '<option value="F81 Gangguan perkembangan belajar khas">F81 Gangguan perkembangan belajar khas</option>';
        diagnosa_html += '<option value=" F82 Gangguan perkembangan motorik khas"> F82 Gangguan perkembangan motorik khas</option>';
        diagnosa_html += '<option value=" F83 Gangguan perkembangan khas campuran"> F83 Gangguan perkembangan khas campuran</option>';
        diagnosa_html += '<option value="F84 Gangguan perkembangan pervasif">F84 Gangguan perkembangan pervasif</option>';
        diagnosa_html += '<option value="F91.0 Gangguan tingkah laku yang terbatas pada lingkungan keluarga"> F91.0 Gangguan tingkah laku yang terbatas pada lingkungan keluarga</option>';
        diagnosa_html += '<option value="F91.1 Gangguan tingkah laku tak berkelompok">F91.1 Gangguan tingkah laku tak berkelompok</option>';
        diagnosa_html += '<option value=" F91.2 Gangguan tingkah laku berkelompok">F91.2 Gangguan tingkah laku berkelompok</option>';
        diagnosa_html += '<option value="F91.3 Gangguan sikap menentang (membangkang)">F91.3 Gangguan sikap menentang (membangkang)</option>';
        diagnosa_html += '<option value="F93.0 Gangguan anxietas perpisahan masa kanak">F93.0 Gangguan anxietas perpisahan masa kanak</option>';
        diagnosa_html += '<option value="F93.1 Gangguan anxietas fobik masa kanak">F93.1 Gangguan anxietas fobik masa kanak</option>';
        diagnosa_html += '<option value="F93.2 Gangguan anxietas sosial masa kanak">F93.2 Gangguan anxietas sosial masa kanak</option>';
        diagnosa_html += '<option value="F93.3 Gangguan persaingan antar saudara">F93.3 Gangguan persaingan antar saudara</option>';
        diagnosa_html += '<option value="F93.8 Gangguan emosional masa kanak lainnya">F93.8 Gangguan emosional masa kanak lainnya</option>';
        diagnosa_html += '<option value="F98.0 Enuresis non-organik">F98.0 Enuresis non-organik</option>';
        diagnosa_html += '<option value="F98.1 Enkopresis nonorganik">F98.1 Enkopresis nonorganik</option>';
        diagnosa_html += '<option value="F98.2 Gangguan makan masa bayi dan kanak">F98.2 Gangguan makan masa bayi dan kanak</option>';
        diagnosa_html += '<option value="F98.3 Pika masa bayi dan kanak">F98.3 Pika masa bayi dan kanak</option>';
        diagnosa_html += '<option value="F98.4 Gangguan gerakan stereotipik">F98.4 Gangguan gerakan stereotipik</option>';
        diagnosa_html += '<option value="F98.5 Gagap (Stuttering / Stammering)">F98.5 Gagap (Stuttering / Stammering)</option>';
        diagnosa_html += '<option value="F98.6 Berbicara cepat dan tersendat (Cluttering)">F98.6 Berbicara cepat dan tersendat (Cluttering)</option>';
        diagnosa_html += '<option value="Z63.7 Masalah dalam hubungan yang berkaitan dengan gangguan jiwa atau kondisi medik umum">Z63.7 Masalah dalam hubungan yang berkaitan dengan gangguan jiwa atau kondisi medik umum</option>';
        diagnosa_html += '<option value="Z63.8 Masalah hubungan orangtua - anak">Z63.8 Masalah hubungan orangtua - anak</option>';
        diagnosa_html += '<option value="Z63.0 Masalah dalam hubungan dengan pasangan">Z63.0 Masalah dalam hubungan dengan pasangan</option>';
        diagnosa_html += '<option value="Z63.4 Masalah berkaitan dengan kehilangan dan kematian anggota keluarga">Z63.4 Masalah berkaitan dengan kehilangan dan kematian anggota keluarga</option>';
        diagnosa_html += '<option value="Z56.8 Masalah berkaitan dengan pekerjaan">Z56.8 Masalah berkaitan dengan pekerjaan</option>';
        diagnosa_html += '<option value="Z60.0 Masalah penyesuaian pada masa Transisi Siklus Kehidupan">Z60.0 Masalah penyesuaian pada masa Transisi Siklus Kehidupan</option>';
        diagnosa_html += '</select>';
        diagnosa_html += '<label style="font-size: 10px; font-style: italic;">* Isi Jika Perlukan</label>';
        diagnosa_html += '<div id="diagnosa"></div>';
        diagnosa_html += '</div>';

        diagnosa_khusus_html = '<div class="form-group">';
        diagnosa_khusus_html += '<label>Diagnosa Khusus</label>';
        diagnosa_khusus_html += '<select class="form-control select2" name="diagnosa_khusus" style="width: 100%;">';
        diagnosa_khusus_html += '<option selected="selected" value="">--Pilih--</option>';
        diagnosa_khusus_html += '<option value="Kekerasan Seksual Pada Anak">Kekerasan Seksual Pada Anak</option>';
        diagnosa_khusus_html += '<option value="Kekerasan Seksual Pada Perempuan">Kekerasan Seksual Pada Perempuan</option>';
        diagnosa_khusus_html += '<option value="Kekerasan Dalam Rumah Tangga">Kekerasan Dalam Rumah Tangga</option>';
        diagnosa_khusus_html += '<option value="Kekerasan Non Seksual Pada Anak">Kekerasan Non Seksual Pada Anak</option>';
        diagnosa_khusus_html += '<option value="Kekerasan Non Seksual Pada Perempuan">Kekerasan Non Seksual Pada Perempuan</option>';
        diagnosa_khusus_html += '<option value="Kekerasan Laki-laki">Kekerasan Laki-laki</option>';
        diagnosa_khusus_html += '<option value="Korban Pernikahan Anak">Korban Pernikahan Anak</option>';
        diagnosa_khusus_html += '</select>';
        diagnosa_khusus_html += '<label style="font-size: 10px; font-style: italic;">* Isi Jika Perlukan</label>';
        diagnosa_khusus_html += '<div id="diagnosa_khusus"></div>';
        diagnosa_khusus_html += '</div>';

        psikotest_html = '<div class="form-group">';
        psikotest_html += '<label>Psikotest</label>';
        psikotest_html += '<select class="form-control select2" name="psikotest" id="psikotes" onchange="getpsikotestHasil(this.value)" style="width: 100%;">';
        psikotest_html += '<option selected="selected" value="">--Pilih--</option>';
        psikotest_html += '<option value="Grafis">Grafis</option>';
        psikotest_html += '<option value="Kepribadian">Kepribadian</option>';
        psikotest_html += '<option value="Intelegensi (WAIS)">Intelegensi (WAIS)</option>';
        psikotest_html += '<option value="Intelegensi (WISC)">Intelegensi (WISC)</option>';
        psikotest_html += '<option value="tor SPM">tor SPM</option>';
        psikotest_html += '<option value="CFIT">CFIT</option>';
        psikotest_html += '<option value="Ist">Ist</option>';
        psikotest_html += '</select>';
        psikotest_html += '<label style="font-size: 10px; font-style: italic;">* Isi Jika Dilakukan</label>';
        psikotest_html += '<div id="psikotest"></div>';
        psikotest_html += '</div>';

        tindakan_html = '<div class="form-group">';
        tindakan_html += '<label>Tindakan</label>';
        tindakan_html += '<select class="form-control select2" name="tindakan" id="tindakan_catatan_assesment" onchange="gettindakanCatatan()" style="width: 100%;">';
        tindakan_html += '<option selected="selected" value="">--Pilih--</option>';
        tindakan_html += '<option catatan-tindakan="konseling" value="Konseling Individu">Konseling Individu</option>';
        tindakan_html += '<option catatan-tindakan="konseling" value="Konseling Kelompok">Konseling Kelompok</option>';
        if (level != '3') tindakan_html += '<option catatan-tindakan="rujuk" value="Rujuk Psikolog">Rujuk Psikolog</option>';
        if (level != '4') tindakan_html += '<option catatan-tindakan="rujuk" value="Rujuk ke Dokter">Rujuk ke Dokter</option>';
        tindakan_html += '</select>';
        tindakan_html += '<div id="tindakan"></div>';
        tindakan_html += '</div>';

        btn_batal = '<button onclick="refresh_assesment()" class="btn btn-outline-primary float-right mr-2"><i class="fas fa-times"> </i> Batal</button>';
        btn_simpan = '<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Simpan </button>&nbsp;';
        // btn_simpan += '<a href="' + base_url + 'user/pasienlama" class="btn btn-outline-danger"><i class="fa fa-sign-in-alt"></i> Keluar </a>';

        $('#tgl_assesment').removeAttr('readonly').val(tgl);
        $('#tgl_assesment').focus();
        $('#diagnosa_html').html(diagnosa_html);
        $('#diagnosa_khusus_html').html(diagnosa_khusus_html);
        $('#psikotest_html').html(psikotest_html);
        $('#tindakan_html').html(tindakan_html);
        $('#keluhan').removeAttr('readonly').val('');
        $('#riwayat_penyakit').removeAttr('readonly').val('');
        $('#pengobatan').removeAttr('readonly').val('');
        $('#wawancara_psikologis').removeAttr('readonly').val('');
        $('#diagnosa_penyerta').removeAttr('readonly').val('');
        $('#set_hasil_psikotest').html('');
        $('#catatan-tindakan-html').html('');
        $('#btn_tambah_assesment_baru').html(btn_simpan);
        $('#html_btn_batal').html(btn_batal);

        $('.select2').select2();
        // $('#keluhan').focus();
        $('#page-loading').hide();
    }, 1000);

}

function tambah_rekammedis_pasien(url) {

    $('#page-loading').show();
    var today = new Date();
    var tgl = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

    setTimeout(function () {
        var btn_simpan = '';
        var hasil_akhir = '';
        var base_url = "'" + url + "'";

        hasil_akhir = '<div class="form-group">';
        hasil_akhir += '<label>Hasil Akhir</label>';
        hasil_akhir += '<select class="form-control select2" id="id_hasil_akhir" name="hasil_akhir" onchange="gethasilakhirCatatan(this.value, ' + base_url + ')" style="width: 100%;">';
        hasil_akhir += '<option selected="selected" value="">--Pilih--</option>';
        hasil_akhir += '<option value="Konseling Lanjutan">Konseling Lanjutan</option>';
        hasil_akhir += '<option value="Rujukan ke Dokter / Dokter Spesialis">Rujukan ke Dokter / Dokter Spesialis</option>';
        hasil_akhir += '<option value="Selesai">Selesai</option>';
        hasil_akhir += '</select>';
        hasil_akhir += '<div id="hasil_akhir"></div>';
        hasil_akhir += '</div>';

        btn_simpan = '<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"> </i> Simpan </button>&nbsp;';

        $('#tgl_rekam').removeAttr('readonly').val(tgl).focus();
        $('#jns_terapi').removeAttr('readonly').val('');
        $('#kesimpulan').removeAttr('readonly').val('');

        $('#btn_simpan_rekam_baru').html(btn_simpan);
        $('#hasil_akhir_html').html(hasil_akhir);
        $('#set_hasilakhirCatatan').html('');

        $('.select2').select2()
        $('#page-loading').hide();

    }, 1000);
}

/*
 * input assesment ajax
 * menu pendaftaran pasien => input pasien baru [user]
 */

$('#form_rekammedis').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();
            if (response.success) {
                if (response.pesan == "success") {
                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                    // form_rekammedis[0].reset();

                    Toast.fire({
                        type: response.pesan,
                        title: 'Data rekam medis pasien berhasil tersimpan'
                    });

                    window.location = response.base_url;

                } else {
                    Toast.fire({
                        type: response.pesan,
                        title: 'Data rekam medis pasien gagal tersimpan'
                    });
                }

            } else {

                var key_post = ["id_assesment", "jk", "no_rekam_medis", "usia", "nm_lengkap", "pekerjaan", "keluhan", "diagnosa"];

                $.each(response.message, function (key, value) {
                    var key_post_terplih = key_post.includes(key);
                    if (key_post_terplih == false) {
                        var element = $('#' + key);

                        element.closest('input.form-control')
                            .removeClass('is-invalid')
                            .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                        element.closest('div.form-group')
                            .find('.text-danger').remove();
                        element.after(value);
                    }
                });
            }
        }
    });
})


/*
 * akhir input assesment ajax
 * -------------------------------------------------------------------------
 */
$('#form_ubah_peserta').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const form_ubah_peserta = $(this);

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();

            if (response.success) {
                if (response.pesan == "success") {
                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                    form_ubah_peserta[0].reset();
                    $("select[name='kabupaten']").val('').trigger('change');
                    $("select[name='kecamatan']").val('').trigger('change');
                    $("select[name='jenis_kelamin']").val('').trigger('change');
                    $("select[name='pendidikan']").val('').trigger('change');
                    $("select[name='agama']").val('').trigger('change');
                    $("select[name='status']").val('').trigger('change');
                    $("select[name='aktivitas']").val('').trigger('change');
                    $("#desa-daftar").html("<option selected='selected' value=''>--Pilih Terlebih Dahulu Kecamatan--</option>");
                    $('#modal-ubah-peserta').modal('hide');

                    Toast.fire({
                        type: response.pesan,
                        title: 'Data Pasien baru berhasil tersimpan'
                    });


                    window.location.reload();

                } else {
                    Toast.fire({
                        type: response.pesan,
                        title: 'Data Pasien baru gagal tersimpan'
                    });
                }
            } else {

                $.each(response.message, function (key, value) {
                    var element = $('#' + key);

                    element.closest('input.form-control')
                        .removeClass('is-invalid')
                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                    element.closest('div.form-group')
                        .find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
})


// form_pasien_baru
function hapus_pendaftaran(base_url, id_pendaftaran, nama_pendaftar) {

    var html_data_peserta = "";
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data atas nama " + nama_pendaftar + " !",
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#dc3545',
        confirmButtonColor: '#28a745',
        confirmButtonText: 'Ya, Data akan di hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'post',
                data: {
                    id_pendaftaran: id_pendaftaran
                },
                url: base_url + 'user/hapus_peserta',
                async: true,
                dataType: 'json',
                success: function (data) {
                    if (data.pesan == "success") {
                        for (var i = 0; i < data.data_peserta.length; i++) {
                            data.data_peserta[i];
                            html_data_peserta += "<tr>";
                            html_data_peserta += "<td>" + (i + 1) + "</td>";
                            html_data_peserta += "<td>" + data.data_peserta[i]['no_pendaftaran'] + "</td>";
                            html_data_peserta += "<td>" + data.data_peserta[i]['nm_lengkap'] + "</td>";
                            html_data_peserta += "<td>" + data.data_peserta[i]['nomor_hp'] + "</td>";
                            html_data_peserta += "<td>" + data.data_peserta[i]['alamat'] + "</td>";
                            html_data_peserta += "<td>" + data.data_peserta[i]['aktivitas'] + "</td>";
                            html_data_peserta += "<td>";
                            html_data_peserta += "<button type='button' class = 'btn btn-success btn-sm'><i class='fas fa-edit'></i> Ubah</button>";
                            html_data_peserta += "<button onclick='hapus_pendaftaran('" + base_url + "', '" + data.data_peserta[i]['id_pendaftaran '] + "', '" + data.data_peserta[i]['nm_lengkap '] + "')' class = 'btn btn-danger btn-sm'><i class='fas fa-trash'></i> Hapus</button > ";
                            html_data_peserta += "</td>";
                            html_data_peserta += "</tr>";
                        }

                        $("#data_peserta").html(html_data_peserta);

                        Toast.fire({
                            type: 'success',
                            title: ' Data [ ' + nama_pendaftar + ' ] berhasil dihapus'
                        });

                        window.location.reload();

                    } else {
                        Toast.fire({
                            type: 'error',
                            title: ' Data [ ' + nama_pendaftar + ' ] berhasil dihapus'
                        });
                    }
                }

            });

        }
    })

}

function gettindakanCatatan() {
    var html = "";
    var id = $('#tindakan_catatan_assesment option:selected').attr('catatan-tindakan');
    if (id == "rujuk") {
        html = "<div class='form-group'>";
        html += "<label>Catatan</label>";
        html += "<textarea class='form-control rounded-0' id='catatan' name='catatan' rows='5'></textarea>";
        html += "</div>";
    }

    $("#catatan-tindakan-html").html(html);
}

function getpsikotestHasil(value) {
    var html = "";
    if (value != "") {
        html = "<div class='form-group'>";
        html += "<label>Hasil Psikotes</label><br>";
        html += "<textarea class='form-control rounded-0' id='hasil_psikotest' name='hasil_psikotest' value='' rows='5'></textarea>";
        html += "</div>";
    }

    $("#set_hasil_psikotest").html(html);
}

function gethasilakhirCatatan(value, base_url) {
    var html = "";
    var id_pasien = $('input[name="id_pasien"]').val();

    if (value != "") {
        if (value == "Rujukan ke Dokter / Dokter Spesialis") {
            html = "<div class='form-group'>";
            html += "<label>Catatan</label>";
            html += "<textarea class='form-control rounded-0' id='catt_akhir' name='catt_akhir' value='' rows='5'></textarea>";
            html += "</div>";
        }

        if (value == "Konseling Lanjutan") {

            $.ajax({
                type: 'post',
                data: {
                    id_pasien: id_pasien
                },
                url: base_url + 'user/getTotalrekammedis',
                async: true,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                            type: 'error',
                            title: 'Gagal',
                            text: 'Anda tidak dapat memilih konseling lanjutan pda pasien ini !!!\n Karena melebihi batas konseling'
                        });

                        $('#id_hasil_akhir').val('').trigger('change');
                    }
                }

            });

        }

        if (value == "Selesai") {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Sesi konseling telah selesai?",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#dc3545',
                confirmButtonColor: '#28a745',
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (!result.value) {
                    $('#id_hasil_akhir').val('').trigger('change');
                }
            });
        }
    }

    $("#set_hasilakhirCatatan").html(html);
}


function selectAktivitas(base_url, value) {
    var kodeAktivitas = value.substring(0, 5);
    var namaPeserta = '';
    var jmlPeserta = '';
    var jmlPeserta = 0;

    $.ajax({
        type: 'post',
        data: {
            id_aktivitas: value
        },
        url: base_url + 'user/getAktifitas',
        async: true,
        dataType: 'json',
        success: function (data) {
            for (let i = 0; i < data.length; i++) {
                jmlPeserta = (i + 1);
                namaPeserta += jmlPeserta + ". ";
                namaPeserta += data[i].nm_lengkap += "\n";
            }

            $('#kodeAktivitas').val(kodeAktivitas);
            $('#namaPeserta').val(namaPeserta);
            $('#jmlPeserta').val(jmlPeserta);

        }

    });
}

/* akhir user keseluruhan

* ----------------------------------------------------------------------------

user fieldOfficer */

/*
 * input peserta ajax
 * menu Pendaftaran Peserta [user fieldOfficer]
 */

$('#form-pendaftaran_peserta').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const form_pendaftaran_peserta = $(this);
    var text = '';

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();
            if (response.success) {
                if (response.pesan == "success") {
                    text = "berhasil";

                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                } else {
                    text = "gagal";
                }

                Toast.fire({
                    type: response.pesan,
                    title: 'Data Pendaftaran ' + text + ' tersimpan'
                });

                window.location = response.base_url;

            } else {
                let key_post = ["nomor_hp"];
                $.each(response.message, function (key, value) {
                    let key_post_terplih = key_post.includes(key);
                    if (key_post_terplih == false) {
                        var element = $('#' + key);
                        element.closest('input.form-control')
                            .removeClass('is-invalid')
                            .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                        element.closest('div.form-group')
                            .find('.text-danger').remove();
                        element.after(value);
                    }
                });
            }
        }
    });
})

/*
 * akhir input peserta ajax
 * -------------------------------------------------------------------------
 */

/*
 * input aktivitas ajax
 * menu Inputan Aktivitas [user fieldOfficer]
 */

$('#form-input-aktifitas').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const form_input_aktifitas = $(this);
    var text = '';

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this),
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();
            console.log(response);
            if (response.success) {
                if (response.pesan == "success") {
                    text = "berhasil";

                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                } else {
                    text = "gagal";
                }

                Toast.fire({
                    type: response.pesan,
                    title: 'Data Aktivitas ' + text + ' tersimpan'
                });

                window.location.reload();

            } else {
                $.each(response.message, function (key, value) {
                    var element = $('#' + key);
                    element.closest('input.form-control')
                        .removeClass('is-invalid')
                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                    element.closest('div.form-group')
                        .find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
})

/*
 * akhir input aktivitas ajax
 * ------------------------------------------------------------------------
 */

/*
 * input TOR ajax
 * menu Inputan TOR [user fieldOfficer]
 */

$('#form-input-tor').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const form_input_tor = $(this);
    var text = '';

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this),
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            $('#page-loading').hide();
            if (response.success) {
                if (response.pesan == "success") {
                    text = "berhasil";

                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                } else {
                    text = "gagal";
                }

                Toast.fire({
                    type: response.pesan,
                    title: 'Data TOR ' + text + ' tersimpan'
                });

                window.location = response.base_url;

            } else {
                $.each(response.message, function (key, value) {
                    var element = $('#' + key);
                    element.closest('input.form-control')
                        .removeClass('is-invalid')
                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                    element.closest('div.form-group')
                        .find('.text-danger').remove();
                    element.after(value);
                });
            }
        }
    });
})

/*
 * akhir input TOR ajax
 * -------------------------------------------------------------------------
 */

/*
 * ubah TOR ajax
 * menu Inputan TOR [user fieldOfficer]
 */

$('#form_ubah_tor').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    var form_input_tor = $(this);
    var text = '';

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this),
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (response) {
            console.log(response);
            $('#page-loading').hide();
            if (response.success) {
                if (response.pesan == "success") {
                    text = "berhasil";

                    $('.form-control').removeClass('is-invalid')
                        .removeClass('is-valid');
                    $('.text-danger').remove();

                } else {
                    text = "gagal";
                }

                Toast.fire({
                    type: response.pesan,
                    title: 'Data TOR ' + text + ' tersimpan'
                });

                $('#modal-ubah-tor').modal('hide');
                window.location.reload();

            } else {
                let key_post = ["file_rab_old"];
                $.each(response.message, function (key, value) {
                    let key_post_terplih = key_post.includes(key);
                    if (key_post_terplih == false) {
                        var element = $('#' + key);
                        element.closest('input.form-control')
                            .removeClass('is-invalid')
                            .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                        element.closest('div.form-group')
                            .find('.text-danger').remove();
                        element.after(value);
                    }
                });
            }
        }
    });
})

/*
 * akhir ubah TOR ajax
 * -------------------------------------------------------------------------
 */


/*
 * Menampilkan nama file dan ukuran
 * menu Inputan AKtivitas [user fieldOfficer]
 */

$('input[id=img_dok]').on('change', function (event) {
    var nama_file = "";
    var title = "";
    files = event.target.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var size = bytesToSize(file.size, 2);

        if (files.length == 1) nama_file += file.name + " | " + size;
        else if (files.length > 1) {
            nama_file = files.length + " file dokumentasi terpilih";
        }

        title += file.name + " | " + size + "\n";
    }

    if (nama_file == "" || title == "") nama_file = "Pilih gambar dokumentasi";
    $(this).attr('title', title);
    $('.custom-file-label').html(nama_file);
});

/*
 * Menampilkan nama file dan ukuran
 * --------------------------------------------------------------------------
 */


/*
 * Menampilkan nama file dan ukuran
 * menu Inputan TOR [user fieldOfficer]
 */

$('input[id=tor_rab]').on('change', function (event) {
    var nama_file = "";
    files = event.target.files;
    var size = bytesToSize(files[0].size, 2);
    nama_file = files[0].name + " | " + size;
    if (nama_file == "") nama_file = "Pilih file RAB";
    $('.file_rab').html(nama_file);
});

/*
 * akhir menampilkan nama file dan ukuran
 * --------------------------------------------------------------------------
 */

/*
 * konversi size file 
 * menu Inputan TOR, Inputan Aktivitas [user fieldOfficer]
 */

function bytesToSize(bytes, decimals) {
    if (bytes == 0) return '0 Bytes';
    var k = 1024,
        dm = decimals <= 0 ? 0 : decimals || 2,
        sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

/*
 * akhir konversi size file 
 * ---------------------------------------------------------------------------
 */


function view_lihatTor(base_url, value) {
    var html_rab_us = '';

    $.ajax({
        type: 'post',
        data: {
            id_tor: value
        },
        url: base_url + 'user/getTor',
        async: true,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            $('#page-loading').hide();
            var data_tor = data[0];
            $("input[name='lht_judul_tor']").val(data_tor.judul_tor);
            $("textarea[name='lht_ltr_belakang']").val(data_tor.ltr_belakang);
            $("textarea[name='lht_tujuan']").val(data_tor.tujuan);
            $("textarea[name='lht_fasilitator']").val(data_tor.fasilitator);
            $("input[name='lht_jml_peserta']").val(data_tor.jml_peserta);
            $("input[name='lht_tanggal']").val(data_tor.tgl);
            $("input[name='lht_tgl_selesai']").val(data_tor.tgl_selesai);
            $("textarea[name='lht_lokasi']").val(data_tor.lokasi);
            $("input[name='lht_kecamatan']").val(data_tor.kecamatan);
            $("input[name='lht_desa']").val(data_tor.desa);
            $("input[name='lht_anggaran']").val(data_tor.anggaran);
            $("textarea[name='lht_perlengkapan']").val(data_tor.perlengkapan);
            $("textarea[name='lht_penutup']").val(data_tor.penutup);
            if (data_tor.rab != '') {
                html_rab_us = '<div class="form-group">';
                html_rab_us += '<label>File RAB</label>';
                html_rab_us += '<embed src= "' + base_url + '/assets/dokumen/tor/' + data_tor.rab + '" type= "application/pdf" width="100%" height="600px" />';
                html_rab_us += '</div>';
                $('#html_lht_filerab_us').html(html_rab_us);
            } else {
                html_rab_us = '<div class="form-group">';
                html_rab_us += '<label>File RAB</label><br>';
                html_rab_us += '<i>File RAB belum diupload</i>';
                html_rab_us += '</div>';
                $('#html_lht_filerab_us').html(html_rab_us);
            }

            $('#modal-lihat-tor').modal('show');
        }
    });
}




function view_ubahTor(base_url, value) {

    let Dolo = ["Desa Kabobona", "Kotapulu", "Kotarindau", "Langaleso", "Maku", "Panturabate", "Potoya", "Soulowe", "Tulo", "Watubula"],
        Sigi = ["Bora", "Jono Oge", "Kalukubula", "Lolu", "Loru", "Maranatha", "Mpanau", "Ngatabaru", "Olobuju", "Pombewe", "Sidera", "Sidondo I", "Sidondo II", "Sidondo III", "Sidondo IV", "Watunonju", ],
        Palu = ["Tatura Utara", "Tatura Selatan"],
        SigiDolo = ["Sidera, Karawana, Soulowe dan Potoya"];

    $.ajax({
        type: 'post',
        data: {
            id_tor: value
        },
        url: base_url + 'user/getTor',
        async: true,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            $('#page-loading').hide();
            let desa = '';
            let data_tor = data[0];

            $("input[name='ubh_kode_tor']").val(data_tor.kode_tor);
            $("input[name='ubh_judul_tor']").val(data_tor.judul_tor);
            $("textarea[name='ubh_ltr_belakang']").val(data_tor.ltr_belakang);
            $("textarea[name='ubh_tujuan']").val(data_tor.tujuan);
            $("textarea[name='ubh_fasilitator']").val(data_tor.fasilitator);
            $("input[name='ubh_jml_peserta']").val(data_tor.jml_peserta);
            $("input[name='ubh_tanggal']").val(data_tor.tgl);
            $("input[name='ubh_tgl_selesai']").val(data_tor.tgl_selesai);
            $("textarea[name='ubh_lokasi']").val(data_tor.lokasi);
            $("input[name='ubh_kecamatan']").val(data_tor.kecamatan);
            $("input[name='ubh_desa']").val(data_tor.desa);
            $("input[name='ubh_anggaran']").val(data_tor.anggaran);
            $("textarea[name='ubh_perlengkapan']").val(data_tor.perlengkapan);
            $("textarea[name='ubh_penutup']").val(data_tor.penutup);
            $("input[name='file_rab_old']").val(data_tor.rab);
            $('#tor-judultor').val(data_tor.judul_tor).trigger('change');
            $('#tor-kecamatan').val(data_tor.kecamatan).trigger('change');

            if (data_tor.kecamatan == "Dolo") {
                desa = "<option value=''>--Pilih--</option>";
                Dolo.forEach(dolo => {
                    desa += "<option value='" + dolo + "'>" + dolo + "</option>";
                });

            } else if (data_tor.kecamatan == "Sigi Biromaru") {
                desa = "<option value=''>--Pilih--</option>";
                Sigi.forEach(sigi => {
                    desa += "<option value='" + sigi + "'>" + sigi + "</option>";
                });

            } else if (data_tor.kecamatan == "Palu") {
                desa = "<option value=''>--Pilih--</option>";
                Palu.forEach(palu => {
                    desa += "<option value='" + palu + "'>" + palu + "</option>";
                });

            } else if (data_tor.kecamatan == "Sigi Biromaru dan Dolo") {
                desa = "<option value=''>--Pilih--</option>";
                SigiDolo.forEach(sigidolo => {
                    desa += "<option value='" + sigidolo + "'>" + sigidolo + "</option>";
                });

            } else {
                desa = "<option value='' selected>--Pilih Terlebih Dahulu Kecamatan--</option>";
            }

            $('.file_rab').html('Pilih file RAB');
            $("#desa-daftar").html(desa);
            $('#desa-daftar').val(data_tor.desa).trigger('change');

            $('#modal-ubah-tor').modal('show');
        }
    });
}

function view_ubahPeserta(base_url, value) {
    $.ajax({
        type: 'post',
        data: {
            id_daftar: value
        },
        url: base_url + 'user/getPeserta',
        async: true,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            $('#page-loading').hide();
            var desa = '';
            var data_peserta = data[0];

            $("input[name='id_pendaftaran']").val(data_peserta.id_pendaftaran);
            $("input[name='no_pendaftaran']").val(data_peserta.no_pendaftaran);
            $("input[name='alamat']").val(data_peserta.alamat);
            $("input[name='nm_lengkap']").val(data_peserta.nm_lengkap);
            $("select[name='kabupaten']").val(data_peserta.kabupaten).trigger('change');
            $("input[name='nomor_hp']").val(data_peserta.nomor_hp);
            $("select[name='kecamatan']").val(data_peserta.kecamatan).trigger('change');
            $("select[name='jenis_kelamin']").val(data_peserta.jenis_kelamin).trigger('change');
            $("select[name='pendidikan']").val(data_peserta.pendidikan).trigger('change');
            $("select[name='agama']").val(data_peserta.agama).trigger('change');
            $("input[name='pekerjaan']").val(data_peserta.pekerjaan);
            $("select[name='status']").val(data_peserta.status).trigger('change');
            $("input[name='usia']").val(data_peserta.usia);
            $("select[name='aktivitas']").val(data_peserta.aktivitas).trigger('change');

            if (data_peserta.kecamatan == "Dolo") {
                desa = "<option value='Desa Kabobona'>Desa Kabobona</option>";
                desa += "<option value='Karawana'>Karawana</option>";
                desa += "<option value='Kotapulu'>Kotapulu</option>";
                desa += "<option value='Kotarindau'>Kotarindau</option>";
                desa += "<option value='Langaleso'>Langaleso</option>";
                desa += "<option value='Maku'>Maku</option>";
                desa += "<option value='Panturabate'>Panturabate</option>";
                desa += "<option value='Potoya'>Potoya</option>";
                desa += "<option value='Soulowe'>Soulowe</option>";
                desa += "<option value='Tulo'>Tulo</option>";
                desa += "<option value='Watubula'>Watubula</option>";
            } else if (data_peserta.kecamatan == "Sigi Biromaru") {
                desa = "<option value='Bora'>Bora</option>";
                desa += "<option value='Jono Oge'>Jono Oge</option>";
                desa += "<option value='Kalukubula'>Kalukubula</option>";
                desa += "<option value='Lolu'>Lolu</option>";
                desa += "<option value='Loru'>Loru</option>";
                desa += "<option value='Maranatha'>Maranatha</option>";
                desa += "<option value='Mpanau'>Mpanau</option>";
                desa += "<option value='Ngatabaru'>Ngatabaru</option>";
                desa += "<option value='Olobuju'>Olobuju</option>";
                desa += "<option value='Pombewe'>Pombewe</option>";
                desa += "<option value='Sidera'>Sidera</option>";
                desa += "<option value='Sidondo I'>Sidondo I</option>";
                desa += "<option value='Sidondo II'>Sidondo II</option>";
                desa += "<option value='Sidondo III'>Sidondo III</option>";
                desa += "<option value='Sidondo IV'>Sidondo IV</option>";
                desa += "<option value='Watunonju'>Watunonju</option>";
            } else {
                desa = "<option selected='selected' value=''>--Pilih Terlebih Dahulu Kecamatan--</option>";
            }

            $("#desa-daftar").html(desa);
            $('#desa-daftar').val(data_peserta.desa).trigger('change');

            $('#modal-ubah-peserta').modal('show');
        }
    });
}


function view_lihatLayanan_konseling(base_url, id_pasien, tindakan) {
    $.ajax({
        type: 'post',
        data: {
            id_pasien: id_pasien,
            tindakan: tindakan
        },
        url: base_url + 'user/getlayananUser',
        async: true,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            $('#page-loading').hide();
            var data_layanan_konseling = data.data_pasien[0];
            $("textarea[name='info_konseling']").val(data.kegiatan_assesment);
            $("input[name='id']").val(data_layanan_konseling.id_pasien);
            $("input[name='jenis_kelamin']").val(data_layanan_konseling.jk);
            $("input[name='no_rkm_medis']").val(data_layanan_konseling.no_rekam_medis);
            $("input[name='usia']").val(data_layanan_konseling.usia);
            $("input[name='nama_lengkap']").val(data_layanan_konseling.nm_lengkap);
            $("input[name='pekerjaan']").val(data_layanan_konseling.pekerjaan);
            $("textarea[name='keluhan']").val(data_layanan_konseling.keluhan);
            $("input[name='riwayat_penyakit']").val(data_layanan_konseling.riwayat_penyakit);
            $("input[name='pengobatan']").val(data_layanan_konseling.pengobatan);
            $("textarea[name='wawancara_psikologis']").val(data_layanan_konseling.wawancara_psikologis);
            $("input[name='psikotest']").val(data_layanan_konseling.psikotest);
            $("input[name='diagnosa']").val(data_layanan_konseling.diagnosa);
            $("input[name='diagnosa_penyerta']").val(data_layanan_konseling.diagnosa_penyerta);
            $("input[name='diagnosa_khusus']").val(data_layanan_konseling.diagnosa_khusus);
            $("input[name='tindakan']").val(data_layanan_konseling.tindakan);
            $("#modal-lihat-layanaindkel").modal('show');
        }
    });
}

function hitung_umur(date) {
    var hari_ini = new Date();
    var tgl_lahir = new Date(date);
    var year = 0;
    if (hari_ini.getMonth() < tgl_lahir.getMonth()) {
        year = 1;
    } else if ((hari_ini.getMonth() == tgl_lahir.getMonth()) && hari_ini.getDate() < tgl_lahir.getDate()) {
        year = 1;
    }

    var age = hari_ini.getFullYear() - tgl_lahir.getFullYear() - year;
    if (age < 0) {
        age = 0;
    }

    $('input[name="usia"]').val(age);
}

function refresh_assesment() {
    window.location.reload();
}


function view_lihat_aktifitas(base_url, value) {

    $.ajax({
        type: 'post',
        data: {
            id_aktifitas: value
        },
        url: base_url + 'user/getLihatktifitas',
        async: true,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            $('#page-loading').hide();
            let data_aktifivitas = data[0][0];
            let nama_peserta = data[1];
            let html = '';
            let dokumentasi = data[2];
            // console.log(data_aktifivitas);
            // console.log(data);
            $("textarea[name='lht_pilih_aktifitas']").val(data_aktifivitas.nm_aktivitas);
            $("input[name='lht_kode_aktifitas']").val(data_aktifivitas.kode_aktivitas);
            $("textarea[name='lht_peserta']").val(nama_peserta);
            $("input[name='lht_jumlah_peserta']").val(data_aktifivitas.jml_peserta);
            $("input[name='lht_dana']").val(data_aktifivitas.dana);
            $("input[name='lht_tanggal']").val(data_aktifivitas.tgl);
            $("input[name='lht_tgl_selesai']").val(data_aktifivitas.tgl_selesai);
            $("input[name='lht_narasumber']").val(data_aktifivitas.nara_sumber);
            $("input[name='lht_lokasi']").val(data_aktifivitas.lokasi);
            $("textarea[name='lht_hasil_kegiatan']").val(data_aktifivitas.notulensi);
            $("textarea[name='lht_kesimpulan']").val(data_aktifivitas.kesimpulan);

            for (let i = 0; i < dokumentasi.length; i++) {
                html += '<div class="col-sm-12 col-md-4">';
                html += '<img src = "' + base_url + 'assets/image/img_dok_aktivitas/' + dokumentasi[i].gambar + '" class="img-thumbnail" alt="imgdok" />';
                html += '</div>';
            }

            $("#dokumentasi").html(html);
            $('#modal-lihat-aktifitas').modal('show');
        }
    });
}
// end field 


//Awal

//Kode Otomatis RealTime All 

function printkode(url) {
    setTimeout(function () {
        getkode(url, 'pdf');
        getkode(url, 'tr');
        printkode(url);
    }, 1000);
}

function getkode(url, id) {
    var params;
    var name;
    switch (id) {
        case 'pdf':
            params = 'tb_pendaftaran/id_pendaftaran/PPS';
            name = 'no_pendaftaran';
            break;
        case 'tr':
            params = 'tb_tor/kode_tor/TOR-';
            name = 'kd_tor';
            break;
        default:
            break;
    }

    $.ajax({
        type: "get",
        url: url + "user/getautokode/" + params,
        async: true,
        dataType: "json",
        success: function (data) {
            $('input[name="' + name + '"]').val(data);
        }
    });
}
//Akhir
