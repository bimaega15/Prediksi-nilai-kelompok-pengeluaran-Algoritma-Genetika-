<div class="accordion" id="accordionNilaiCenter">
    <?php
    foreach ($nilaiCenter as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
    ?>
        <div class="card">
            <div class="card-header" id="kategori-nCenter">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-nCenter-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-nCenter-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-nCenter-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-nCenter" data-parent="#accordionNilaiCenter">
                <div class="card-body">
                    <h4>Nilai Center</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-nCenter-<?= $id_kategori; ?>">
                            <thead>
                                <tr>
                                    <th>D</th>
                                    <?php
                                    $no = 1;
                                    for ($i = 1; $i <= $headerCenter; $i++) { ?>
                                        <th><?= $i; ?></th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($v_row as $index => $value) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <?php foreach ($value as $key => $val) { ?>
                                            <td><?= ($val + 1); ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                $noKromosom = 1;
                foreach ($kromosom[$id_kategori] as $index_hidden => $v_kromosom) { ?>
                    <div class="card-body mt-2">
                        <h4>Kromosom <?= $noKromosom++; ?></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable-kromosom-<?= $id_kategori; ?>">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Hidden Layer</th>
                                        <?php for ($i = 1; $i <= $headerKromosom; $i++) { ?>
                                            <th>x<?= $i ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $hidden = 1;
                                    foreach ($v_kromosom as $index_center => $val_data) {
                                        $getNilaiCenter =  $nilaiCenter[$id_kategori][$index_hidden][$index_center];
                                    ?>
                                        <tr>
                                            <td><?= $hidden++; ?></td>
                                            <td><?= ($getNilaiCenter + 1); ?></td>
                                            <?php
                                            foreach ($val_data as $key => $value) {
                                                if ($key < 12) {

                                            ?>
                                                    <td><?= round($value, 3); ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>
    <?php
    }
    ?>
</div>