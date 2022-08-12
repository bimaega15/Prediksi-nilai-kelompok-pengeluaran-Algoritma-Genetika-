<div class="accordion" id="accordionMutasi">
    <?php
    foreach ($mergeMutasi as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
        $getKromosom = count($v_row[0]);
    ?>
        <div class="card">
            <div class="card-header" id="kategori-mutasi">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-mutasi-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-mutasi-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-mutasi-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-mutasi" data-parent="#accordionMutasi">
                <div class="card-body">
                    <h3>PM: <?= $PM[$id_kategori]; ?></h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
                            <strong>Angka Random</strong>
                            <?php
                            $getAngkaMutasi = count($nilaiAcakMutasi[$id_kategori][0]);
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <?php for ($i = 1; $i <= $getAngkaMutasi; $i++) { ?>
                                                <th><?= $i; ?></th>
                                            <?php   } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($nilaiAcakMutasi[$id_kategori] as $index_1 => $vNilaiAcak) {
                                            echo '<tr>';
                                            foreach ($vNilaiAcak as $index_2 => $value) {
                                                echo '<td>' . round($value, 3) . '</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Mutasi</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php
                                    foreach ($mutasi[$id_kategori] as $key => $r_mutasi) {
                                        echo '<tr>';
                                        foreach ($r_mutasi as $key => $value) {
                                            echo '<td>' . ($value + 1) . '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <strong>Hasil Mutasi</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php
                                    foreach ($mergeMutasi[$id_kategori] as $key => $r_merge) {
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
