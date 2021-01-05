<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tentang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url($this->session->userdata('dashboard')) ?>">Home</a></li>
                        <li class="breadcrumb-item active">Tentang</li>
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
                <h3 class="card-title">Tentang Aplikasi</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table>
                    <!-- <thead>
                        <tr>
                            <th scope="col">Nama Aplikasi Website</th>
                            <th scope="col">Versi</th>
                            <th scope="col">Hak Cipta</th>
                            <th scope="col">Nama Pengembang</th>
                            <th scope="col">Tujuan Pengembang</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <!-- <tr>
                            <th scope="row">Nama Aplikasi Website</th>
                            <th scope="row">Versi</th>
                        </tr> -->

                        <tr>
                            <th scope="row" width="15%">Nama Aplikasi Website</th>
                            <th scope="row" width="6%">Versi</th>
                            <th scope="row" width="6%">Hak Cipta</th>
                            <th scope="row" width="6%">Nama Pengembang</th>
                        </tr>
                        <tr>
                            <td scope="row">SIKESWA(SISTEM INFORMASI KESEHATAN JIWA)</td>
                            <td>1.0.0 </td>
                            <td><?= date('Y') ?> SIKESWA</td>
                            <td><a href="http://www.rantaucoding.com/">Rantau Coding</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->