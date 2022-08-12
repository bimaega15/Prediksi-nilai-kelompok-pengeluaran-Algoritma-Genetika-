<div class="accordion" id="accordionSeleksi">
    <?php
    foreach ($FITNESS as $id_kategori => $v_row) {
        $getKategori = check_kategori_id($id_kategori)->row();
    ?>
        <div class="card">
            <div class="card-header" id="kategori-seleksi">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-seleksi-<?= $id_kategori ?>" aria-expanded="true" aria-controls="collapse-seleksi-<?= $id_kategori ?>">
                        <?= $getKategori->nama_kategori; ?>
                    </button>
                </h2>
            </div>

            <div id="collapse-seleksi-<?= $id_kategori ?>" class="collapse show" aria-labelledby="kategori-seleksi" data-parent="#accordionSeleksi">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <strong>Seleksi</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Fitness</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($v_row as $index => $value) { ?>
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
                        <div class="col-lg-3">
                            <strong>Fitness Relatif</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Fitness Relatif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($fitnessRelatif[$id_kategori] as $index => $value) { ?>
                                            <tr>
                                                <td>P<?= $no++; ?></td>
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
                            <strong>Fitness Komultif</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Fitness Komultif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($fitnessKomultif[$id_kategori] as $index => $value) { ?>
                                            <tr>
                                                <td>Q<?= $no++; ?></td>
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
                            <strong>Angka acak</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Angka acak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($angkaAcak[$id_kategori] as $index => $value) { ?>
                                            <tr>
                                                <td>R<?= $no++; ?></td>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <strong>Kromosom baru</strong>
                            <?php
                            $countKromosomBaru = count($nilaiCenter[$id_kategori][0]);
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hidden</th>
                                            <?php
                                            for ($i = 1; $i <= $countKromosomBaru; $i++) { ?>
                                                <th>x<?= $i; ?></th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kromosomBaru[$id_kategori] as $index => $value) {
                                            $getNilaiCenter = $nilaiCenter[$id_kategori][$value];
                                        ?>
                                            <tr>
                                                <td><?= ($value + 1) ?></td>
                                                <?php foreach ($getNilaiCenter as $key => $valKromosom) { ?>
                                                    <td><?= ($valKromosom + 1); ?></td>
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
            </div>
        </div>
    <?php
    }
    ?>
</div>
