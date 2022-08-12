<div class="accordion" id="accordionFuzzy">
    <?php
    foreach ($fuzzy_time_series as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
    ?>
        <div class="card">
            <div class="card-header" id="kategori-fuzzy">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-fuzzy-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-fuzzy-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-fuzzy-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-fuzzy" data-parent="#accordionFuzzy">
                <div class="card-body">
                    <h4>Fuzzy time series</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-fuzzy-<?= $id_kategori; ?>">
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
                        </table>
                    </div>
                </div>

                <div class="card-body mt-2">
                    <h4>Data latih</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-fuzzy-latih-<?= $id_kategori; ?>">
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
                                foreach ($arrLatih[$id_kategori] as $index => $value) { ?>
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
                        </table>
                    </div>
                </div>

                <div class="card-body mt-2">
                    <h4>Data uji</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-fuzzy-uji-<?= $id_kategori; ?>">
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
                                foreach ($arrUji[$id_kategori] as $index => $value) { ?>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>