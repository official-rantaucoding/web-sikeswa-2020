/*
 * ubah profil ajax
 * menu profil pengguna
 */

$('#form-ubah_profile').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    var text = '';

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: new FormData(this),
        cache: false,
        processData: false,
        contentType: false,
        // async:false,
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
                    $('#fullname_pengguna').val(response.nm_lengkap);

                } else {
                    text = "gagal";
                }

                Toast.fire({
                    type: response.pesan,
                    title: 'Data Profil ' + text + ' diubah'
                });

                // if (response.foto != "") {
                //     $('#img-pengguna-topbar').attr('src', ''+response.foto);
                //     $('#imgpengguna-topbar-dropdown').attr('src', ''+response.foto);
                // }
                // if (response.nm_lengkap != "") {
                //     $('#nama_lengkap_topbar').html(response.nm_lengkap);
                //     $('#namalengkap_topbar_dropdown').html(response.nm_lengkap);
                // }

                // $('.custom-file-label').html('Pilih gambar profil');


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
 * akhir Menampilkan nama file dan ukuran
 * menu ubah profil
 * ----------------------------------------------------------------------------------------------
 */


/*
 * ubah sandi ajax
 * menu profil pengguna
 */

$('#form-ubah-sandi').submit(function (e) {
    e.preventDefault();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    var form_ubah_sandi = $(this);
    var text = '';

    $.ajax({
        url: form_ubah_sandi.attr('action'),
        type: form_ubah_sandi.attr('method'),
        data: form_ubah_sandi.serialize(),
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
                    title: 'Data kata sandi ' + text + ' diubah'
                });

                form_ubah_sandi[0].reset();
                if (response.username != '') $('input[name=nama_pengguna]').val(response.username);

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
 * Menampilkan nama file dan ukuran
 * menu ubah kata sandi
 * -----------------------------------------------------------------------------------------------------
 */

$('input[name="photo_pengguna_other"]').on('change', function (event) {
    browseProfil(event);
    previewGambarprofil(this);
});


function previewGambarprofil(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_profil').attr('src', e.target.result);
            $('#img_profil').hide();
            $('#img_profil').fadeIn(500);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function browseProfil(event) {
    files = event.target.files;
    var file = files[0];
    var nama_file = file.name + " | " + bytesToSize(file.size, 2);
    var title = file.name + " | " + bytesToSize(file.size, 2);

    if (nama_file == "" || title == "") nama_file = "Pilih gambar profil";
    $(this).attr('title', title);
    $('.custom-file-label').html(nama_file);
}
/*
 * Menampilkan nama file dan ukuran
 * --------------------------------------------------------------------------
 */


/*
 * konversi size file 
 * menu Ubah profil, profil pengguna
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

function tampilSandi(id_input, id_btn) {
    var data = $('#' + id_input).attr('data-tampil');
    if (data == 'hide') {
        $('#' + id_input).attr('type', 'text');
        $('#' + id_input).attr('data-tampil', 'show');
        $('#' + id_btn).html('<span class="fas fa-eye-slash"></span>');
    } else if (data == 'show') {
        $('#' + id_input).attr('data-tampil', 'hide');
        $('#' + id_input).attr('type', 'password');
        $('#' + id_btn).html('<span class="fas fa-eye"></span>');
    }
}

function getDate(id) {
    var today = new Date();
    document.getElementById(id).value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
}

function keyupRupiah(ctx, value) {
    $("input[name='" + ctx + "']").val(formatRupiah(value, 'Rp. '));
}

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}

function hanyaHuruf(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 32)

        return false;
    return true;
}

function formatTelepon(ctx, value) {
    var telkomsel = ["0812", "0813", "0821", "0822", "0852", "0853", "0823", "0851"];
    var indosat = ["0814", "0815", "0816", "0855", "0856", "0857", "0858"];
    var three = ["0895", "0896", "0897", "0898", "0899"];
    var smartfren = ["0881", "0882", "0883", "0884", "0885", "0886", "0887", "0888", "0889"];
    var xl = ["0817", "0818", "0819", "0859", "0877", "0878"];
    var axis = ["0838", "0831", "0832", "0833"];
    var halo = ["0811"];
    var key;
    var result;

    if (value.length >= 4 && value.length <= 12) {

        result = true;
        key = value.substring(0, 4);
        var result_telkomsel = telkomsel.includes(key);
        var result_indosat = indosat.includes(key);
        var result_three = three.includes(key);
        var result_smartfren = smartfren.includes(key);
        var result_xl = xl.includes(key);
        var result_axis = axis.includes(key);
        var result_halo = halo.includes(key);

        if (result_telkomsel) {
            // $('.notelp').css({"background-image":"url(../assets/image/img_operatorsel/telkomsel.png)"});
            result = false;
        }

        if (result_indosat) {
            // $('.notelp').css({"background-image": "url(../assets/image/img_operatorsel/indosat.png)" });
            result = false;
        }

        if (result_three) {
            // $('.notelp').css({
            //     "background-image": "url(../assets/image/img_operatorsel/three.png)"
            // });
            result = false;
        }

        if (result_smartfren) {
            // $('.notelp').css({
            //     "background-image": "url(../assets/image/img_operatorsel/smartfren.png)"
            // });
            result = false;
        }

        if (result_xl) {
            // $('.notelp').css({
            //     "background-image": "url(../assets/image/img_operatorsel/xl.png)"
            // });
            result = false;
        }

        if (result_axis) {
            // $('.notelp').css({
            //     "background-image": "url(../assets/image/img_operatorsel/axis.png)"
            // });
            result = false;
        }
        if (result_halo) {
            // $('.notelp').css({
            //     "background-image": "url(../assets/image/img_operatorsel/axis.png)"
            // });
            result = false;
        }

        if (result) {
            // $('.notelp').css({
            //     "background-image": "url()"
            // });
            $('input[name="' + ctx + '"]').val('');
        }

    } else {
        // $('.notelp').css({
        //     "background-image": "url()"
        // });
    }

    // if (value.length < 12 || value.length > 12) {
    //     $('input[name="'+ctx+'"]').val('');
    // }
}

function pilih_desa(id_kecamatan) {
    var desa = "";
    if (id_kecamatan == "Dolo") {
        desa = '<div class="form-group">';
        desa += '<label>Desa</label>';
        desa += '<select class="form-control select2" id="desa-daftar" name="desa" style="width: 100%;">';
        desa += '<option selected="selected" value="">--Pilih--</option>';
        desa += "<option value='Kabobona'>Kabobona</option>";
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
        desa += '</select>';
        desa += '<div id="desa"></div>';
        desa += '</div>';

    } else if (id_kecamatan == "Sigi Biromaru") {
        desa = '<div class="form-group">';
        desa += '<label>Desa</label>';
        desa += '<select class="form-control select2" id="desa-daftar" name="desa" style="width: 100%;">';
        desa += '<option selected="selected" value="">--Pilih--</option>';
        desa += "<option value='Bora'>Bora</option>";
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
        desa += '</select>';
        desa += '<div id="desa"></div>';
        desa += '</div>';

    } else if (id_kecamatan == "Lainnya") {
        desa = '<div class="form-group">';
        desa += '<label>Desa</label>';
        desa += '<input type="text" id="desa" name="desa" class="form-control" placeholder="Masukan Desa" value="" onkeypress="return hanyaHuruf(event)"></div>';

    } else {
        desa = '<div class="form-group">';
        desa += '<label>Desa</label>';
        desa += '<select class="form-control select2" id="desa-daftar" name="desa" style="width: 100%;">';
        desa += '<option selected="selected" value="">--Pilih Terlebih Dahulu Kecamatan--</option>';
        desa += '</select>';
        desa += '<div id="desa"></div>';
        desa += '</div>';
    }

    $("#desaLainnya").html(desa);
    $('.select2').select2();
}


function pilih_desa_tor(id_kecamatan) {
    var desa = "";
    desa = "<option selected='selected' value=''>--Pilih--</option>";
    if (id_kecamatan == "Palu") {
        desa += "<option value='Tatura Utara'>Tatura Utara</option>";
        desa += "<option value='Tatura Selatan'>Tatura Selatan</option>";
    } else if (id_kecamatan == "Sigi Biromaru dan Dolo") {
        desa += "<option value='Sidera, Karawana, Soulowe dan Potoya'>Sidera, Karawana, Soulowe dan Potoya</option>";
    } else if (id_kecamatan == "Dolo") {
        desa += "<option value='Desa Kabobona'>Desa Kabobona</option>";
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
    } else if (id_kecamatan == "Sigi Biromaru") {
        desa += "<option value='Bora'>Bora</option>";
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
}


function open_submenu(id_submenu) {
    let style = $("#" + id_submenu).attr('style');
    if (style == "display: none;") {
        $("#" + id_submenu).fadeIn(500);
        $("#" + id_submenu).attr('style', 'display: block;');
    } else if (style == "display: block;") {
        $("#" + id_submenu).attr('style', 'display: none;');
        $("#" + id_submenu).fadeOut(500);
    }
}