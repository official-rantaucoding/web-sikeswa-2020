<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bantuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url($this->session->userdata('dashboard')) ?>">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) { ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">>> Menu Admin (MODUL) </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="https://1drv.ms/u/s!AkWZPQ_pILvGas5PSUgTYRHNLn4?e=zGcqQW"> MODUL ADMIN KLIK DOWNLOAD FILE</a>
                </div>
            </div>

        <?php }
        if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3 || $this->session->userdata('level') == 4 || $this->session->userdata('level') == 5) { ?>
            <!-- /.card -->
            <!-- Default box -->
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">>> Menu User PSIKOLOG & KADER (MODUL)</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="#"> MODUL PSIKOLOG & KADER KLIK DOWNLOAD FILE</a>
                </div>
            </div>

        <?php }
        if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 6) { ?>
            <!-- /.card -->
            <!-- Default box -->
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">>> Menu User Field Officer (Modul)</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="https://1drv.ms/u/s!AkWZPQ_pILvGa8VKniv5VyeLMVc?e=G7oC2k"> MODUL FIELD OFFICER KLIK DOWNLOAD FILE</a>
                </div>
            </div>
            <!-- /.card -->

        <?php }
        if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 7) { ?>
            <!-- Default box -->
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">>> User Umum</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    Sementara dalam proses pembuatan
                </div>
            </div>
            <!-- /.card -->
        <?php } ?>
        <!-- Default box -->
        <!-- <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">>> Lainnya</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4 html_menu">
                        <li class="dropdown">
                            <a href="#">Mengubah Foto dan Nama Lengkap</a>
                        </li>
                        <li class="dropdown">
                            <a href="#">Mangubah Username dan Password</a>
                        </li>
                    </div>
                    <div class="col-sm-12 col-md-8 html_penjelasan">
                        Sementara dalam proses pembuatan.
                    </div>
                </div>
            </div>
        </div>
        /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->