function view_ubah_asessment(base_url, id_pasien, id_asessment) {
  $.ajax({
    type: 'post',
    data: {
      id_pasien: id_pasien,
      id_asessment: id_asessment,
    },
    url: base_url + 'admin/ubah_asessment',
    async: true,
    dataType: 'json',
    beforeSend: function () {
      $('#page-loading').show();
    },
    success: function (data) {
      $('#page-loading').hide();
      let cekasessment = data.cek_asessment;
      let cekrekam = data.cek_rekam;
      let kegiatan = data.data_kegiatan_asessment;
      let konseling = data.data_kegiatan_rekam;
      let dataasessment = data.data_asessment[0];
      let alldataasessment = data.data_asessment;
      let alldatarekam = data.data_rekam;
      let datarekam = data.data_rekam[0];
      let html_psikotest = '';
      let html_hasilakhir = '';

      var html_form_hasil_akhir = '';
      let html_urut_asessment = '';
      let html_urut_rekam = '';

      if (!cekasessment) {
        $('#data_asessment').html('');
      } else {
        /* data pasien*/
        $('input[name="id"]').val(dataasessment.id_pasien);
        $('input[name="jenis_kelamin"]').val(dataasessment.jk);
        $('input[name="no_rkm_medis"]').val(dataasessment.no_rekam_medis);
        $('input[name="usia"]').val(dataasessment.usia);
        $('input[name="nama_lengkap"]').val(dataasessment.nm_lengkap);
        $('input[name="pekerjaan"]').val(dataasessment.pekerjaan);

        /* data asessment*/
        for (let i = 0; i < alldataasessment.length; i++) {
          html_urut_asessment += '<option value="' + alldataasessment[i].id_assesment + '">' + alldataasessment[i].no_urut_assesment + ', ' + alldataasessment[i].tgl_assesment + '</option>';
        }

        console.log(alldataasessment);
        $('#urut_assesment').html(html_urut_asessment);


        $('input[name="id_menindak"]').val(dataasessment.id_menindak);
        $('input[name="id_assesment"]').val(id_asessment);
        $('input[name="tgl_assesment"]').val(dataasessment.tgl_assesment);
        $('textarea[name="info_konseling"]').val(kegiatan);
        $('textarea[name="keluhan"]').val(dataasessment.keluhan);
        $('input[name="riwayat_penyakit"]').val(dataasessment.riwayat_penyakit);
        $('input[name="pengobatan"]').val(dataasessment.pengobatan);
        $('textarea[name="wawancara_psikologis"]').val(dataasessment.wawancara_psikologis);
        $('select[name="psikotest"]').val(dataasessment.psikotest).trigger('change');
        $('select[name="diagnosa"]').val(dataasessment.diagnosa).trigger('change');
        $('input[name="diagnosa_penyerta"]').val(dataasessment.diagnosa_penyerta);
        $('select[name="diagnosa_khusus"]').val(dataasessment.diagnosa_khusus).trigger('change');
        $('select[name="tindakan"]').val(dataasessment.tindakan).trigger('change');

        if (dataasessment.psikotest != '') {
          html_psikotest = "<div class='form-group'>";
          html_psikotest += "<label>Hasil Psikotes</label><br>";
          html_psikotest += "<textarea class='form-control rounded-0' id='hasil_psikotest' name='hasil_psikotest' value='" + dataasessment.hasil_psikotes + "' rows='5'></textarea>";
          html_psikotest += "</div>";
        }

        $("#set_hasil_psikotest").html(html_psikotest);

      }

      if (!cekrekam) {
        $('#data_rekam').html('');
      } else {
        /* data rekammedis*/

        for (let i = 0; i < alldatarekam.length; i++) {
          html_urut_rekam += '<option value="' + alldatarekam[i].id_rekam + '">' + alldatarekam[i].no_urut_rekam + ', ' + alldatarekam[i].tgl_rekam + '</option>';
        }

        console.log(alldatarekam);
        $('#urut_rekam').html(html_urut_rekam);


        $('input[name="id_rekam"]').val(datarekam.id_rekam);
        $('input[name="tgl_rekam"]').val(datarekam.tgl_rekam);
        $('textarea[name="keg_konseling"]').val(konseling);
        $('textarea[name="jns_terapi"]').val(datarekam.jns_terapi);
        $('textarea[name="kesimpulan"]').val(datarekam.kesimpulan);

        if (datarekam.hasil_akhir == 'Selesai') {
          html_form_hasil_akhir = '<option value="">--Pilih--</option>';
          // html_form_hasil_akhir += '<option value="Konseling Lanjutan">Konseling Lanjutan</option>';
          html_form_hasil_akhir += '<option value="Rujukan ke Dokter / Dokter Spesialis">Rujukan ke Dokter / Dokter Spesialis</option>';
          html_form_hasil_akhir += '<option value="Selesai" selected="selected">Selesai</option>';
          $('select[name="hasil_akhir"]').html(html_form_hasil_akhir);

        } else {
          html_form_hasil_akhir = '<option selected="selected" value="">--Pilih--</option>';
          html_form_hasil_akhir += '<option value="Konseling Lanjutan">Konseling Lanjutan</option>';
          html_form_hasil_akhir += '<option value="Rujukan ke Dokter / Dokter Spesialis">Rujukan ke Dokter / Dokter Spesialis</option>';
          html_form_hasil_akhir += '<option value="Selesai">Selesai</option>';
          $('select[name="hasil_akhir"]').html(html_form_hasil_akhir);
          $('select[name="hasil_akhir"]').val(datarekam.hasil_akhir).trigger('change');
        }

        // $('#id_hasil_akhir').html(html_form_hasil_akhir);

        if (datarekam.hasil_akhir == "Rujukan ke Dokter / Dokter Spesialis") {
          html_hasilakhir = "<div class='form-group'>";
          html_hasilakhir += "<label>Catatan</label>";
          html_hasilakhir += "<textarea class='form-control rounded-0' id='catt_akhir' name='catt_akhir' value='" + datarekam.catatan + "' rows='5'></textarea>";
          html_hasilakhir += "</div>";
        }

        console.log(html_form_hasil_akhir);

        $("#set_hasilakhirCatatan").html(html_hasilakhir);
      }

      $('#modal-ubah-asessment').modal('show');
    }
  });
}

