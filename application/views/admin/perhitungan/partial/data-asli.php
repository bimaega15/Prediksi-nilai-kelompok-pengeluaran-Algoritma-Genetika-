<div class="accordion" id="accordionDataAsli">
    <?php
    foreach ($dataKategori as $id_kategori => $v_tahun) {
        $getKategori = check_kategori_id($id_kategori)->row();
    ?>
        <div class="card">
            <div class="card-header" id="kategori">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori" data-parent="#accordionDataAsli">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-<?= $id_kategori; ?>">
                            <thead>
                                <tr>
                                    <th>Bulan/Tahun</th>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($v_tahun as $nama_tahun => $value) { ?>
                                    <tr>
                                        <td><?= $nama_tahun; ?></td>
                                        <?php foreach ($value as $key => $val) { ?>
                                            <td><?= $val; ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>