<?php $profile = check_profile(); ?>
<div class="main-content">

    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18"><?= $title; ?></h4>

                    <div class="page-title-right">
                        <?= $breadcrumbs; ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <?php $this->view('session'); ?>
                    <?php
                    $dataKategori = $algoritma_genetika['data_per_tahun'];
                    $fuzzy_time_series = $algoritma_genetika['fuzzy_time_series'];
                    $arrLatih = $algoritma_genetika['arrLatih'];
                    $arrUji = $algoritma_genetika['arrUji'];

                    // RNBF
                    $nilaiCenter = $algoritma_genetika['nilaiCenter'];
                    $jarakEuclidian = $algoritma_genetika['jarakEuclidian'];
                    $arrRowEuclidean = $algoritma_genetika['arrRowEuclidean'];
                    $aktivasiFungsiGausian = $algoritma_genetika['aktivasiFungsiGausian'];
                    $G = $algoritma_genetika['G'];
                    $dataTarget = $algoritma_genetika['dataTarget'];
                    $GT = $algoritma_genetika['GT'];
                    $GTG = $algoritma_genetika['GTG'];
                    $GTGInverse = $algoritma_genetika['GTGInverse'];
                    $GTD = $algoritma_genetika['GTD'];
                    $GtgInversXGtd = $algoritma_genetika['GtgInversXGtd'];
                    $dMape1 = $algoritma_genetika['dMape1'];
                    $dMape2 = $algoritma_genetika['dMape2'];
                    $sumDMape2 = $algoritma_genetika['sumDMape2'];
                    $dMape3 = $algoritma_genetika['dMape3'];
                    $MAPE = $algoritma_genetika['MAPE'];
                    $FITNESS = $algoritma_genetika['FITNESS'];
                    $dMape4 = $algoritma_genetika['dMape4'];
                    $rataRataMape4 = $algoritma_genetika['rataRataMape4'];
                    $fitnessRelatif = $algoritma_genetika['fitnessRelatif'];
                    $fitnessKomultif = $algoritma_genetika['fitnessKomultif'];
                    $angkaAcak = $algoritma_genetika['angkaAcak'];
                    $kromosomBaru = $algoritma_genetika['kromosomBaru'];
                    $crossOver = $algoritma_genetika['crossOver'];
                    $angkaRandomCrossOver = $algoritma_genetika['angkaRandomCrossOver'];
                    $addCrosOver = $algoritma_genetika['addCrosOver'];
                    $doCrossOver = $algoritma_genetika['doCrossOver'];
                    $PC = $algoritma_genetika['PC'];
                    $mergeParent = $algoritma_genetika['mergeParent'];
                    $PM = $algoritma_genetika['PM'];
                    $nilaiAcakMutasi = $algoritma_genetika['nilaiAcakMutasi'];
                    $replace = $algoritma_genetika['replace'];
                    $mutasi = $algoritma_genetika['mutasi'];
                    $mergeMutasi = $algoritma_genetika['mergeMutasi'];

                    // seleksi survivor
                    $seleksiSurvivorNilaiCenter = $algoritma_genetika['seleksiSurvivorNilaiCenter'];
                    $seleksiSurvivorKromosom = $algoritma_genetika['seleksiSurvivorKromosom'];
                    $seleksiSurvivorMape = $algoritma_genetika['seleksiSurvivorMape'];

                    // pengujian
                    $pengujianKromosom = $algoritma_genetika['pengujianKromosom'];
                    $pengujianArrUji = $algoritma_genetika['pengujianArrUji'];
                    $pengujianGtgInversXGtd = $algoritma_genetika['pengujianGtgInversXGtd'];
                    $pengujiannilaiBias = $algoritma_genetika['pengujiannilaiBias'];
                    $pengujiandataTarget = $algoritma_genetika['pengujiandataTarget'];
                    $pengujianjarakEuclidian = $algoritma_genetika['pengujianjarakEuclidian'];
                    $pengujianarrRowEuclidean = $algoritma_genetika['pengujianarrRowEuclidean'];
                    $pengujianaktivasiFungsiGausian = $algoritma_genetika['pengujianaktivasiFungsiGausian'];
                    $pengujianubahDataTesting1 = $algoritma_genetika['pengujianubahDataTesting1'];
                    $pengujianubahDataTesting2 = $algoritma_genetika['pengujianubahDataTesting2'];
                    $pengujianubahDataTesting3 = $algoritma_genetika['pengujianubahDataTesting3'];
                    $pengujianrataRataTesting2 = $algoritma_genetika['pengujianrataRataTesting2'];
                    $pengujianrataRataTesting3 = $algoritma_genetika['pengujianrataRataTesting3'];
                    $pengujianmape = $algoritma_genetika['pengujianmape'];
                    $pengujiandenormalisasi = $algoritma_genetika['pengujiandenormalisasi'];
                    $pengujianprediksi = $algoritma_genetika['pengujianprediksi'];
                    $pengujianmapePrediksi = $algoritma_genetika['pengujianmapePrediksi'];
                    $doNormalisasi = $algoritma_genetika['doNormalisasi'];
                    $maxNormalisasi = $algoritma_genetika['maxNormalisasi'];
                    $minNormalisasi = $algoritma_genetika['minNormalisasi'];
                    $checkPrediksi = $checkPrediksi;


                    // kromosom
                    $kromosom = $algoritma_genetika['kromosom'];
                    foreach ($nilaiCenter as $id_kategori => $value) {
                        $headerKromosom = count($kromosom[$id_kategori][0][0]) - 1;
                        $headerCenter = count($value[0]);
                    }

                    ?>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="ml-auto">
                                <form action="<?= base_url('Admin/Perhitungan/submitPerhitungan') ?>" method="post" class="text-right">
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        <i class="fas fa-save"></i> Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-data-asli-tab" data-toggle="tab" href="#nav-data-asli" role="tab" aria-controls="nav-data-asli" aria-selected="true">Data Asli</a>
                                <a class="nav-link" id="nav-fuzzy-time-series-tab" data-toggle="tab" href="#nav-fuzzy-time-series" role="tab" aria-controls="nav-fuzzy-time-series" aria-selected="false">Fuzzy Time Series</a>
                                <a class="nav-link" id="nav-normalisasi-tab" data-toggle="tab" href="#nav-normalisasi" role="tab" aria-controls="nav-normalisasi" aria-selected="false">Normalisasi</a>
                                <a class="nav-link" id="nav-inisialisasi-tab" data-toggle="tab" href="#nav-inisialisasi" role="tab" aria-controls="nav-inisialisasi" aria-selected="false">Inisialisasi</a>
                                <a class="nav-link" id="nav-rbf-tab" data-toggle="tab" href="#nav-rbf" role="tab" aria-controls="nav-rbf" aria-selected="false">RBF</a>
                                <a class="nav-link" id="nav-seleksi-tab" data-toggle="tab" href="#nav-seleksi" role="tab" aria-controls="nav-seleksi" aria-selected="false">Seleksi</a>
                                <a class="nav-link" id="nav-crossover-tab" data-toggle="tab" href="#nav-crossover" role="tab" aria-controls="nav-crossover" aria-selected="false">Crossover</a>
                                <a class="nav-link" id="nav-mutasi-tab" data-toggle="tab" href="#nav-mutasi" role="tab" aria-controls="nav-mutasi" aria-selected="false">Mutasi</a>
                                <a class="nav-link" id="nav-seleksi-survivor-tab" data-toggle="tab" href="#nav-seleksi-survivor" role="tab" aria-controls="nav-seleksi-survivor" aria-selected="false">Survivor</a>
                                <a class="nav-link" id="nav-pengujian-tab" data-toggle="tab" href="#nav-pengujian" role="tab" aria-controls="nav-pengujian" aria-selected="false">Pengujian</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-data-asli" role="tabpanel" aria-labelledby="nav-data-asli-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/data-asli', [
                                    'dataKategori' => $dataKategori
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-fuzzy-time-series" role="tabpanel" aria-labelledby="nav-fuzzy-time-series-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/fuzzy-time', [
                                    'fuzzy_time_series' => $fuzzy_time_series,
                                    'arrLatih' => $arrLatih,
                                    'arrUji' => $arrUji,
                                    'dataKategori' => $dataKategori
                                ])
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-normalisasi" role="tabpanel" aria-labelledby="nav-normalisasi-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/normalisasi', [
                                    'doNormalisasi' => $doNormalisasi,
                                    'maxNormalisasi' => $maxNormalisasi,
                                    'minNormalisasi' => $minNormalisasi,
                                ])
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-inisialisasi" role="tabpanel" aria-labelledby="nav-inisialisasi-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/initial', [
                                    'nilaiCenter' => $nilaiCenter,
                                    'headerCenter' => $headerCenter,
                                    'kromosom' => $kromosom,
                                    'headerKromosom' => $headerKromosom,
                                    'dataKategori' => $dataKategori
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-rbf" role="tabpanel" aria-labelledby="nav-rbf-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/rnbf', [
                                    'nilaiCenter' => $nilaiCenter,
                                    'kromosom' => $kromosom,
                                    'arrLatih' => $arrLatih,
                                    'jarakEuclidian' => $jarakEuclidian,
                                    'aktivasiFungsiGausian' => $aktivasiFungsiGausian,
                                    'G' => $G,
                                    'GT' => $GT,
                                    'GTG' => $GTG,
                                    'dMape1' => $dMape1,
                                    'dMape2' => $dMape2,
                                    'sumDMape2' => $sumDMape2,
                                    'dMape3' => $dMape3,
                                    'dMape4' => $dMape4,
                                    'MAPE' => $MAPE,
                                    'FITNESS' => $FITNESS,
                                    'arrRowEuclidean' => $arrRowEuclidean,
                                    'dataTarget' => $dataTarget,
                                    'GTGInverse' => $GTGInverse,
                                    'GTD' => $GTD,
                                    'GtgInversXGtd' => $GtgInversXGtd,
                                    'dataKategori' => $dataKategori
                                ]);
                                ?>
                            </div>

                            <div class="tab-pane fade" id="nav-seleksi" role="tabpanel" aria-labelledby="nav-seleksi-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/seleksi', [
                                    'fitnessRelatif' => $fitnessRelatif,
                                    'fitnessKomultif' => $fitnessKomultif,
                                    'angkaAcak' => $angkaAcak,
                                    'kromosomBaru' => $kromosomBaru,
                                    'dataKategori' => $dataKategori
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-crossover" role="tabpanel" aria-labelledby="nav-crossover-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/crossover', [
                                    'crossOver' => $crossOver,
                                    'angkaRandomCrossOver' => $angkaRandomCrossOver,
                                    'addCrosOver' => $addCrosOver,
                                    'doCrossOver' => $doCrossOver,
                                    'mergeParent' => $mergeParent,
                                    'PC' => $PC,
                                    'dataKategori' => $dataKategori
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-mutasi" role="tabpanel" aria-labelledby="nav-mutasi-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/mutasi', [
                                    'nilaiAcakMutasi' => $nilaiAcakMutasi,
                                    'mutasi' => $mutasi,
                                    'mergeMutasi' => $mergeMutasi,
                                    'dataKategori' => $dataKategori,
                                    'PM' => $PM
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-seleksi-survivor" role="tabpanel" aria-labelledby="nav-seleksi-survivor-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/survivor', [
                                    'seleksiSurvivorNilaiCenter' => $seleksiSurvivorNilaiCenter,
                                    'seleksiSurvivorKromosom' => $seleksiSurvivorKromosom,
                                    'seleksiSurvivorMape' => $seleksiSurvivorMape,
                                    'dataKategori' => $dataKategori
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="nav-pengujian" role="tabpanel" aria-labelledby="nav-pengujian-tab">
                                <?php
                                $this->view('admin/perhitungan/partial/pengujian', [
                                    'pengujianKromosom' => $pengujianKromosom,
                                    'pengujianArrUji' => $pengujianArrUji,
                                    'pengujianGtgInversXGtd' => $pengujianGtgInversXGtd,
                                    'pengujiannilaiBias' => $pengujiannilaiBias,
                                    'pengujianaktivasiFungsiGausian' => $pengujianaktivasiFungsiGausian,
                                    'pengujianarrRowEuclidean' => $pengujianarrRowEuclidean,
                                    'pengujianubahDataTesting1' => $pengujianubahDataTesting1,
                                    'pengujianubahDataTesting2' => $pengujianubahDataTesting2,
                                    'pengujianubahDataTesting3' => $pengujianubahDataTesting3,
                                    'pengujianrataRataTesting2' => $pengujianrataRataTesting2,
                                    'pengujianrataRataTesting3' => $pengujianrataRataTesting3,
                                    'pengujiandenormalisasi' => $pengujiandenormalisasi,
                                    'pengujianmape' => $pengujianmape,
                                    'pengujianprediksi' => $pengujianprediksi,
                                    'pengujianmapePrediksi' => $pengujianmapePrediksi,
                                ]);
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- end row -->
</div>
<!-- End Page-content -->