/*
 * ubah asessment ajax
 */

/*
 * pilih urut bagian admin ubah pasien indvidu 
 */

//  start pilih urut assesment 
function geturutassesment(base_url, id_assesment) {
  let id_pasien = $('input[name="id"]').val();
  // console.log(id_assesment);
  // console.log(id_pasien);
  $.ajax({
    type: 'post',
    data: {
      id_pasien: id_pasien,
      id_assesment: id_assesment,
    },
    url: base_url + 'admin/ubah_urut_asessment',
    async: true,
    dataType: 'json',
    beforeSend: function () {
      $('#page-loading').show();
    },
    success: function (arrayData) {
      $('#page-loading').hide();
      // console.log(arrayData);
      let data = arrayData[0];
      $('input[name="id_assesment"]').val(id_assesment);
      $('input[name="tgl_assesment"]').val(data.tgl_assesment);
      $('textarea[name="keluhan"]').val(data.keluhan);
      $('input[name="riwayat_penyakit"]').val(data.riwayat_penyakit);
      $('input[name="pengobatan"]').val(data.pengobatan);
      $('textarea[name="wawancara_psikologis"]').val(data.wawancara_psikologis);
      $('select[name="psikotest"]').val(data.psikotest).trigger('change');
      $('select[name="diagnosa"]').val(data.diagnosa).trigger('change');
      $('input[name="diagnosa_penyerta"]').val(data.diagnosa_penyerta);
      $('select[name="diagnosa_khusus"]').val(data.diagnosa_khusus).trigger('change');
      $('select[name="tindakan"]').val(data.tindakan).trigger('change');
    }
  });

}
//end pilih urut assesment 

//  start pilih urut rekam medis

