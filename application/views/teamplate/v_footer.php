<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- apexcharts -->
<script src="<?= base_url('assets/') ?>plugins/apexcharts/dist/apexcharts.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/') ?>dist/js/demo.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/') ?>plugins/select2/js/select2.full.min.js"></script>
<!-- js user -->
<script src="<?= base_url('assets/') ?>jsuser/js_admin.js"></script>
<script src="<?= base_url('assets/') ?>jsuser/js_superadmin.js"></script>
<script src="<?= base_url('assets/') ?>jsuser/js_user.js"></script>
<script src="<?= base_url('assets/') ?>jsuser/js_other.js"></script>
<script src="<?= base_url('assets/') ?>jsuser/alert.js"></script>
<!-- sweetalert2 -->
<script src="<?= base_url('assets/') ?>jsuser/sweetalert2.js"></script>
<script src="<?= base_url('assets/') ?>jsuser/js_dashboard.js"></script>


<script>
  $(function() {

    var url = "<?= base_url() ?>";
    getData_rujukan(url);
    printkode(url);

    /* ChartJS  
     * -------
     * Here we will create a few charts using ChartJS
     */

    grafik_jk_dashboard(url);
    grafik_pendidikan_dashboard(url);
    grafik_desa_dashboard(url);
    grafik_umur_dashboard(url);
    grafikpetadasboard(url);

    grafikrujukan_Psikolog(url);
    grafikrujukan_Dokter(url);

    //Initialize Select2 Elements
    $('.select2').select2()
    $("#example1").DataTable({
      // 'scrollX': true,
      'aaSorting': [
        [0, "desc"]
      ],
      responsive: true,
      // 'empty': 'Data Kosong'
    });

    $("#laporanbulanviewmodal").DataTable({
      // 'scrollX': true,
      'aaSorting': [
        [0, "desc"]
      ],
      responsive: true,
      // 'empty': 'Data Kosong'
    });
    
    $("#laporantahunviewmodal").DataTable({
      // 'scrollX': true,
      'aaSorting': [
        [0, "desc"]
      ],
      responsive: true,
      // 'empty': 'Data Kosong'
    });

    $("#tabelpasienlama").DataTable({
      'scrollX': true,
      'aaSorting': [
        [0, "desc"]
      ],
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": true,
      responsive: true,
    });

    $("#example2").DataTable({
      'scrollX': true,
      'aaSorting': [
        [0, "desc"]
      ],
      responsive: true,
      // 'empty': 'Data Kosong'
    });

    $("#example3").DataTable({
      'scrollX': true,
      'aaSorting': [
        [0, "desc"]
      ],
      responsive: true,
      // 'empty': 'Data Kosong'
    });

    $("#example6").DataTable({
      // 'scrollX': true,
      'aaSorting': [
        [0, "desc"]
      ],
      responsive: true,
      // 'empty': 'Data Kosong'
    });

    // $("#tgl").datepicker({
    //   dateFormat: "dd/mm/yyyy"
    // });

  })
</script>
</body>

</html>