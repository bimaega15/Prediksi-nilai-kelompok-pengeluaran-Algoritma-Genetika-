<div class="accordion" id="accordionNormalisasi">
    <?php
    foreach ($doNormalisasi as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
    ?>
        <div class="card">
            <div class="card-header" id="kategori-normalisasi">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-normalisasi-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-normalisasi-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-normalisasi-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-normalisasi" data-parent="#accordionNormalisasi">
                <div class="card-body">
                    <h4>Normalisasi</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-normalisasi-<?= $id_kategori; ?>">
                            <thead>
                                <tr>
                                    <th>Bulan/Tahun</th>
                                    <th>X1</th>
                                    <th>X2</th>
                                    <th>X3</th>
                                    <th>X4</th>
                                    <th>X5</th>
                                    <th>X6</th>
                                    <th>X7</th>
                                    <th>X8</th>
                                    <th>X9</th>
                                    <th>X10</th>
                                    <th>X11</th>
                                    <th>X12</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($v_row as $index => $value) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <?php foreach ($value as $key => $val) { ?>
                                            <td><?= round($val, 3); ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Max</td>
                                    <?php
                                    foreach ($maxNormalisasi[$id_kategori] as $key => $value) : ?>
                                        <td><?= round($value, 3); ?></td>
                                    <?php
                                    endforeach;
                                    ?>
                                </tr>
                                <tr>
                                    <td>Min</td>
                                    <?php
                                    foreach ($minNormalisasi[$id_kategori] as $key => $value) : ?>
                                        <td><?= round($value, 3); ?></td>
                                    <?php
                                    endforeach;
                                    ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>