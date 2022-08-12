<div class="main-content">

    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18"><?= $title; ?></h4>

                    <div class="page-title-right">
                        <?= $breadcrumbs; ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <?php $this->view('session'); ?>
                    <?php
                    $data_error = [];
                    if (validation_errors()) {
                        $nama_admin = (form_error('nama_admin'));
                        $username_admin = (form_error('username_admin'));
                        $password_admin = (form_error('password_admin'));
                        $telepon_admin = (form_error('telepon_admin'));
                        $alamat_admin = (form_error('alamat_admin'));

                        if ($nama_admin != null) {
                            $data_error['error']['nama_admin'] = $nama_admin;
                        }
                        if ($username_admin != null) {
                            $data_error['error']['username_admin'] = $username_admin;
                        }
                        if ($password_admin != null) {
                            $data_error['error']['password_admin'] = $password_admin;
                        }
                        if ($telepon_admin != null) {
                            $data_error['error']['telepon_admin'] = $telepon_admin;
                        }
                        if ($alamat_admin != null) {
                            $data_error['error']['alamat_admin'] = $alamat_admin;
                        }

                        $error = $data_error['error'];
                        if (count($error) > 0) {
                            foreach ($error as $index => $value) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Fail! </strong> ' . $value . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                            }
                        }
                    }
                    ?>
                    <div class="card-body">
                        <form action="<?= base_url('Admin/Profile/process') ?>" method="post" class="form-submit" enctype="multipart/form-data">
                            <input type="hidden" name="page" value="edit">
                            <input type="hidden" name="password_admin_old" value="<?= $result->password_admin; ?>">
                            <input type="hidden" name="id_admin" value="<?= $result->id_admin; ?>">

                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama_admin" placeholder="Nama..." class="form-control" value="<?= $result->nama_admin; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username_admin" placeholder="Username..." class="form-control" value="<?= $result->username_admin; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password_admin" placeholder="Password..." class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirm_password_admin" placeholder="Confirm Password..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" name="gambar_admin" class="form-control">
                                <span id="load_gambar_admin">
                                    <img src="<?= base_url('public/image/admin/' . $result->gambar_admin) ?>" width="25%;" class="img-thumbnail" alt="">
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="number" name="telepon_admin" class="form-control" placeholder="Telepon" value="<?= $result->telepon_admin; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea class="form-control alamat_admin" placeholder="Alamat" name="alamat_admin">
                                <?= $result->alamat_admin; ?>
                        </textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-redo"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary btn-submit"> <i class="fas fa-save"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
</div>
<!-- End Page-content -->

<?= $footer; ?>
</div>

<script src="<?= base_url('Qovex_v1.0.0/Admin/Vertical/dist/') ?>assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var pane = $('.alamat_admin');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));
    })
</script>