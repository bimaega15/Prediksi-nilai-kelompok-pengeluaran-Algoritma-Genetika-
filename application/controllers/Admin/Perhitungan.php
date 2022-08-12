<?php
defined('BASEPATH') or exit('No direct script access allowed');

use NumPHP\Core\NumArray;
use NumPHP\LinAlg\LinAlg;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;

class Perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        if (!$this->session->has_userdata('id_admin')) {
            show_404();
        }
        $this->load->model(['Inisialisasi/Inisialisasi_model', 'Kategori/Kategori_model']);
    }
    public function index()
    {
        $save_array = [];
        // genetika
        $genetika = new Genetika();

        // inisialisasi awal
        $data_kategori = $genetika->inisialisasiAwal();

        // data per kategori
        $dataPerKategori = $genetika->dataPerKategori($data_kategori)['data_for_series'];
        $dataPerTahun = $genetika->dataPerKategori($data_kategori)['data_per_tahun'];

        // check prediksi
        $checkPrediksi = [];
        foreach ($dataPerTahun as $kategori_id => $value_tahun) {
            foreach ($value_tahun as $tahun => $value_data) {
                foreach ($value_data as $index => $data) {
                    if ($data == null) {
                        $checkPrediksi[$kategori_id][$tahun][$index] = null;
                        break;
                    }
                }
            }
        }

        $data_for_series = $dataPerKategori;
        $save_array['data_for_series'] = $data_for_series;
        $save_array['data_per_tahun'] = $dataPerTahun;

        // fuzzy time series
        $dataFTimeSeriesKategori = $genetika->fuzzyTimeSeries($dataPerKategori, $data_for_series);
        $save_array['fuzzy_time_series'] = $dataFTimeSeriesKategori;
        $fuzzyTimeSeriesData = $dataFTimeSeriesKategori;


        // normalisasi
        $doNormalisasi = [];
        $doNormalisasi = $genetika->normalisasi($dataFTimeSeriesKategori)['doNormalisasi'];
        $maxNormalisasi = $genetika->normalisasi($dataFTimeSeriesKategori)['max'];
        $minNormalisasi = $genetika->normalisasi($dataFTimeSeriesKategori)['min'];
        $save_array['doNormalisasi'] = $doNormalisasi;
        $save_array['maxNormalisasi'] = $maxNormalisasi;
        $save_array['minNormalisasi'] = $minNormalisasi;

        $dataFTimeSeriesKategori = $doNormalisasi;

        // nilai center
        $inisialisasi_id = $this->input->get('inisialisasi_id', true);
        $getInisialisasi = $this->Inisialisasi_model->get($inisialisasi_id)->row();
        $populasi = $getInisialisasi->populasi_inisialisasi;
        $generasi = $getInisialisasi->generasi_inisialisasi;

        foreach ($dataFTimeSeriesKategori as $kategori_id => $v_indexFuzzy) {
            do {
                try {
                    $arr_generasi = [];
                    for ($i = 1; $i <= $generasi; $i++) {
                        $error_show = null;

                        // pembagian data latih & uji
                        $getFuzzyTimeSeriesData = $fuzzyTimeSeriesData[$kategori_id];
                        $dataLatih = $getInisialisasi->latih_inisialisasi;
                        $arrLatih = [];
                        $arrUji = [];
                        $arrLatih = $genetika->pembagianLatihUji($v_indexFuzzy, $dataLatih)['arrLatih'];
                        $arrUji = $genetika->pembagianLatihUji($v_indexFuzzy, $dataLatih)['arrUji'];


                        $save_array['arrLatih'][$kategori_id] = $arrLatih;
                        $save_array['arrUji'][$kategori_id] = $arrUji;

                        // get data target all
                        $dataTargetAll = [];
                        $dataTargetAll = $genetika->dataTargetAll($v_indexFuzzy);
                        $save_array['dataTargetAll'][$kategori_id] = $dataTargetAll;

                        // nilai center
                        $nilaiCenter = [];
                        $nilaiCenter = $genetika->nilaiCenter($arrLatih, $populasi);
                        $save_array['nilaiCenter'][$kategori_id] = $nilaiCenter;


                        // kromosom
                        $kromosom = [];
                        $kromosom = $genetika->kromosom($nilaiCenter, $v_indexFuzzy);
                        $save_array['kromosom'][$kategori_id] = $kromosom;

                        // hitung jarak euclidean
                        $jarakEuclidian = [];
                        $dataTarget = [];
                        $arrRowEuclidean = [];

                        $dataTarget = $genetika->jarakEuclidian($arrLatih, $kromosom)['dataTarget'];
                        $jarakEuclidian = $genetika->jarakEuclidian($arrLatih, $kromosom)['jarakEuclidian'];
                        $arrRowEuclidean = $genetika->jarakEuclidian($arrLatih, $kromosom)['arrRowEuclidean'];

                        $save_array['dataTarget'][$kategori_id] = $dataTarget;
                        $save_array['jarakEuclidian'][$kategori_id] = $jarakEuclidian;
                        $save_array['arrRowEuclidean'][$kategori_id] = $arrRowEuclidean;


                        // aktivasi fungsi gausian
                        $spread = $getInisialisasi->spread_inisialisasi_latih;
                        $ln = log(0.5) * -1;
                        $sqrtLn = sqrt($ln);
                        $b1 = $sqrtLn / $spread;
                        $aktivasiFungsiGausian = [];
                        $aktivasiFungsiGausian = $genetika->aktivasiGausian($jarakEuclidian, $b1);
                        $save_array['aktivasiFungsiGausian'][$kategori_id] = $aktivasiFungsiGausian;

                        // least square
                        $leastSquare = [];
                        $leastSquare = $genetika->leastSquare($aktivasiFungsiGausian);
                        $G = $leastSquare;
                        $save_array['G'][$kategori_id] = $G;


                        // GT
                        $GT = [];
                        $GT = $genetika->GT($G);
                        $save_array['GT'][$kategori_id] = $GT;

                        // GTG
                        $GTG = [];
                        $GTG = $genetika->GTG($GT, $G);
                        $save_array['GTG'][$kategori_id] = $GTG;

                        // GTG Inverse
                        $GTGInverse = [];
                        $GTGInverse = $genetika->GTGInverse($GTG);
                        $save_array['GTGInverse'][$kategori_id] = $GTGInverse;

                        // GTD
                        $GTD = [];
                        $GTD = $genetika->GTD($GT, $dataTarget);
                        $save_array['GTD'][$kategori_id] = $GTD;

                        // Gtg invers x Gtd
                        $GtgInversXGtd = [];
                        $nilaiBias = [];
                        $GtgInversXGtd = $genetika->GtgInversXGtd($GTGInverse, $GTD)['GtgInversXGtd'];
                        $nilaiBias = $genetika->GtgInversXGtd($GTGInverse, $GTD)['nilaiBias'];
                        $save_array['GtgInversXGtd'][$kategori_id] = $GtgInversXGtd;
                        $save_array['nilaiBias'][$kategori_id] = $nilaiBias;

                        // dMape 1
                        $dMape1 = $genetika->dMape1($aktivasiFungsiGausian, $nilaiBias, $GtgInversXGtd);
                        $save_array['dMape1'][$kategori_id] = $dMape1;

                        // dMape2
                        $dMape2 = [];
                        $dMape2 = $genetika->dMape2($dMape1, $dataTarget);
                        $save_array['dMape2'][$kategori_id] = $dMape2;

                        // sum dMape2
                        $sumDMape2 = [];
                        $sumDMape2 = $genetika->sumDMape2($dMape2);
                        $save_array['sumDMape2'][$kategori_id] = $sumDMape2;

                        // dMape3
                        $dMape3 = [];
                        $dMape3 = $genetika->dMape3($dMape2);
                        $save_array['dMape3'][$kategori_id] = $dMape3;


                        // mape & fitness
                        $MAPE = [];
                        $FITNESS = [];
                        $MAPE = $genetika->mapeAndFitness($dMape3)['MAPE'];
                        $FITNESS = $genetika->mapeAndFitness($dMape3)['FITNESS'];
                        $save_array['MAPE'][$kategori_id] = $MAPE;
                        $save_array['FITNESS'][$kategori_id] = $FITNESS;

                        // dMape4
                        $dMape4 = [];
                        $dMape4 = $genetika->dMape4($dMape2);
                        $save_array['dMape4'][$kategori_id] = $dMape4;


                        // rata-rata mape4
                        $rataRataMape4 = [];
                        $rataRataMape4 = $genetika->rataRataMape4($dMape4);
                        $save_array['rataRataMape4'][$kategori_id] = $rataRataMape4;


                        // fitness relatif
                        $fitnessRelatif = [];
                        $fitnessRelatif = $genetika->fitnessRelatif($FITNESS);
                        $save_array['fitnessRelatif'][$kategori_id] = $fitnessRelatif;

                        // fitness komultif
                        $fitnessKomultif = [];
                        $fitnessKomultif = $genetika->fitnessKomultif($fitnessRelatif);
                        $save_array['fitnessKomultif'][$kategori_id] = $fitnessKomultif;


                        // angka acak
                        $angkaAcak = [];
                        $angkaAcak = $genetika->angkaAcak($fitnessKomultif);
                        $save_array['angkaAcak'][$kategori_id] = $angkaAcak;


                        // kromosom baru
                        $kromosomBaru = [];
                        $next = null;
                        $kromosomBaru = $genetika->kromosomBaru($fitnessKomultif, $angkaAcak, $next);
                        $save_array['kromosomBaru'][$kategori_id] = $kromosomBaru;


                        // cross over
                        $crossOver = [];
                        $crossOver = $genetika->crossOver($kromosomBaru, $nilaiCenter);
                        $save_array['crossOver'][$kategori_id] = $crossOver;

                        // bangkitkan angka random cross over
                        $angkaRandomCrossOver = [];
                        $angkaRandomCrossOver = $genetika->angkaRandomCrossOver($crossOver)['angkaRandomCrossOver'];

                        $PC = $genetika->angkaRandomCrossOver($crossOver)['PC'];
                        $save_array['angkaRandomCrossOver'][$kategori_id] = $angkaRandomCrossOver;
                        $save_array['PC'][$kategori_id] = $PC;

                        // seleksi cross over
                        $addCrosOver = [];
                        $addCrosOver = $genetika->seleksiCrossOver($crossOver, $angkaRandomCrossOver, $PC);

                        $error = false;
                        $butReady = false;
                        foreach ($addCrosOver as $key => $v_cross) {
                            $count = count($v_cross);
                            if ($count < 2) {
                                $error = true;
                            } else {
                                $butReady = true;
                            }
                        }
                        if ($butReady) {
                            $error = false;
                        }

                        $save_array['addCrosOver'][$kategori_id] = $addCrosOver;
                        if ($error == false && empty($addCrosOver)) {
                            $error = true;
                        }

                        // lakukan cross over
                        $doCrossOver = [];
                        $doCrossOver = $genetika->doCrossOver($addCrosOver);
                        $save_array['doCrossOver'][$kategori_id] = $doCrossOver;

                        // penggabungan orang tua dan anak
                        $mergeParent = [];
                        $mergeParent = $genetika->orangTuaDanAnak($doCrossOver, $crossOver);

                        if ($error) {
                            foreach ($kromosomBaru as $key => $value) {
                                $mergeParent[] = $nilaiCenter[$value];
                            }
                        }
                        $save_array['mergeParent'][$kategori_id] = $mergeParent;

                        // nilai acak kromosom mutasi
                        // $countNilaiCenter = count($nilaiCenter);
                        // $countNilaiGen = count($nilaiCenter[0]);
                        // $jarakPm1 = (1 / ($countNilaiCenter * $countNilaiGen));
                        // $jarakPm2 = (1 / ($countNilaiGen));
                        // $PM = numberFloat($jarakPm1, $jarakPm2, 1);
                        $PM = $getInisialisasi->mutasi_inisialisasi;
                        $save_array['PM'][$kategori_id] = $PM;

                        $nilaiAcakMutasi = [];
                        $nilaiAcakMutasi = $genetika->nilaiKromosomMutasi($mergeParent);
                        $save_array['nilaiAcakMutasi'][$kategori_id] = $nilaiAcakMutasi;

                        // select mtuasi
                        $replace = [];
                        $replace = $genetika->replaceMutasi($nilaiAcakMutasi, $mergeParent, $arrLatih, $PM);
                        $save_array['replace'][$kategori_id] = $replace;

                        $mutasi = [];
                        $mutasi = $genetika->selectMutasi($mergeParent, $replace);
                        $save_array['mutasi'][$kategori_id] = $mutasi;

                        // merge mutasi
                        $mergeMutasi = [];
                        $mergeMutasi = array_merge($mergeParent, $mutasi);

                        if (empty($mutasi)) {
                            $mergeMutasi = $mergeParent;
                        }

                        // $mergeMutasi[4][4] = 14;

                        // $mergeMutasi[5][0] = 4;
                        // $mergeMutasi[5][1] = 7;
                        // $mergeMutasi[5][2] = 9;
                        // $mergeMutasi[5][3] = 1;
                        // $mergeMutasi[5][4] = 15;

                        // $mergeMutasi[6][0] = 3;
                        // $mergeMutasi[6][1] = 5;
                        // $mergeMutasi[6][2] = 12;
                        // $mergeMutasi[6][3] = 9;
                        // $mergeMutasi[6][4] = 14;
                        $save_array['mergeMutasi'][$kategori_id] = $mergeMutasi;

                        // seleksi survivor
                        // nilai center
                        $nilaiCenter = [];
                        $nilaiCenter = $mergeMutasi;

                        // kromosom
                        $kromosom = [];
                        $kromosom = $genetika->kromosom($nilaiCenter, $v_indexFuzzy);

                        // pembagian data latih & uji
                        $dataLatih = 90;
                        $arrLatih = [];
                        $arrUji = [];
                        $arrLatih = $genetika->pembagianLatihUji($v_indexFuzzy, $dataLatih)['arrLatih'];
                        $arrUji = $genetika->pembagianLatihUji($v_indexFuzzy, $dataLatih)['arrUji'];


                        // hitung jarak euclidean
                        $jarakEuclidian = [];
                        $dataTarget = [];
                        $dataTarget = $genetika->jarakEuclidian($arrLatih, $kromosom)['dataTarget'];
                        $jarakEuclidian = $genetika->jarakEuclidian($arrLatih, $kromosom)['jarakEuclidian'];

                        // aktivasi fungsi gausian
                        $spread = $getInisialisasi->spread_inisialisasi_latih;
                        $ln = log(0.5) * -1;
                        $sqrtLn = sqrt($ln);
                        $b1 = $sqrtLn / $spread;
                        $aktivasiFungsiGausian = [];
                        $aktivasiFungsiGausian = $genetika->aktivasiGausian($jarakEuclidian, $b1);

                        // least square
                        $leastSquare = [];
                        $leastSquare = $genetika->leastSquare($aktivasiFungsiGausian);
                        $G = $leastSquare;

                        // GT
                        $GT = [];
                        $GT = $genetika->GT($G);

                        // GTG
                        $GTG = [];
                        $GTG = $genetika->GTG($GT, $G);

                        // GTG Inverse
                        $GTGInverse = [];
                        $GTGInverse = $genetika->GTGInverse($GTG);

                        // GTD
                        $GTD = [];
                        $GTD = $genetika->GTD($GT, $dataTarget);

                        // Gtg invers x Gtd
                        $GtgInversXGtd = [];
                        $nilaiBias = [];
                        $GtgInversXGtd = $genetika->GtgInversXGtd($GTGInverse, $GTD)['GtgInversXGtd'];
                        $nilaiBias = $genetika->GtgInversXGtd($GTGInverse, $GTD)['nilaiBias'];

                        // dMape 1
                        $dMape1 = $genetika->dMape1($aktivasiFungsiGausian, $nilaiBias, $GtgInversXGtd);

                        // dMape2
                        $dMape2 = [];
                        $dMape2 = $genetika->dMape2($dMape1, $dataTarget);

                        // sum dMape2
                        $sumDMape2 = [];
                        $sumDMape2 = $genetika->sumDMape2($dMape2);

                        // dMape3
                        $dMape3 = [];
                        $dMape3 = $genetika->dMape3($dMape2);

                        // mape & fitness
                        $MAPE = [];
                        $FITNESS = [];
                        $MAPE = $genetika->mapeAndFitness($dMape3)['MAPE'];
                        $FITNESS = $genetika->mapeAndFitness($dMape3)['FITNESS'];

                        $save_array['seleksiSurvivorNilaiCenter'][$kategori_id] = $nilaiCenter;
                        $save_array['seleksiSurvivorKromosom'][$kategori_id] = $kromosom;
                        $save_array['seleksiSurvivorMape'][$kategori_id] = $MAPE;
                        foreach ($MAPE as $id_kromosom => $value) {
                            $n_value = strval($value);
                            $arr_generasi[$n_value][] = $i;
                        }
                        $break = false;
                        foreach ($arr_generasi as $key => $v_generasi) {
                            $countGenerasi = count($v_generasi);
                            if ($countGenerasi >= 3) {
                                $break = true;
                            }
                        }
                        if ($break) {
                            break;
                        }
                        if (checkIterasi($i)) {
                            break;
                        };
                    }


                    // pengujian
                    // $centerTerbaik = min($MAPE);
                    // $indexTerbaik = array_search($centerTerbaik, $MAPE);
                    $indexTerbaik = 1;
                    $kromosom = $kromosom[$indexTerbaik];
                    $nilaiCenter = $nilaiCenter[$indexTerbaik];
                    $getKromosom[0] = $kromosom;
                    $kromosom = $getKromosom;
                    $save_array['pengujianKromosom'][$kategori_id] = $kromosom;
                    $save_array['pengujianArrUji'][$kategori_id] = $arrUji;

                    $GtgInversXGtd = $GtgInversXGtd[$indexTerbaik];
                    $nilaiBias = $nilaiBias[$indexTerbaik];
                    $save_array['pengujianGtgInversXGtd'][$kategori_id] = $GtgInversXGtd;
                    $save_array['pengujiannilaiBias'][$kategori_id] = $nilaiBias;
                    // var_dump($GtgInversXGtd);
                    // die;

                    $spread = $getInisialisasi->spread_inisialisasi_uji;
                    $ln = log(0.5) * -1;
                    $sqrtLn = sqrt($ln);
                    $b1 = $sqrtLn / $spread;

                    // jarak euclidean
                    $jarakEuclidian = [];
                    $dataTarget = [];

                    $dataTarget = $genetika->jarakEuclidian($arrUji, $kromosom)['dataTarget'];
                    $jarakEuclidian = $genetika->jarakEuclidian($arrUji, $kromosom)['jarakEuclidian'];
                    $arrRowEuclidean = $genetika->jarakEuclidian($arrUji, $kromosom)['arrRowEuclidean'];

                    $save_array['pengujiandataTarget'][$kategori_id] = $dataTarget;
                    $save_array['pengujianjarakEuclidian'][$kategori_id] = $jarakEuclidian;
                    $save_array['pengujianarrRowEuclidean'][$kategori_id] = $arrRowEuclidean;

                    // aktivasi fungsi gausian
                    $aktivasiFungsiGausian = [];
                    $aktivasiFungsiGausian = $genetika->aktivasiGausian($jarakEuclidian, $b1);
                    $save_array['pengujianaktivasiFungsiGausian'][$kategori_id] = $aktivasiFungsiGausian;

                    // perubahan data testing 1
                    $ubahDataTesting1 = [];
                    $ubahDataTesting1 = $genetika->ubahDataTesting1Pengujian($aktivasiFungsiGausian, $GtgInversXGtd, $nilaiBias);
                    $save_array['pengujianubahDataTesting1'][$kategori_id] = $ubahDataTesting1;


                    // perubahan data testing 2
                    $ubahDataTesting2 = [];
                    $ubahDataTesting2 = $genetika->ubahDataTesting2Pengujian($arrLatih, $ubahDataTesting1, $dataTarget);
                    $save_array['pengujianubahDataTesting2'][$kategori_id] = $ubahDataTesting2;


                    // rata-rata data testing 2
                    $rataRataTesting2 = array_sum($ubahDataTesting2) / count($ubahDataTesting2);
                    $save_array['pengujianrataRataTesting2'][$kategori_id] = $rataRataTesting2;


                    // perubahan data testing 3
                    $ubahDataTesting3 = [];
                    $ubahDataTesting3 = $genetika->ubahDataTesting3Pengujian($ubahDataTesting2);
                    $rataRataTesting3 = array_sum($ubahDataTesting3) / count($ubahDataTesting3);
                    $save_array['pengujianubahDataTesting3'][$kategori_id] = $ubahDataTesting3;
                    $save_array['pengujianrataRataTesting3'][$kategori_id] = $rataRataTesting3;


                    // prediksi
                    $max = end($maxNormalisasi[$kategori_id]);
                    $min = end($minNormalisasi[$kategori_id]);

                    $denormalisasi = [];
                    $mape = [];

                    // data target pengujian mape
                    $arrUjiMape = $genetika->pembagianLatihUji($getFuzzyTimeSeriesData, $dataLatih)['arrUji'];
                    $dataTargetMape = $genetika->dataTargetMapeUjian($arrUjiMape);


                    foreach ($ubahDataTesting1 as $key => $value) {
                        $hitung = ((($value - 0.1) * ($max - $min)) / 0.8) + $min;
                        $hitungMape = abs(((1 / 1) * ($dataTargetMape[$key] - $hitung) / $dataTargetMape[$key]) * 100);

                        $mape[] = $hitungMape;
                        $denormalisasi[] = $hitung;
                    }
                    $save_array['pengujianmape'][$kategori_id] = $mape;
                    $save_array['pengujiandenormalisasi'][$kategori_id] = $denormalisasi;

                    // prediksi
                    $minMape = min($mape);
                    $searchIndex = array_search($minMape, $mape);

                    $save_array['pengujianprediksi'][$kategori_id] = $denormalisasi[$searchIndex];

                    // mape=
                    $save_array['pengujianmapePrediksi'][$kategori_id] = $mape[$searchIndex];
                } catch (Exception $error) {
                    $error_show = $error;
                }
            } while ($error_show != null);
        }


        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Algoritma Genetika', 'Admin/Perhitungan');
        // output
        $data['algoritma_genetika'] = $save_array;
        $data['checkPrediksi'] = $checkPrediksi;
        $data['row_inisialisasi'] = $getInisialisasi;
        $this->session->set_userdata('algoritma_genetika', $data);

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'Algoritma genetika';

        $this->template->admin('admin/perhitungan/main', $data);
    }
}