function geturutrekam(base_url, id_rekam) {

  let id_pasien = $('input[name="id"]').val();
  // console.log(id_rekam);
  // console.log(id_pasien);
  $.ajax({
    type: 'post',
    data: {
      id_pasien: id_pasien,
      id_rekam: id_rekam,
    },
    url: base_url + 'admin/ubah_urut_rekam',
    async: true,
    dataType: 'json',
    beforeSend: function () {
      $('#page-loading').show();
    },
    success: function (arrayData) {
      $('#page-loading').hide();
      // console.log(arrayData);
      let data = arrayData[0];
      $('input[name="id_rekam"]').val(data.id_rekam);
      $('input[name="tgl_rekam"]').val(data.tgl_rekam);
      $('textarea[name="jns_terapi"]').val(data.jns_terapi);
      $('textarea[name="kesimpulan"]').val(data.kesimpulan);
      if (data.hasil_akhir == 'Selesai') {
        html_form_hasil_akhir = '<option value="">--Pilih--</option>';
        // html_form_hasil_akhir += '<option value="Konseling Lanjutan">Konseling Lanjutan</option>';
        html_form_hasil_akhir += '<option value="Rujukan ke Dokter / Dokter Spesialis">Rujukan ke Dokter / Dokter Spesialis</option>';
        html_form_hasil_akhir += '<option value="Selesai" selected="selected">Selesai</option>';
        $('select[name="hasil_akhir"]').html(html_form_hasil_akhir);

      } else {
        html_form_hasil_akhir = '<option selected="selected" value="">--Pilih--</option>';
        html_form_hasil_akhir += '<option value="Konseling Lanjutan">Konseling Lanjutan</option>';
        html_form_hasil_akhir += '<option value="Rujukan ke Dokter / Dokter Spesialis">Rujukan ke Dokter / Dokter Spesialis</option>';
        html_form_hasil_akhir += '<option value="Selesai">Selesai</option>';
        $('select[name="hasil_akhir"]').html(html_form_hasil_akhir);
        $('select[name="hasil_akhir"]').val(data.hasil_akhir).trigger('change');
      }

    }
  });
}
//end pilih urut rekam medis

$('#form-ubah-asessment').submit(function (e) {
  e.preventDefault();
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  const form_ubah_asessment = $(this);
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
          title: 'Data asessment  ' + text + ' diubah'
        });

        window.location.reload();

      } else {
        let key_post = ["id", "jenis_kelamin", "no_rkm_medis", "usia", "nama_lengkap", "pekerjaan", "psikotest", "diagnosa", "diagnosa_khusus", "diagnosa_penyerta"];
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
 * akhir ubah asessment ajax
 * -------------------------------------------------------------------------
 */

function view_lihatTor_admin(base_url, value) {
  var html_rab = '';

  $.ajax({
    type: 'post',
    data: {
      id_tor: value
    },
    url: base_url + 'admin/getTor',
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
        html_rab = '<div class="form-group">';
        html_rab += '<label>File RAB</label>';
        html_rab += '<embed src= "' + base_url + '/assets/dokumen/tor/' + data_tor.rab + '" type="application/pdf" width="100%" height="600px" />';
        html_rab += '</div>';
        $('#html_lht_filerab').html(html_rab);
      } else {
        $('#html_lht_filerab').html(html_rab);
      }
      $("button[name='prosesTor']").attr('kode-tor', data_tor.kode_tor);
      $('#modal-lihat-tor').modal('show');
    }
  });
}

function prosesTor(base_url, value) {
  var kode_tor = $("button[name='prosesTor']").attr('kode-tor');
  var cat_rev = $('textarea[name="lht_catatan_revisi"]').val();

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  $.ajax({
    type: 'post',
    data: {
      kode_tor: kode_tor,
      role_tor: value,
      cat_rev: cat_rev
    },
    url: base_url + 'admin/prosesTor',
    async: true,
    dataType: 'json',
    beforeSend: function () {
      $('#page-loading').show();
    },
    success: function (data) {
      $('#page-loading').hide();
      if (data.pesan == "success") {

        $('#modal-lihat-tor').modal('hide');
        Toast.fire({
          type: data.pesan,
          title: ' Data proses TOR berhasil diubah'
        });

        window.location.reload();

      } else {

        Toast.fire({
          type: data.pesan,
          title: ' Data proses TOR gagal diubah'
        });
      }
    }
  });
}

