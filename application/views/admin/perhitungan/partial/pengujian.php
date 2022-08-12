<div class="accordion" id="accordionPengujian">
    <?php
    foreach ($pengujianKromosom as $id_kategori => $v_row) {
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

            <div id="collapse-survivor-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-survivor" data-parent="#accordionPengujian">
                <div class="card-body mb-3">
                    <h4>Nilai Center Terbaik</h4>
                    <?php
                    $headerCenterTerbaik = (count($pengujianKromosom[$id_kategori][0][0]));
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-center-terbaik-<?= $id_kategori ?>">
                            <thead>
                                <tr>
                                    <?php
                                    $no = 1;
                                    for ($i = 1; $i <= $headerCenterTerbaik; $i++) { ?>
                                        <th><?= $i; ?></th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($v_row as $index_kromosom => $val_kromosom) {
                                    foreach ($val_kromosom as $index => $value) {
                                        echo '<tr>';
                                        foreach ($value as $key => $val) {
                                            echo '<td>' . round($val, 3) . '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                ?>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body mb-3">
                    <h4>Data Uji</h4>
                    <?php
                    $headerDataUji = (count($pengujianArrUji[$id_kategori][0]));
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-pengujian-terbaik-<?= $id_kategori ?>">
                            <thead>
                                <tr>
                                    <?php
                                    for ($i = 1; $i <= $headerDataUji; $i++) { ?>
                                        <th><?= $i; ?></th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($pengujianArrUji[$id_kategori] as $key => $vPengujian) {
                                    echo '<tr>';
                                    foreach ($vPengujian as $key => $r_pengujian) {
                                        echo '<td>' . round($r_pengujian, 3) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body mb-3">
                    <div class="row" style="position: relative;">
                        <div class="col-lg-6">
                            <strong>Bobot W Baru</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Bobot W Baru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pengujianGtgInversXGtd[$id_kategori] as $key => $v_pengujian) {
                                            echo '
                                                                    <tr>
                                                                         <td>' . round($v_pengujian, 3) . '</td>
                                                                     </tr>
                                                                         ';
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6" style="position: absolute; top: 50%; right:0;">
                            <h4>Nilai Bias: <?= round($pengujiannilaiBias[$id_kategori], 3) ?></h4>
                        </div>
                    </div>
                </div>

                <div class="card-body mb-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <strong>Jarak Euclidean</strong>
                            <?php
                            $headerpengujianarrRowEuclidean = count($pengujianarrRowEuclidean[$id_kategori][0][0]);
                            ?>
                            <table class="table table-bordered" id="pengujian-euclidean-<?= $id_kategori; ?>">
                                <div class="table-responsive">
                                    <thead>
                                        <tr>
                                            <?php
                                            for ($i = 1; $i <= $headerpengujianarrRowEuclidean; $i++) {
                                                echo '<th>' . $i . '</th>';
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($pengujianarrRowEuclidean[$id_kategori] as $index_hidden => $value) {
                                            foreach ($value as $index_row => $val) {
                                                echo '<tr>';
                                                foreach ($val as $index => $r_data) {
                                                    echo '<td>' . round($r_data, 3) . '</td>';
                                                }
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <strong>Aktivasi Gausian</strong>
                            <?php
                            $headerPengujianGausian = count($pengujianaktivasiFungsiGausian[$id_kategori][0][0]);
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pengujian-gausian-<?= $id_kategori; ?>">
                                    <thead>
                                        <tr>
                                            <?php
                                            for ($i = 1; $i <= $headerPengujianGausian; $i++) {
                                                echo '<th>' . $i . '</th>';
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($pengujianaktivasiFungsiGausian[$id_kategori] as $index_hidden => $value) {
                                            foreach ($value as $index_row => $val) {
                                                echo '<tr>';
                                                foreach ($val as $index => $r_data) {
                                                    echo '<td>' . round($r_data, 3) . '</td>';
                                                }
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-body mb-3">
                    <strong>Perubahan data testing</strong>
                    <div class="row">
                        <div class="col-lg-4">
                            <strong>Mape 1</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pengujian-mape-1-<?= $id_kategori ?>">
                                    <thead>
                                        <tr>
                                            <th>DMape 1</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pengujianubahDataTesting1[$id_kategori] as $key => $r_data) {
                                            echo '
                                                                            <tr>
                                                                            <td>' . round($r_data, 3) . '</td>
                                                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Mape 2</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pengujian-mape-2-<?= $id_kategori ?>">
                                    <thead>
                                        <tr>
                                            <th>DMape 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pengujianubahDataTesting2[$id_kategori] as $key => $r_data) {
                                            echo '
                                                                            <tr>
                                                                            <td>' . round($r_data, 3) . '</td>
                                                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Mape: <?= round($pengujianrataRataTesting2[$id_kategori], 3) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Mape 3</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pengujian-mape-3-<?= $id_kategori ?>">
                                    <thead>
                                        <tr>
                                            <th>DMape 3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pengujianubahDataTesting3[$id_kategori] as $key => $r_data) {
                                            echo '
                                                                            <tr>
                                                                            <td>' . round($r_data, 3) . '</td>
                                                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Mape: <?= round($pengujianrataRataTesting3[$id_kategori], 3) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body mb-3">
                    <strong>Hasil Prediksi</strong>
                    <div class="row" style="position: relative;">
                        <div class="col-lg-4">
                            <strong>Denormalisasi</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pengujian-denormalisasi-<?= $id_kategori ?>">
                                    <thead>
                                        <tr>
                                            <th>Denormalisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pengujiandenormalisasi[$id_kategori] as $key => $r_data) {
                                            echo '
                                                                            <tr>
                                                                            <td>' . round($r_data, 3) . '</td>
                                                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Mape</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pengujian-mape-<?= $id_kategori; ?>">
                                    <thead>
                                        <tr>
                                            <th>Mape</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pengujianmape[$id_kategori] as $key => $r_data) {
                                            echo '
                                                                            <tr>
                                                                            <td>' . round($r_data, 3) . '</td>
                                                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4" style="position: absolute; top: 50%; right: 0;">
                            <strong>Kesimpulan:</strong>
                            <?php
                            $prediksi = $checkPrediksi[$id_kategori];
                            $stringPrediksi = '';
                            foreach ($prediksi as $tahun => $val_tahun) {
                                foreach ($val_tahun as $bulan => $value) {
                                    $checkBulan = convertToBulan($bulan);
                                    $stringPrediksi = 'Bulan ' . $checkBulan . ' Tahun ' . $tahun;
                                }
                            }
                            ?>
                            <p style="font-size: 16px;">Prediksi bulan berikut: <br />
                                <?= $stringPrediksi ?> <br>
                                Prediksi: <?= round($pengujianprediksi[$id_kategori], 3) ?>
                            </p>
                            <p style="font-size: 16px;">Mape: <br />
                                <?= ((round($pengujianmapePrediksi[$id_kategori], 3))) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>