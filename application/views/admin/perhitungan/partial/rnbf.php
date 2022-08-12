<div class="accordion" id="accordionRbf">
    <?php
    foreach ($nilaiCenter as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
    ?>
        <div class="card">
            <div class="card-header" id="kategori-rbf">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-rbf-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-rbf-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-rbf-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-rbf" data-parent="#accordionRbf">
                <?php
                foreach ($kromosom[$id_kategori] as $index_kromosom => $v_center) {
                    $countCenter = count($v_center);
                    $countKromosom = count($v_center[0]);
                ?>
                    <div class="accordion" id="accordionRbfChild">
                        <div class="card">
                            <div class="card-header" id="collapse-rbf-kromosom">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#kategori-<?= $id_kategori ?>-rbf-<?= $index_kromosom ?>" aria-expanded="true" aria-controls="kategori-<?= $id_kategori ?>-rbf-<?= $index_kromosom ?>">
                                        RBF <?= ($index_kromosom + 1) ?>
                                    </button>
                                </h2>
                            </div>

                            <div id="kategori-<?= $id_kategori ?>-rbf-<?= $index_kromosom ?>" class="collapse" aria-labelledby="collapse-rbf-kromosom" data-parent="#accordionRbfChild">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <strong>Nilai center</strong>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <?php
                                                                for ($i = 1; $i <= $countCenter; $i++) { ?>
                                                                    <th><?= $i; ?></th>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php
                                                                foreach ($v_center as $index_center => $value) {
                                                                    $getNilaiCenter = $nilaiCenter[$id_kategori][$index_kromosom][$index_center];
                                                                ?>
                                                                    <td><?= ($getNilaiCenter + 1) ?></td>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <strong>Kromosom <?= ($index_kromosom + 1) ?></strong>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Hidden layer</th>
                                                                <?php
                                                                for ($i = 1; $i < $countKromosom; $i++) { ?>
                                                                    <th><?= $i; ?></th>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($v_center as $index_center => $val_data) {
                                                                $getNilaiCenter = $nilaiCenter[$id_kategori][$index_kromosom][$index_center];
                                                            ?>
                                                                <tr>
                                                                    <td><?= ($getNilaiCenter + 1) ?></td>
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

                                            <div class="mb-3">
                                                <strong>Data Latih</strong>
                                                <?php
                                                $headerLatih = count($arrLatih[$id_kategori][0]);
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dataTableLatihRbf-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <?php
                                                                for ($i = 1; $i < $headerLatih; $i++) { ?>
                                                                    <th><?= $i; ?></th>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($arrLatih[$id_kategori] as $index_row => $val_data) {
                                                            ?>
                                                                <tr>
                                                                    <td><?= ($index_row + 1) ?></td>
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

                                            <div class="mb-3">
                                                <strong>Jarak euclidean</strong>
                                                <?php
                                                $headerEuclidean = count($jarakEuclidian[$id_kategori][0]);
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="JarakEuclidean-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <?php
                                                                for ($i = 1; $i <= $headerEuclidean; $i++) { ?>
                                                                    <th><?= $i; ?></th>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $getJarakEuclidean = $arrRowEuclidean[$id_kategori][$index_kromosom];
                                                            $no = 1;
                                                            foreach ($getJarakEuclidean as $key => $val_data) {
                                                            ?>
                                                                <tr>
                                                                    <td><?= $no++; ?></td>
                                                                    <?php
                                                                    foreach ($val_data as $key => $value) { ?>
                                                                        <td><?= round($value, 2); ?></td>
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

                                            <div class="mb-3">
                                                <strong>Aktivasi Fungsi Gausian</strong>
                                                <?php
                                                $headerGausian = count($aktivasiFungsiGausian[$id_kategori][0][0]);
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="aktivasiFungsiGausian-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <?php
                                                                for ($i = 1; $i <= $headerGausian; $i++) { ?>
                                                                    <th><?= $i; ?></th>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $getAktivasiGausian = $aktivasiFungsiGausian[$id_kategori][$index_kromosom];
                                                            $no = 1;
                                                            foreach ($getAktivasiGausian as $key => $val_data) {
                                                            ?>
                                                                <tr>
                                                                    <td><?= $no++; ?></td>
                                                                    <?php
                                                                    foreach ($val_data as $key => $value) { ?>
                                                                        <td><?= round($value, 2); ?></td>
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

                                            <div class="row mb-3">
                                                <div class="col-lg-8">
                                                    <strong>Least Square</strong>
                                                    <?php
                                                    $headerLeast = count($G[$id_kategori][0][0]);
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="leastSquare-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <?php
                                                                    for ($i = 1; $i <= $headerLeast; $i++) { ?>
                                                                        <th><?= $i; ?></th>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getG = $G[$id_kategori][$index_kromosom];
                                                                $no = 1;
                                                                foreach ($getG as $key => $val_data) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no++; ?></td>
                                                                        <?php
                                                                        foreach ($val_data as $key => $value) { ?>
                                                                            <td><?= round($value, 2); ?></td>
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
                                                    <strong>D/Target</strong>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dTarget-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>D/Target</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getTarget = $dataTarget[$id_kategori];
                                                                $no = 1;
                                                                foreach ($getTarget as $key => $value) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no++; ?></td>
                                                                        <td><?= round($value, 3); ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <strong>GT</strong>
                                                <?php
                                                $headerGT = count($GT[$id_kategori][0][0]);
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <?php
                                                                for ($i = 1; $i <= $headerGT; $i++) { ?>
                                                                    <th><?= $i; ?></th>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $getGT = $GT[$id_kategori][$index_kromosom];
                                                            $no = 1;
                                                            foreach ($getGT as $key => $val_data) {
                                                            ?>
                                                                <tr>
                                                                    <td><?= $no++; ?></td>
                                                                    <?php
                                                                    foreach ($val_data as $key => $value) { ?>
                                                                        <td><?= round($value, 2); ?></td>
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

                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <strong>GTG</strong>
                                                    <?php
                                                    $headerGTG = count($GTG[$id_kategori][0][0]);
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <?php
                                                                    for ($i = 1; $i <= $headerGTG; $i++) { ?>
                                                                        <th><?= $i; ?></th>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getGTG = $GTG[$id_kategori][$index_kromosom];
                                                                $no = 1;
                                                                foreach ($getGTG as $key => $val_data) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no++; ?></td>
                                                                        <?php
                                                                        foreach ($val_data as $key => $value) { ?>
                                                                            <td><?= round($value, 2); ?></td>
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
                                                <div class="col-lg-6">
                                                    <strong>GTG Inverse</strong>
                                                    <?php
                                                    $headerGtgInverse = count($GTG[$id_kategori][0][0]);
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <?php
                                                                    for ($i = 1; $i <= $headerGtgInverse; $i++) { ?>
                                                                        <th><?= $i; ?></th>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getGtgInverse = $GTGInverse[$id_kategori][$index_kromosom];
                                                                $no = 1;
                                                                foreach ($getGtgInverse as $key => $val_data) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no++; ?></td>
                                                                        <?php
                                                                        foreach ($val_data as $key => $value) { ?>
                                                                            <td><?= round($value, 2); ?></td>
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
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <strong>GTd</strong>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>GTd</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getGTD = $GTD[$id_kategori][$index_kromosom];
                                                                $no = 1;
                                                                foreach ($getGTD as $key => $val_data) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= round($val_data, 2); ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <strong>GTG Inverse x GTd</strong>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Bobot</th>
                                                                    <th>GTG Inverse x GTd</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no = 1;
                                                                $getGtgInversXGtd = $GtgInversXGtd[$id_kategori][$index_kromosom];
                                                                foreach ($getGtgInversXGtd as $key => $value) { ?>
                                                                    <tr>
                                                                        <td>W<?= $no++; ?></td>
                                                                        <td><?= round($value, 2); ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-4">
                                                    <strong>D Mape</strong>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dMape1-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>D Mape</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getDMape1 = $dMape1[$id_kategori][$index_kromosom];
                                                                $no = 1;
                                                                foreach ($getDMape1 as $key => $val_data) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no++; ?></td>
                                                                        <td><?= round($val_data, 2); ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <strong>D Mape</strong>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dMape2-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>at-ft/at</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getdMape2 = $dMape2[$id_kategori][$index_kromosom];
                                                                $no = 1;
                                                                foreach ($getdMape2 as $key => $val_data) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no++; ?></td>
                                                                        <td><?= round($val_data, 3); ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold">Total</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="font-weight-bold">
                                                                            <?= round($sumDMape2[$id_kategori][$index_kromosom], 3); ?>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <strong>D Mape</strong>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dMape3-<?= $id_kategori ?>-<?= $index_kromosom ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>X 100</th>
                                                                    <th>Mape</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $getdMape3 = $dMape3[$id_kategori][$index_kromosom];
                                                                $getdMape4 = $dMape4[$id_kategori][$index_kromosom];
                                                                $no = 1;
                                                                foreach ($getdMape3 as $key => $val_data) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no++; ?></td>
                                                                        <td><?= round($val_data, 3); ?></td>
                                                                        <td><?= round($getdMape4[$key], 3) ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold">MAPE</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="font-weight-bold"> <?= round($MAPE[$id_kategori][$index_kromosom], 3) ?></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold">FITNESS</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="font-weight-bold"> <?= round($FITNESS[$id_kategori][$index_kromosom], 3) ?></span>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


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
        </div>
    <?php
    }
    ?>
</div>