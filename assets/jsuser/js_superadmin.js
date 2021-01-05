function ubah_pengguna(url, id) {
    var status = "";
    var level = "";
    $.ajax({
        type: 'post',
        url: url,
        data: {
            id: id
        },
        async: true,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            $("input[name='kd_pggn']").val(data.data_pengguna[0]['id_pengguna']);
            $("input[name='fullname']").val(data.data_pengguna[0]['fullname']);
            $("input[name='username']").val(data.data_pengguna[0]['username']);
            $("input[name='jabatan']").val(data.data_pengguna[0]['jabatan']);
            $('#a_level').val(data.data_pengguna[0]['level']).trigger('change');
            $('#a_status').val(data.data_pengguna[0]['status']).trigger('change');

            $("#btn_ubah_pengguna").html('<i class="fas fa-edit"></i> Ubah');
            $("#btn_ubah_pengguna_batal").attr('style', '');
            $('#form_pengguna_superadm').attr('action', data.base_url);
            $('#apassword').attr('placeholder', 'Masukan jika password ingin diubah');
            $('#lbl_ubah_photo').html(', abaikan jika tdk ingin diubah');
            $("input[name='fullname']").focus();
            $('#page-loading').hide();
        }

    });
}

function batalUbah(url) {
    $('#form_pengguna_superadm')[0].reset();
    $('#a_level').val('').trigger('change');
    $('#a_status').val('').trigger('change');
    $('#apassword').attr('placeholder', 'Masukan password...');
    $("#btn_ubah_pengguna").html('<i class="fas fa-save"></i> Simpan');
    $("#btn_ubah_pengguna_batal").attr('style', 'display:none;');
    $('#form_pengguna_superadm').attr('action', url);
    $('.custom-file-label').html('Pilih gambar profil');
    $('#lbl_ubah_photo').html('');
}

function hapus_pengguna(url, id) {
    var text = "";
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.ajax({
        type: 'post',
        url: url,
        data: {
            id: id
        },
        async: true,
        dataType: 'json',
        beforeSend: function () {
            $('#page-loading').show();
        },
        success: function (data) {
            if (data.success) text = "berhasil";
            else text = "gagal";
            Toast.fire({
                type: data.pesan,
                title: 'Data pengguna ' + text + ' dihapus'
            });

            $('#page-loading').hide();
            window.location.reload();
        }

    });
}

function s_getJabatan() {
    var jabatan_pengguna = $('#a_level option:selected').attr('jabatan');
    $("input[name='jabatan']").val(jabatan_pengguna);
}


function tema_header(base_url, id_warna_header) {
    $.ajax({
        type: 'post',
        url: base_url + 'superadmin/ubah_tema_header',
        data: {
            id_warna_header: id_warna_header
        },
        async: true,
        dataType: 'json',
        success: function (data) {
            $('#tema_colorheaderbar').attr('class', 'main-header navbar navbar-expand ' + id_warna_header);
        }
    });
}

function tema_profile(base_url, id_warna_profile) {
    $.ajax({
        type: 'post',
        url: base_url + 'superadmin/ubah_tema_profile',
        data: {
            id_warna_profile: id_warna_profile
        },
        async: true,
        dataType: 'json',
        success: function (data) {
            $('#tema_colorprofile').attr('class', 'user-header ' + id_warna_profile);
        }
    });
}

function tema_sidebar(base_url, id_warna_sidebar) {
    $.ajax({
        type: 'post',
        url: base_url + 'superadmin/ubah_tema_sidebar',
        data: {
            id_warna_sidebar: id_warna_sidebar,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
            $('#tema_colorsidebar').attr('class', 'main-sidebar elevation-4 ' + id_warna_sidebar);
        }
    });
}

function tema_logobar(base_url, id_warna) {
    $.ajax({
        type: 'post',
        url: base_url + 'superadmin/ubah_tema_logobar',
        data: {
            id_warna: id_warna
        },
        async: true,
        dataType: 'json',
        success: function (data) {
            $('#tema_colorlogobar').attr('class', 'brand-link ' + id_warna);
        }
    });
}

/*
 * input aktivitas ajax
 * menu Inputan pengguna [super admin]
 */

$('#form_pengguna_superadm').submit(function (e) {
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
        async: false,
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
                    title: 'Data pengguna ' + text + ' ' + response.text
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
 * akhir input pengguna super admin ajax
 * ------------------------------------------------------------------------
 */


$('input[name=photo]').on('change', function (event) {
    browseProfil(event);
});


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