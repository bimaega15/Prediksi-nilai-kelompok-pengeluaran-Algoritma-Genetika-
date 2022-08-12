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
                        <a data-toggle="modal" data-target="#modalForm" href="<?= base_url('Admin/Inisialisasi/add') ?>" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Data Latih</th>
                                        <th>Data Uji</th>
                                        <th>Spread latih</th>
                                        <th>Spread uji</th>
                                        <th>Crossover</th>
                                        <th>Mutasi</th>
                                        <th>Populasi</th>
                                        <th>Generasi</th>
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
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormInisialisasi" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormInisialisasi"> Form Inisialisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/Inisialisasi/process') ?>" method="post" class="form-submit">
                <input type="hidden" name="page" value="">
                <input type="hidden" name="id_inisialisasi" value="">
                <input type="hidden" name="uji_inisialisasi" value="">
                <div class="modal-body">
                    <div id="error_modal"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Data latih</label>
                                <select name="latih_inisialisasi" class="form-control latih_inisialisasi" id="">
                                    <option value="">-- Latih Inisialisasi --</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Data Uji</label>
                                <p class="uji_inisialisasi">Menunggu pemilihan data latih ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Spread Latih</label>
                                <input type="number" class="form-control" placeholder="Spread Latih" name="spread_inisialisasi_latih" placeholder="Spread latih...">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Spread Uji</label>
                                <input type="number" class="form-control" placeholder="Spread Uji" name="spread_inisialisasi_uji" placeholder="Spread uji...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Crossover</label>
                                <input type="number" class="form-control" placeholder="Cross over" name="crossover_inisialisasi" placeholder="Cross over..." step="any">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Mutasi</label>
                                <input type="number" class="form-control" placeholder="Mutasi" name="mutasi_inisialisasi" placeholder="Mutasi..." step="any">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Populasi</label>
                        <input type="number" class="form-control" placeholder="Populasi" name="populasi_inisialisasi" placeholder="Populasi..." step="any">
                    </div>
                    <div class="form-group">
                        <label for="">Generasi</label>
                        <input type="number" class="form-control" placeholder="Populasi" name="generasi_inisialisasi" placeholder="Generasi..." step="any">
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
<script src="<?= base_url('Qovex_v1.0.0/Admin/Vertical/dist/') ?>assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "ajax": "<?= base_url('Admin/Inisialisasi/loadData') ?>",
        });

        $(document).on('change', '.latih_inisialisasi', function() {
            let val = $(this).val();
            let persen = 100;
            let uji = persen - val;
            $('.uji_inisialisasi').html(`Jumlah Data uji: ${uji}%`);
            $('input[name="uji_inisialisasi"]').val(uji);
        })

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            $('.form-submit')[0].reset();
            resetForm();
            $('input[name="page"]').val('add');
        })

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            const id_inisialisasi = $(this).data('id_inisialisasi');
            $.ajax({
                url: '<?= base_url('Admin/Inisialisasi/edit/') ?>' + id_inisialisasi,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    const {
                        row
                    } = data;

                    $('input[name="id_inisialisasi"]').val(row.id_inisialisasi);
                    $('select[name="latih_inisialisasi"]').val(row.latih_inisialisasi);
                    $('input[name="uji_inisialisasi"]').val(row.uji_inisialisasi);
                    $('.uji_inisialisasi').html(`Jumlah Data uji: ${row.uji_inisialisasi}%`);
                    $('input[name="spread_inisialisasi_latih"]').val(row.spread_inisialisasi_latih);
                    $('input[name="spread_inisialisasi_uji"]').val(row.spread_inisialisasi_uji);
                    $('input[name="crossover_inisialisasi"]').val(row.crossover_inisialisasi);
                    $('input[name="mutasi_inisialisasi"]').val(row.mutasi_inisialisasi);
                    $('input[name="populasi_inisialisasi"]').val(row.populasi_inisialisasi);
                    $('input[name="generasi_inisialisasi"]').val(row.generasi_inisialisasi);

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
                url: '<?= base_url('Admin/Inisialisasi/process') ?>',
                type: "POST",
                data: data,
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
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
            const id_inisialisasi = $(this).data("id_inisialisasi");
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
                        url: "<?= base_url('Admin/Inisialisasi/delete') ?>",
                        dataType: 'json',
                        type: 'post',
                        data: {
                            id_inisialisasi
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