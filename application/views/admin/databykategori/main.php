<?php $profile = check_profile(); ?>
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
                    <div class="card-body">
                        <a data-toggle="modal" data-target="#modalForm" href="<?= base_url('Admin/DataByKategori/add') ?>" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                        <a data-toggle="modal" data-target="#modalFormImport" class="btn btn-success text-white"><i class="fas fa-file-excel"></i> Import Excel</a>
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                        <th class="text-center" width="20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
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

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormDataByKategori" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormDataByKategori"> Form DataByKategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/DataByKategori/process') ?>" method="post" class="form-submit">
                <input type="hidden" name="page" value="">
                <input type="hidden" name="id_databykategori" value="">
                <input type="hidden" name="kategori_id" value="<?= $this->input->get('kategori_id', true) ?>">
                <div class="modal-body">
                    <div id="error_modal"></div>

                    <div class="form-group">
                        <label for="" class="text-capitalize">tahun</label>
                        <input type="text" name="tahun" placeholder="Tahun..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">Januari</label>
                        <input type="number" step="any" name="januari" placeholder="Januari..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">februari</label>
                        <input type="number" step="any" name="februari" placeholder="feburari..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">maret</label>
                        <input type="number" step="any" name="maret" placeholder="maret..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">april</label>
                        <input type="number" step="any" name="april" placeholder="april..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">mei</label>
                        <input type="number" step="any" name="mei" placeholder="mei..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">juni</label>
                        <input type="number" step="any" name="juni" placeholder="juni..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">juli</label>
                        <input type="number" step="any" name="juli" placeholder="juli..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">agustus</label>
                        <input type="number" step="any" name="agustus" placeholder="agustus..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">september</label>
                        <input type="number" step="any" name="september" placeholder="september..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">oktober</label>
                        <input type="number" step="any" name="oktober" placeholder="oktober..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">november</label>
                        <input type="number" step="any" name="november" placeholder="november..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-capitalize">desember</label>
                        <input type="number" step="any" name="desember" placeholder="desember..." class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-redo"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary btn-submit"> <i class="fas fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFormImport" tabindex="-1" aria-labelledby="modalFormImportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormImportLabel"> Form Import</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/DataByKategori/import') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="page" value="">
                <input type="hidden" name="kategori_id" value="<?= $this->input->get('kategori_id', true) ?>">
                <div class="modal-body">
                    <div id="error_modal"></div>
                    <div class="form-group">
                        <label for="">Import Excel</label>
                        <input type="file" name="import" class="form-control" placeholder="Import excel" required accept=".xls, .xlsx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-redo"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('Qovex_v1.0.0/Admin/Vertical/dist/') ?>assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "ajax": {
                url: "<?= base_url('Admin/DataByKategori/loadData') ?>",
                type: 'get',
                dataType: 'json',
                data: {
                    kategori_id: '<?= $kategori_id ?>'
                }
            },
        });

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            $('.form-submit')[0].reset();
            resetForm();
            $('input[name="page"]').val('add');
        })

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            const id_databykategori = $(this).data('id_databykategori');
            $.ajax({
                url: '<?= base_url('Admin/DataByKategori/edit/') ?>' + id_databykategori,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    const {
                        row
                    } = data;

                    $('input[name="id_databykategori"]').val(row.id_databykategori);
                    $('input[name="tahun"]').val(row.tahun);
                    $('input[name="januari"]').val(row.januari);
                    $('input[name="februari"]').val(row.februari);
                    $('input[name="maret"]').val(row.maret);
                    $('input[name="april"]').val(row.april);
                    $('input[name="mei"]').val(row.mei);
                    $('input[name="juni"]').val(row.juni);
                    $('input[name="juli"]').val(row.juli);
                    $('input[name="agustus"]').val(row.agustus);
                    $('input[name="september"]').val(row.september);
                    $('input[name="oktober"]').val(row.oktober);
                    $('input[name="november"]').val(row.november);
                    $('input[name="desember"]').val(row.desember);

                    $('#modalForm').modal().show();
                    $('input[name="page"]').val('edit');
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        })

        function resetForm() {
            $('#error_modal').html('');
            $('.form-submit').trigger("reset");
        }
        $(document).on('click', '.btn-submit', function(e) {
            e.preventDefault();
            var form = $('.form-submit')[0];
            var data = new FormData(form);
            $.ajax({
                url: '<?= base_url('Admin/DataByKategori/process') ?>',
                type: "POST",
                data: data,
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'error') {
                        var output = ``;
                        $.each(data.output, function(index, value) {
                            output += `
                            <div class="alert alert-danger alert-dismissible fade show mb-1" role="alert">
                                <strong>Fail!</strong>${value}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            `;
                        })
                        $('#error_modal').html(output);
                    }

                    if (data.status_db == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: data.output,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalForm').modal('hide');
                        table.ajax.reload();
                        resetForm();
                        $('#modalForm').modal('hide');
                    }

                    if (data.status_db == 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: data.output,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalForm').modal('hide');
                        table.ajax.reload();
                    }
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            });
        })
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const id_databykategori = $(this).data("id_databykategori");
            Swal.fire({
                title: 'Deleted',
                text: "Yakin ingin menghapus item ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('Admin/DataByKategori/delete') ?>",
                        dataType: 'json',
                        type: 'post',
                        data: {
                            id_databykategori
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    data.msg,
                                    'success'
                                );
                                table.ajax.reload();

                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    data.msg,
                                    'success'
                                )
                            }

                        },
                        error: function(x, t, m) {
                            console.log(x.responseText);
                        }
                    })
                }
            })
        })
    })
</script>