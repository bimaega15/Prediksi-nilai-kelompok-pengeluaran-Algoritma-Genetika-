<div class="accordion" id="accordionSuvivor">
    <?php
    foreach ($seleksiSurvivorNilaiCenter as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
    ?>
        <div class="card">
            <div class="card-header" id="kategori-survivor">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-survivor-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-survivor-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-survivor-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-survivor" data-parent="#accordionSuvivor">
                <div class="card-body">
                    <h4>Nilai Center</h4>
                    <?php
                    $headerseleksiSurvivorNilaiCenter = count($seleksiSurvivorNilaiCenter[$id_kategori][0]);
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-nCenter-<?= $id_kategori; ?>">
                            <thead>
                                <tr>
                                    <th>D</th>
                                    <?php
                                    $no = 1;
                                    for ($i = 1; $i <= $headerseleksiSurvivorNilaiCenter; $i++) { ?>
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
                foreach ($seleksiSurvivorKromosom[$id_kategori] as $index_hidden => $v_kromosom) {
                    $headerseleksiSurvivorKromosom = (count($seleksiSurvivorKromosom[$id_kategori][0][0]) - 1);
                ?>
                    <div class="row" style="position: relative;">
                        <div class="col-lg-9">
                            <div class="card-body mt-2">
                                <h4>Kromosom <?= $noKromosom++; ?></h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable-kromosom-<?= $id_kategori; ?>">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Hidden Layer</th>
                                                <?php for ($i = 1; $i <= $headerseleksiSurvivorKromosom; $i++) { ?>
                                                    <th>x<?= $i ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $hidden = 1;
                                            foreach ($v_kromosom as $index_center => $val_data) {
                                                $getNilaiCenter =  $seleksiSurvivorNilaiCenter[$id_kategori][$index_hidden][$index_center];
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
                        </div>
                        <div class="col-lg-3" style="position:absolute; height: 100%;right: 0; top: 50%;">
                            <h4>MAPE : <?= round($seleksiSurvivorMape[$id_kategori][$index_hidden], 3); ?></h4>
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