function getlaporankasus_bulan(url, bulan, tahun) {

  // $("#laporanbulanviewmodal").dataTable().fnDestroy();
  var ctxtindakan = null;
  var ctxjk = null;
  var tindakanChart = null;
  var jkChart = null;
  var datalaporankasusChartjk = null;
  var datalaporankasusCharttindakan = null;

  ctxtindakan = document.getElementById('charttindakan_laporankasusbln').getContext('2d');
  ctxjk = document.getElementById('chartjk_laporankasus_bln').getContext('2d');
  datalaporankasusChartjk = {
    type: 'doughnut',
    data: {
      labels: [],
      datasets: [{
        data: [],
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
      }
    }
  }

  datalaporankasusCharttindakan = {
    type: 'doughnut',
    data: {
      labels: [],
      datasets: [{
        data: [],
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
      }
    }
  }

  $.ajax({
    type: 'post',
    data: {
      bulan: bulan,
      tahun: tahun
    },
    url: url + 'admin/getlaporanbulananadmin',
    async: true,
    dataType: 'json',
    beforeSend: function () {
      $('#page-loading').show();
    },
    success: function (data) {
      $('#page-loading').hide();
      $("input[name='nama_bulan']").val(data.nm_bulan);
      $("#datapasien_laporanbulan").html(data.data_bulan);
      $("#link_cetak_bulan").attr('href', 'coba_href');

      datalaporankasusChartjk.data.datasets[0].data = data.chartjk;
      datalaporankasusChartjk.data.labels[0] = "Laki-Laki (" + data.chartjk[0] + ")";
      datalaporankasusChartjk.data.labels[1] = "Perempuan (" + data.chartjk[1] + ")";
      datalaporankasusChartjk.data.labels[2] = "Transeksual (" + data.chartjk[2] + ")";
      datalaporankasusChartjk.data.labels[3] = "Tidak diketahui (" + data.chartjk[3] + ")";
      datalaporankasusChartjk.data.labels[4] = "Tidak menentukan (" + data.chartjk[4] + ")";

      datalaporankasusCharttindakan.data.datasets[0].data = data.charttindakan;
      datalaporankasusCharttindakan.data.labels[0] = "Konseling Individu (" + data.charttindakan[0] + ")";
      datalaporankasusCharttindakan.data.labels[1] = "Konseling Kelompok (" + data.charttindakan[1] + ")";
      datalaporankasusCharttindakan.data.labels[2] = "Rujukan Psikolog (" + data.charttindakan[2] + ")";
      datalaporankasusCharttindakan.data.labels[3] = "Rujuk Ke Dokter (" + data.charttindakan[3] + ")";

      jkChart = new Chart(ctxjk, datalaporankasusChartjk);
      tindakanChart = new Chart(ctxtindakan, datalaporankasusCharttindakan);

      $('#modal-laporankasus-bulan').modal('show');
    }
  });

}

function getlaporankasus_tahun(url, tahun) {
  var table = $('#laporantahunviewmodal').DataTable();

  var tindakanChartthn;
  var jkChartthn;
  var ctxtindakanthn = document.getElementById('charttindakan_laporankasusthn').getContext('2d');
  var ctxjkthn = document.getElementById('chartjk_laporankasus_thn').getContext('2d');

  var datalaporankasusChartjkthn = {
    type: 'doughnut',
    data: {
      labels: [],
      datasets: [{
        data: [],
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
      }
    }
  }

  var datalaporankasusCharttindakanthn = {
    type: 'doughnut',
    data: {
      labels: [],
      datasets: [{
        data: [],
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
      }
    }
  }

  $.ajax({
    type: 'post',
    data: {
      tahun: tahun
    },
    url: url + 'admin/getlaporankasus_tahunadmin',
    dataType: 'json',
    beforeSend: function () {
      $('#page-loading').show();
    },
    success: function (data) {
      $('#page-loading').hide();
      var html = '';
      var data_tahunan = data.data_tahun;

      for (var i = 0; i < data_tahunan.length; i++) {
        html += '<tr>';
        html += '<td>' + (i + 1) + '</td>';
        html += '<td>' + data_tahunan[i]['nm_lengkap'] + '</td>';
        html += '<td>' + data_tahunan[i]['usia'] + '</td>';
        html += '<td>' + data_tahunan[i]['jk'] + '</td>';
        html += '<td>' + data_tahunan[i]['diagnosa'] + '</td>';
        html += '<td>' + data_tahunan[i]['tindakan'] + '</td>';
        html += '</tr>';
      }

      $("input[name='nama_tahun']").val(data.nm_tahun);
      $("#datapasien_laporantahun").html(html);
      // table.draw();

      datalaporankasusChartjkthn.data.datasets[0].data = data.chartjkthn;
      datalaporankasusChartjkthn.data.labels[0] = "Laki-Laki (" + data.chartjkthn[0] + ")";
      datalaporankasusChartjkthn.data.labels[1] = "Perempuan (" + data.chartjkthn[1] + ")";
      datalaporankasusChartjkthn.data.labels[2] = "Transeksual (" + data.chartjkthn[2] + ")";
      datalaporankasusChartjkthn.data.labels[3] = "Tidak diketahui (" + data.chartjkthn[3] + ")";
      datalaporankasusChartjkthn.data.labels[4] = "Tidak menentukan (" + data.chartjkthn[4] + ")";

      datalaporankasusCharttindakanthn.data.datasets[0].data = data.charttindakanthn;
      datalaporankasusCharttindakanthn.data.labels[0] = "Konseling Individu (" + data.charttindakanthn[0] + ")";
      datalaporankasusCharttindakanthn.data.labels[1] = "Konseling Kelompok (" + data.charttindakanthn[1] + ")";
      datalaporankasusCharttindakanthn.data.labels[2] = "Rujukan Psikolog (" + data.charttindakanthn[2] + ")";
      datalaporankasusCharttindakanthn.data.labels[3] = "Rujuk Ke Dokter (" + data.charttindakanthn[3] + ")";

      jkChartthn = new Chart(ctxjkthn, datalaporankasusChartjkthn);
      tindakanChartthn = new Chart(ctxtindakanthn, datalaporankasusCharttindakanthn);

      $('#modal-laporankasus-tahun').modal('show');
    }
  });

}


// start grafik

function grafikrujukan_Psikolog(url) {
  var cekidChartpsikolog = document.getElementById("chartpsikolog");
  if (cekidChartpsikolog != null) {

    var urlpsikolog = url + "admin/getGrafikpsikolog_rujuk";
    var ctx = document.getElementById("chartpsikolog").getContext('2d');

    var optionpsikologChart = {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          data: [],
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          pointBorderColor: '#007bff',
          pointBackgroundColor: '#007bff',
          fill: false
        }]
      },
      options: {
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            }
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            }
          }]
        }
      }
    }

    $.getJSON(urlpsikolog, function (data) {
      optionpsikologChart.data.datasets[0].data = data;
      optionpsikologChart.data.labels[0] = "Kader (" + data[0] + ")";
      var psikologChart = new Chart(ctx, optionpsikologChart);
    });
  }
}

function grafikrujukan_Dokter(url) {
  var cekidChartdokter = document.getElementById("chartdokter");
  if (cekidChartdokter != null) {

    var urlpsikolog = url + "admin/getGrafikdokter_rujuk";
    var ctx = document.getElementById("chartdokter").getContext('2d');

    var optiondokterChart = {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          data: [],
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          pointBorderColor: '#007bff',
          pointBackgroundColor: '#007bff',
          fill: false
        }]
      },
      options: {
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            }
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            }
          }]
        }
      }
    }

    $.getJSON(urlpsikolog, function (data) {
      optiondokterChart.data.datasets[0].data = data;
      optiondokterChart.data.labels[0] = "Kader (" + data[0] + ")";
      optiondokterChart.data.labels[1] = "Psikolog (" + data[1] + ")";
      var dokterChart = new Chart(ctx, optiondokterChart);
    });
  }
}