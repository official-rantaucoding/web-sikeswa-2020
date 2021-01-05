<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                <h3 class="card-title"><i class="nav-icon fas fa-palette"></i> Pilih Tema Warna</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td width="100%"><label>Pilih Tema Headerbar</label></td>

                                </tr>
                                <tr>
                                    <td width="100%">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="d-flex">
                                                    <div class="d-flex flex-wrap mb-3">
                                                        <div class="bg-primary elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-primary','bg-primary')"></div>
                                                        <div class="bg-secondary elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-secondary','bg-secondary')"></div>
                                                        <div class="bg-info elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-info','bg-info')"></div>
                                                        <div class="bg-success elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-success','bg-success')"></div>
                                                        <div class="bg-danger elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-danger','bg-danger')"></div>
                                                        <div class="bg-indigo elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-indigo','bg-indigo')"></div>
                                                        <div class="bg-purple elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-purple','bg-purple')"></div>
                                                        <div class="bg-pink elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-pink','bg-pink')"></div>
                                                        <div class="bg-teal elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-teal','bg-teal')"></div>
                                                        <div class="bg-cyan elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-cyan','bg-cyan')"></div>
                                                        <div class="bg-dark elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark','bg-dark')"></div>
                                                        <div class="bg-gray-dark elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-gray-dark','bg-gray-dark')"></div>
                                                        <div class="bg-gray elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-dark navbar-gray','bg-gray')"></div>
                                                        <div class="bg-light elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-light','bg-light')"></div>
                                                        <div class="bg-warning elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-light navbar-warning','bg-warning')"></div>
                                                        <div class="bg-white elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-light navbar-white','bg-white')"></div>
                                                        <div class="bg-orange elevation-2 tema" onclick="tema_header('<?= base_url() ?>','navbar-light navbar-orange','bg-orange')"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%"><label>Pilih Tema Dark Sidebar</label></td>

                                </tr>
                                <tr>
                                    <td width="100%">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="d-flex">
                                                    <div class="d-flex flex-wrap mb-3">
                                                        <div class="bg-primary elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-primary')">
                                                        </div>
                                                        <div class="bg-warning elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-warning')">
                                                        </div>
                                                        <div class="bg-info elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-info')">
                                                        </div>
                                                        <div class="bg-danger elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-danger')">
                                                        </div>
                                                        <div class="bg-success elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-success')">
                                                        </div>
                                                        <div class="bg-indigo elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-indigo')">
                                                        </div>
                                                        <div class="bg-navy elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-navy')">
                                                        </div>
                                                        <div class="bg-purple elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-purple')">
                                                        </div>
                                                        <div class="bg-fuchsia elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-fuchsia')">
                                                        </div>
                                                        <div class="bg-pink elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-pink')">
                                                        </div>
                                                        <div class="bg-maroon elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-maroon')">
                                                        </div>
                                                        <div class="bg-orange elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-orange')">
                                                        </div>
                                                        <div class="bg-lime elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-lime')">
                                                        </div>
                                                        <div class="bg-teal elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-teal')">
                                                        </div>
                                                        <div class="bg-olive elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-dark-olive')">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%"><label>Pilih Tema Light Sidebar</label></td>

                                </tr>
                                <tr>
                                    <td width="100%">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="d-flex">
                                                    <div class="d-flex flex-wrap mb-3">
                                                        <div class="bg-primary elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-primary')">
                                                        </div>
                                                        <div class="bg-warning elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-warning')">
                                                        </div>
                                                        <div class="bg-info elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-info')">
                                                        </div>
                                                        <div class="bg-danger elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-danger')">
                                                        </div>
                                                        <div class="bg-success elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-success')">
                                                        </div>
                                                        <div class="bg-indigo elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-indigo')">
                                                        </div>
                                                        <div class="bg-navy elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-navy')">
                                                        </div>
                                                        <div class="bg-purple elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-purple')">
                                                        </div>
                                                        <div class="bg-fuchsia elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-fuchsia')">
                                                        </div>
                                                        <div class="bg-pink elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-pink')">
                                                        </div>
                                                        <div class="bg-maroon elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-maroon')">
                                                        </div>
                                                        <div class="bg-orange elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-orange')">
                                                        </div>
                                                        <div class="bg-lime elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-lime')">
                                                        </div>
                                                        <div class="bg-teal elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-teal')">
                                                        </div>
                                                        <div class="bg-olive elevation-2 tema" onclick="tema_sidebar('<?= base_url() ?>','sidebar-light-olive')">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%"><label>Pilih Tema Brand Logo</label></td>

                                </tr>
                                <tr>
                                    <td width="100%">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="d-flex">
                                                    <div class="d-flex flex-wrap mb-3">
                                                        <div class="bg-primary elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-primary')"></div>
                                                        <div class="bg-secondary elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-secondary')"></div>
                                                        <div class="bg-info elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-info')"></div>
                                                        <div class="bg-success elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-success')"></div>
                                                        <div class="bg-danger elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-danger')"></div>
                                                        <div class="bg-indigo elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-indigo')"></div>
                                                        <div class="bg-purple elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-purple')"></div>
                                                        <div class="bg-pink elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-pink')"></div>
                                                        <div class="bg-teal elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-teal')"></div>
                                                        <div class="bg-cyan elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-cyan')"></div>
                                                        <div class="bg-dark elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-dark')"></div>
                                                        <div class="bg-gray-dark elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-gray-dark')"></div>
                                                        <div class="bg-gray elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-gray')"></div>
                                                        <div class="bg-light elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-light')"></div>
                                                        <div class="bg-warning elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-warning')"></div>
                                                        <div class="bg-white elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-white')"></div>
                                                        <div class="bg-orange elevation-2 tema" onclick="tema_logobar('<?= base_url() ?>','navbar-orange')"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%"><label>Pilih Tema Profile</label></td>

                                </tr>
                                <tr>
                                    <td width="100%">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="d-flex">
                                                    <div class="d-flex flex-wrap mb-3">
                                                        <div class="bg-primary elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-primary')"></div>
                                                        <div class="bg-secondary elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-secondary')"></div>
                                                        <div class="bg-info elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-info')"></div>
                                                        <div class="bg-success elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-success')"></div>
                                                        <div class="bg-danger elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-danger')"></div>
                                                        <div class="bg-indigo elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-indigo')"></div>
                                                        <div class="bg-purple elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-purple')"></div>
                                                        <div class="bg-pink elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-pink')"></div>
                                                        <div class="bg-teal elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-teal')"></div>
                                                        <div class="bg-cyan elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-cyan')"></div>
                                                        <div class="bg-dark elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-dark')"></div>
                                                        <div class="bg-gray-dark elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-gray-dark')"></div>
                                                        <div class="bg-gray elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-gray')"></div>
                                                        <div class="bg-light elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-light')"></div>
                                                        <div class="bg-warning elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-warning')"></div>
                                                        <div class="bg-white elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-white')"></div>
                                                        <div class="bg-orange elevation-2 tema" onclick="tema_profile('<?= base_url() ?>','bg-orange')"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <!-- Footer -->
            </div>
            <!-- /.card-footer-->
        </div>

        <!--  collapsed-card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-cogs"></i> Ganti Logo dan background</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td width="100%">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="customFile">Logo Terpilih</label><br>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img style="width: 90%" src="<?= base_url('assets/image/img_logo/') . $setting[0]['img_logo']; ?>" class="img-circle elevation-1" alt="User Image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <form id="ubah_logo" action="<?= base_url('superadmin/ubah_logo') ?>" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="customFile">Upload Logo</label>
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*" name="photo" class="custom-file-input" id="customFile" required oninvalid="this.setCustomValidity('File logo masih kosong')" oninput="setCustomValidity('')">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah Logo</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <!-- Footer -->
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>

</div>
<!-- /.content-wrapper