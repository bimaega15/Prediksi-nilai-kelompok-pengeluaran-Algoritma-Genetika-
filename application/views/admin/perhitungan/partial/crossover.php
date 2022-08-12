<div class="accordion" id="accordionCrossOver">
    <?php
    foreach ($crossOver as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
        $getKromosom = count($v_row[0]);
    ?>
        <div class="card">
            <div class="card-header" id="kategori-crossover">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-crossover-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-crossover-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-crossover-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-crossover" data-parent="#accordionCrossOver">
                <div class="card-body">
                    <h4>PC: <?= $PC[$id_kategori] ?></h4>
                    <div class="row">
                        <div class="col-lg-3">
                            <strong>Kromosom</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hidden</th>
                                            <?php
                                            for ($i = 1; $i <= $getKromosom; $i++) { ?>
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
                                                <?php
                                                foreach ($value as $key => $r_val) { ?>
                                                    <td><?= ($r_val + 1); ?></td>
                                                <?php
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
                        <div class="col-lg-3">
                            <strong>Angka Random</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Angka random</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($angkaRandomCrossOver[$id_kategori] as $index => $value) { ?>
                                            <tr>
                                                <td><?= round($value, 3); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <strong>Sebelum Cross Over</strong>
                            <?php
                            foreach ($addCrosOver[$id_kategori] as $key => $v_cross) {
                                $checkCount = count($v_cross);
                                if ($checkCount == 2) {
                                    echo '
                                                                            <div class="table-responsive mb-3">
                                                                                <table class="table table-bordered">
                                                                            ';
                            ?>
                                    <?php foreach ($v_cross as $key => $valData) {
                                        echo '<tr>';
                                        foreach ($valData as $key => $value) { ?>
                                            <td><?= ($value + 1); ?></td>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                        echo '</tr>';
                                    } ?>
                            <?php
                                    echo '  
                                                                </table>
                                                            </div>';
                                }
                            }
                            ?>

                        </div>
                        <div class="col-lg-3">
                            <strong>Sesudah Crossover</strong>
                            <?php
                            foreach ($doCrossOver[$id_kategori] as $key => $v_cross) {
                                $checkCount = count($v_cross);
                                if ($checkCount == 2) {
                                    echo '
                                                                            <div class="table-responsive mb-3">
                                                                                <table class="table table-bordered">
                                                                            ';
                            ?>
                                    <?php foreach ($v_cross as $key => $valData) {
                                        echo '<tr>';
                                        foreach ($valData as $key => $value) { ?>
                                            <td><?= ($value + 1); ?></td>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                        echo '</tr>';
                                    } ?>
                            <?php
                                    echo '  
                                                                </table>
                                                            </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <strong>Hasil Crossover</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php
                                    foreach ($mergeParent[$id_kategori] as $key => $r_merge) {
                                        echo '<tr>';
                                        foreach ($r_merge as $key => $value) { ?>
                                            <td><?= ($value + 1); ?></td>
                                        <?php
                                        }
                                        echo '</tr>';
                                        ?>
                                    <?php
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>