<?= $footer; ?>
</div>
<script src="<?= base_url('Qovex_v1.0.0/Admin/Vertical/dist/') ?>assets/libs/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        <?php
        foreach ($dataKategori as $id_kategori => $value) { ?>
            var id_kategori = "<?= $id_kategori ?>";
            $('#dataTable-' + id_kategori).DataTable();
            $('#dataTable-fuzzy-' + id_kategori).DataTable();
            $('#dataTable-normalisasi-' + id_kategori).DataTable();
            $('#dataTable-fuzzy-latih-' + id_kategori).DataTable();
            $('#dataTable-fuzzy-uji-' + id_kategori).DataTable();
            $('#dataTable-center-terbaik-' + id_kategori).DataTable();
            $('#pengujian-euclidean-' + id_kategori).DataTable();
            $('#dataTable-pengujian-terbaik-' + id_kategori).DataTable();
            $('#pengujian-gausian-' + id_kategori).DataTable();
            $('#pengujian-mape-1-' + id_kategori).DataTable();
            $('#pengujian-mape-2-' + id_kategori).DataTable();
            $('#pengujian-mape-3-' + id_kategori).DataTable();
            $('#pengujian-mape-' + id_kategori).DataTable({
                "ordering": false
            });
            $('#pengujian-denormalisasi-' + id_kategori).DataTable({
                "ordering": false
            });
            <?php
            foreach ($kromosom[$id_kategori] as $index_kromosom => $v_center) { ?>
                var index_kromosom = "<?= $index_kromosom ?>";
                $('#dataTableLatihRbf-' + id_kategori + '-' + index_kromosom).DataTable();
                $('#JarakEuclidean-' + id_kategori + '-' + index_kromosom).DataTable();
                $('#aktivasiFungsiGausian-' + id_kategori + '-' + index_kromosom).DataTable();
                $('#leastSquare-' + id_kategori + '-' + index_kromosom).DataTable();
                $('#dTarget-' + id_kategori + '-' + index_kromosom).DataTable();
                $('#dMape1-' + id_kategori + '-' + index_kromosom).DataTable();
                $('#dMape2-' + id_kategori + '-' + index_kromosom).DataTable();
                $('#dMape3-' + id_kategori + '-' + index_kromosom).DataTable();
            <?php
            }
            ?>

        <?php
        }
        ?>

        $(document).on('click', '.btn-submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Confirmed',
                text: "Apakah anda yakin ingin submit hasil prediksi ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully',
                        text: 'Sedang proses hasil pengujian',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "<?= base_url('Admin/Pengujian/process?post=submit') ?>";
                    })
                }
            })
        })
    })
</script>