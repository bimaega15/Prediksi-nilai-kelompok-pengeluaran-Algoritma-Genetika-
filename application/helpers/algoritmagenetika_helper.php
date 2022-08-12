<?php

use NumPHP\Core\NumArray;
use NumPHP\LinAlg\LinAlg;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;

class Genetika
{
    public $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model(['Inisialisasi/Inisialisasi_model', 'Kategori/Kategori_model']);
    }
    public function dataTargetAll($v_indexFuzzy)
    {
        $dataTargetAll = [];
        $count = count($v_indexFuzzy) - 1;
        $dataTarget = $v_indexFuzzy[$count];
        $dataTargetAll = $dataTarget;

        // foreach ($v_indexFuzzy as $key => $value) {
        //     $count = count($value) - 1;
        //     $dataTargetAll[] = $value[$count];
        // }
        return $dataTargetAll;
    }
    public function inisialisasiAwal()
    {
        $inisialisasi_id = $this->ci->input->get('inisialisasi_id', true);
        $get_inisialisasi = $this->ci->Inisialisasi_model->get($inisialisasi_id)->row();
        $kategori = $this->ci->Kategori_model->joinData()->result();
        $data_kategori = [];
        foreach ($kategori as $key => $r_kategori) {
            $data_kategori[$r_kategori->id_kategori][] = $r_kategori;
        }
        return $data_kategori;
    }
    public function dataPerKategori($data_kategori)
    {
        // data per kategori
        $dataPerKategori = [];
        $dataPerTahun = [];
        foreach ($data_kategori as $id_kategori => $r_data) {
            foreach ($r_data as $index => $value) {
                $dataPerKategori[$id_kategori][] = $value->januari;
                $dataPerKategori[$id_kategori][] = $value->februari;
                $dataPerKategori[$id_kategori][] = $value->maret;
                $dataPerKategori[$id_kategori][] = $value->april;
                $dataPerKategori[$id_kategori][] = $value->mei;
                $dataPerKategori[$id_kategori][] = $value->juni;
                $dataPerKategori[$id_kategori][] = $value->juli;
                $dataPerKategori[$id_kategori][] = $value->agustus;
                $dataPerKategori[$id_kategori][] = $value->september;
                $dataPerKategori[$id_kategori][] = $value->oktober;
                $dataPerKategori[$id_kategori][] = $value->november;
                $dataPerKategori[$id_kategori][] = $value->desember;

                $dataPerTahun[$id_kategori][$value->tahun][] = $value->januari;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->februari;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->maret;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->april;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->mei;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->juni;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->juli;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->agustus;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->september;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->oktober;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->november;
                $dataPerTahun[$id_kategori][$value->tahun][] = $value->desember;
            }
        }
        $data_for_series = $dataPerKategori;
        return [
            'data_for_series' => $data_for_series,
            'data_per_tahun' => $dataPerTahun
        ];
    }
    public function fuzzyTimeSeries($dataPerKategori, $data_for_series)
    {
        $dataRekamSeries = [];
        $dataFTimeSeriesKategori = [];
        foreach ($dataPerKategori as $id_kategori => $r_data) {
            $fuzzyTimeSeries = [];
            $row = 0;
            $column = -1;
            $next_column = 0;

            if (!isset($fuzzyTimeSeries[$id_kategori])) {
                for ($i = 0; $i <= 12; $i++) {
                    $data_series = $r_data[$i];
                    $dataRekamSeries[$i] = $data_series;
                    $column++;
                }
                $fuzzyTimeSeries[$row] = $dataRekamSeries;
                $dataRekamSeries = [];
                // reset colom dan tambah baris
                if ($column == 12) {
                    $row++;
                    $next_column = $column + 1;
                    $column = -1;
                }

                // proses fuzzy time series
                $index_prev = $row - 1;
                $index_next = $row;
                do {
                    foreach ($fuzzyTimeSeries[$index_prev] as $key => $v_data) {
                        $column++;
                        $count = count($fuzzyTimeSeries[$index_prev]) - 1;
                        if ($key > 0) {
                            $fuzzyTimeSeries[$index_next][] = $v_data;
                        }
                        if ($column == $count) {
                            $data_series_next = $data_for_series[$id_kategori][$next_column];
                            $fuzzyTimeSeries[$index_next][] = $data_series_next;
                            $row++;
                            $next_column++;
                            $column = -1;
                        }
                    }
                    $dataFTimeSeriesKategori[$id_kategori] = $fuzzyTimeSeries;
                    $index_prev = $row - 1;
                    $index_next = $row;
                } while (isset($data_for_series[$id_kategori][$next_column]));
            }
        }
        return $dataFTimeSeriesKategori;
    }

    public function normalisasi($dataFTimeSeriesKategori)
    {
        // normalisasi
        $inversFuzzyTimeSeries = [];
        foreach ($dataFTimeSeriesKategori as $id_kategori => $v_indexFuzzy) {
            foreach ($v_indexFuzzy as $index_row => $val_data) {
                foreach ($val_data as $index => $value) {
                    $inversFuzzyTimeSeries[$id_kategori][$index][$index_row] = $value;
                }
            }
        }

        // max and min
        $maxInversFuzzyTSeries = [];
        $minInversFuzzyTSeries = [];
        foreach ($inversFuzzyTimeSeries as $id_kategori => $v_index) {
            foreach ($v_index as $index_row => $value) {
                $max = max($value);
                $min = min($value);

                $maxInversFuzzyTSeries[$id_kategori][$index_row] = $max;
                $minInversFuzzyTSeries[$id_kategori][$index_row] = $min;
            }
        }

        // do normalisasi
        $doNormalisasi = [];
        foreach ($dataFTimeSeriesKategori as $id_kategori => $v_indexFuzzy) {
            foreach ($v_indexFuzzy as $index_row => $vData) {
                foreach ($vData as $index => $value) {
                    $hitung = 0.8 * (($value - $minInversFuzzyTSeries[$id_kategori][$index]) / ($maxInversFuzzyTSeries[$id_kategori][$index] - $minInversFuzzyTSeries[$id_kategori][$index])) + 0.1;

                    $doNormalisasi[$id_kategori][$index_row][$index] = $hitung;
                }
            }
        }
        return [
            'doNormalisasi' => $doNormalisasi,
            'max' => $maxInversFuzzyTSeries,
            'min' => $minInversFuzzyTSeries
        ];
    }

    public function nilaiCenter($v_indexFuzzy, $populasi)
    {
        $count = count($v_indexFuzzy) - 1;
        for ($i = 0; $i < $populasi; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $random = rand(0, $count);
                $nilaiCenter[$i][$j] = $random;
            }
        }
        // $nilaiCenter[0][0] = 4;
        // $nilaiCenter[0][1] = 7;
        // $nilaiCenter[0][2] = 9;
        // $nilaiCenter[0][3] = 1;
        // $nilaiCenter[0][4] = 11;

        // $nilaiCenter[1][0] = 0;
        // $nilaiCenter[1][1] = 2;
        // $nilaiCenter[1][2] = 6;
        // $nilaiCenter[1][3] = 8;
        // $nilaiCenter[1][4] = 10;

        // $nilaiCenter[2][0] = 3;
        // $nilaiCenter[2][1] = 5;
        // $nilaiCenter[2][2] = 12;
        // $nilaiCenter[2][3] = 13;
        // $nilaiCenter[2][4] = 14;


        do {
            $checkSameValue = [];
            $countSame = 0;
            foreach ($nilaiCenter as $index_populasi => $v_column) {
                foreach ($v_column as $index_column => $value) {
                    $checkSameValue[$index_populasi][$value][$index_column] = $value;
                }

                $fixSameValue = [];
                foreach ($checkSameValue[$index_populasi] as $index_value => $v_column) {
                    $countSame = count($v_column);
                    if ($countSame >= 2) {
                        foreach ($v_column as $index_column => $r_val) {
                            $angkaAcak = rand(0, $count);
                            $fixSameValue[$index_populasi][$index_column] = $angkaAcak;
                        }
                    }
                }

                if (isset($fixSameValue[$index_populasi])) {
                    $countFixSame = count($fixSameValue[$index_populasi]);
                    $mergeFix = [];
                    if ($countFixSame >= 2) {
                        $getNilaiCenter = $nilaiCenter[$index_populasi];
                        $getFixSame = $fixSameValue[$index_populasi];
                        $mergeFix = array_replace($getNilaiCenter, $getFixSame);
                        $nilaiCenter[$index_populasi] = $mergeFix;
                    }
                }
            }
        } while ($countSame >= 2);

        return $nilaiCenter;
    }
    public function kromosom($nilaiCenter, $v_indexFuzzy)
    {
        $kromosom = [];
        foreach ($nilaiCenter as $data_populasi => $v_index) {
            foreach ($v_index as $index => $value_data) {
                if (isset($v_indexFuzzy[$value_data])) {
                    $kromosom[$data_populasi][$index] = $v_indexFuzzy[$value_data];
                }
            }
        }
        return $kromosom;
    }
    public function pembagianLatihUji($v_indexFuzzy, $dataLatih)
    {
        $count = count($v_indexFuzzy) - 1;
        $hitung = round(($dataLatih * $count) / 100);

        foreach ($v_indexFuzzy as $index => $value) {
            if ($index <= $hitung) { //tandai disini permisalan
                $arrLatih[] = $value;
            } else {
                $arrUji[] = $value;
            }
        }
        return [
            'arrLatih' => $arrLatih,
            'arrUji' => $arrUji,
        ];
    }
    public function dataTargetMapeUjian($arrUjiMape)
    {
        $dataTargetMape = [];
        foreach ($arrUjiMape as $index_row => $data_value) {
            $maxArr = count($data_value) - 1;
            $dataTargetMape[] = $data_value[$maxArr];
        }
        return $dataTargetMape;
    }
    public function jarakEuclidian($arrLatih, $kromosom)
    {
        $jarakEuclidian = [];
        foreach ($arrLatih as $index_row => $data_value) {
            $maxArr = count($data_value) - 1;
            $dataTarget[] = $data_value[$maxArr];

            foreach ($kromosom as $index_populasi => $v_populasi) {
                foreach ($v_populasi as $index_column => $value_data) {
                    $totalHitung = 0;
                    foreach ($value_data as $index => $v_kromosom) {
                        $count = count($value_data) - 1;
                        if ($index < $count) {
                            $hitung = $data_value[$index] - $v_kromosom;
                            $pow = pow($hitung, 2);
                            $totalHitung += $pow;
                        }
                    }
                    $sqrt = sqrt($totalHitung);
                    $jarakEuclidian[$index_populasi][$index_column][$index_row] = $sqrt;
                }
            }
        }
        // convert to row
        $rowJarakEuclidean = $jarakEuclidian;
        $arrRowEuclidean = [];
        foreach ($rowJarakEuclidean as $index_populasi => $v_populasi) {
            foreach ($v_populasi as $index_row => $v_row) {
                foreach ($v_row as $key => $value) {
                    $arrRowEuclidean[$index_populasi][$key][$index_row] = $value;
                }
            }
        }

        return [
            'dataTarget' => $dataTarget,
            'jarakEuclidian' => $jarakEuclidian,
            'arrRowEuclidean' => $arrRowEuclidean
        ];
    }
    public function aktivasiGausian($jarakEuclidian, $b1)
    {
        $aktivasiFungsiGausian = [];
        foreach ($jarakEuclidian as $index_populasi => $v_column) {
            foreach ($v_column as $index_column => $v_row) {
                foreach ($v_row as $index_row => $value) {
                    $pangkat = - ($b1 * $value);
                    $pangkat = pow($pangkat, 2);
                    $exp = exp($pangkat);

                    $aktivasiFungsiGausian[$index_populasi][$index_row][$index_column] = $exp;
                }
            }
        }
        return $aktivasiFungsiGausian;
    }
    public function leastSquare($aktivasiFungsiGausian)
    {
        $leastSquare = [];
        foreach ($aktivasiFungsiGausian as $index_populasi => $v_row) {
            foreach ($v_row as $index_row => $v_column) {
                array_push($v_column, 1);
                $leastSquare[$index_populasi][$index_row] = $v_column;
            }
        }

        $G = $leastSquare;
        return $G;
    }
    public function GT($G)
    {
        $GT = [];
        foreach ($G as $index_populasi => $v_row) {
            foreach ($v_row as $index_row => $v_column) {
                foreach ($v_column as $index_column => $value) {
                    $GT[$index_populasi][$index_column][$index_row] = $value;
                }
            }
        }
        return $GT;
    }
    public function GTG($GT, $G)
    {
        $GTG = [];
        foreach ($GT as $index_populasi => $v_populasi) {
            $matrix1 = new NumArray(
                $G[$index_populasi]
            );
            $matrix2 = new NumArray(
                $v_populasi
            );

            $mmult = $matrix2->dot($matrix1);
            $mmult = $mmult->getData();
            $GTG[$index_populasi] = $mmult;
        }
        return $GTG;
    }
    public function GTGInverse($GTG)
    {
        $GTGInverse = [];
        foreach ($GTG as $index_populasi => $v_populasi) {
            $matrix = new NumArray(
                $v_populasi
            );

            $inverse = LinAlg::inv($matrix);
            $dataInvers = $inverse->getData();
            $GTGInverse[$index_populasi] = $dataInvers;
        }
        return $GTGInverse;
    }
    public function GTD($GT, $dataTarget)
    {
        $GTD = [];
        foreach ($GT as $index_populasi => $v_populasi) {
            $matrix1 = new NumArray(
                $dataTarget
            );
            $matrix2 = new NumArray(
                $v_populasi
            );
            $mmult = $matrix2->dot($matrix1);
            $mmult = $mmult->getData();

            $GTD[$index_populasi] = $mmult;
        }
        return $GTD;
    }
    public function GtgInversXGtd($GTGInverse, $GTD)
    {
        $GtgInversXGtd = [];
        $nilaiBias = [];
        foreach ($GTGInverse as $index_populasi => $v_populasi) {
            $matrix2 = new NumArray(
                $v_populasi
            );
            $matrix1 = new NumArray(
                $GTD[$index_populasi]
            );

            $mmult = $matrix2->dot($matrix1);
            $mmult = $mmult->getData();
            $maxMult = count($mmult) - 1;
            $GtgInversXGtd[$index_populasi] = $mmult;
            $nilaiBias[$index_populasi] = $mmult[$maxMult];
        }
        return [
            'GtgInversXGtd' => $GtgInversXGtd,
            'nilaiBias' => $nilaiBias
        ];
    }
    public function dMape1($aktivasiFungsiGausian, $nilaiBias, $GtgInversXGtd)
    {
        $dMape1 = [];
        foreach ($aktivasiFungsiGausian as $index_populasi => $v_row) {
            $bias = $nilaiBias[$index_populasi];
            foreach ($v_row as $index_row => $v_column) {
                $totalHitung = 0;

                foreach ($v_column as $index => $value) {
                    $nilaiGtgInversXGtd =  $GtgInversXGtd[$index_populasi][$index];

                    $hitung = $value * $nilaiGtgInversXGtd;
                    $totalHitung += $hitung;
                }
                $totalHitung += $bias;
                $dMape1[$index_populasi][$index_row] = $totalHitung;
            }
        }
        return $dMape1;
    }
    public function dMape2($dMape1, $dataTarget)
    {
        foreach ($dMape1 as $index_populasi => $v_row) {
            foreach ($v_row as $index_row => $val_data) {
                $nilaiTarget = $dataTarget[$index_row];
                $hitung = abs(($nilaiTarget - $val_data) / $nilaiTarget);
                $dMape2[$index_populasi][$index_row] = $hitung;
            }
        }
        return $dMape2;
    }
    public function sumDMape2($dMape2)
    {
        foreach ($dMape2 as $index_populasi => $v_row) {
            $sumDMape2[$index_populasi] = array_sum($v_row);
        }
        return $sumDMape2;
    }
    public function dMape3($dMape2)
    {
        foreach ($dMape2 as $index_populasi => $v_row) {
            foreach ($v_row as $index_row => $val_data) {
                $hitung = 100 * $val_data;
                $dMape3[$index_populasi][$index_row] = $hitung;
            }
        }
        return $dMape3;
    }
    public function mapeAndFitness($dMape3)
    {
        foreach ($dMape3 as $index_populasi => $v_row) {
            $average = array_sum($v_row) / count($v_row);
            $varFitness = 1 / $average;
            $MAPE[$index_populasi] = $average;
            $FITNESS[$index_populasi] = $varFitness;
        }
        return [
            'MAPE' => $MAPE,
            'FITNESS' => $FITNESS
        ];
    }
    public function dMape4($dMape2)
    {
        foreach ($dMape2 as $index_populasi => $v_row) {
            $count = count($v_row);
            foreach ($v_row as $index => $value) {
                $hitung = 100 * (1 / $count * $value);
                $dMape4[$index_populasi][$index] = $hitung;
            }
        }
        return $dMape4;
    }
    public function rataRataMape4($dMape4)
    {
        foreach ($dMape4 as $index_populasi => $v_row) {
            $hitung = array_sum($v_row) / count($v_row);
            $arrDmape4[$index_populasi] = $hitung;
        }
        return $arrDmape4;
    }
    public function fitnessRelatif($FITNESS)
    {
        $hitung = array_sum($FITNESS);
        foreach ($FITNESS as $index => $value) {
            $fitnessRelatif[$index] = $value / $hitung;
        }
        return $fitnessRelatif;
    }
    public function fitnessKomultif($fitnessRelatif)
    {
        $hitung = 0;
        foreach ($fitnessRelatif as $index => $value) {
            $hitung += $value;
            $fitnessKomultif[$index] = $hitung;
        }
        return $fitnessKomultif;
    }
    public function angkaAcak($fitnessKomultif)
    {
        $min = 0;
        $max = 1;
        foreach ($fitnessKomultif as $index => $value) {
            $randomNumber = numberFloat(0, 1);
            $angkaAcak[$index] = $randomNumber;
        }

        // $angkaAcak[0] = 0.242832239339528;
        // $angkaAcak[1] = 0.814806312036978;
        // $angkaAcak[2] = 0.475348663521979;
        return $angkaAcak;
    }
    public function kromosomBaru($fitnessKomultif, $angkaAcak, $next)
    {
        foreach ($fitnessKomultif as $index => $value) {
            $nextIndex = $index + 1;
            $currentIndex = $index;

            $kromosomIndex = null;
            if (isset($fitnessKomultif[$nextIndex])) {
                if ($value < $angkaAcak[$currentIndex] && $fitnessKomultif[$nextIndex] > $angkaAcak[$currentIndex]) {
                    $kromosomIndex = $nextIndex;
                    $next = true;
                } else {
                    if ($next == true) {
                        $hitung = $currentIndex - 1;
                        $currentIndex = $hitung;
                        $next = false;
                    }
                    $kromosomIndex = $currentIndex;
                }
            } else {
                if ($next == true) {
                    $hitung = $currentIndex - 1;
                    $currentIndex = $hitung;
                    $next = false;
                }
                $kromosomIndex = $currentIndex;
            }

            $kromosomBaru[$index] = $kromosomIndex;
        }
        return $kromosomBaru;
    }
    public function crossOver($kromosomBaru, $nilaiCenter)
    {
        foreach ($kromosomBaru as $index => $value) {
            $crossOver[$index] = $nilaiCenter[$value];
        }
        return $crossOver;
    }
    public function angkaRandomCrossOver($crossOver)
    {
        // $PC = numberFloat(0.5, 0.9, 1);
        $ci = &get_instance();
        $ci->load->model('Inisialisasi/Inisialisasi_model');
        $inisialisasi_id = $ci->input->get('inisialisasi_id', true);
        $getInisialisasi = $ci->Inisialisasi_model->get($inisialisasi_id)->row();

        $PC = $getInisialisasi->crossover_inisialisasi;
        foreach ($crossOver as $index => $value) {
            $randomNumber = numberFloat(0, 1);
            $angkaRandomCrossOver[$index] = $randomNumber;
        }

        // $angkaRandomCrossOver[0] = 0.653033063941106;
        // $angkaRandomCrossOver[1] = 0.613913965882923;
        // $angkaRandomCrossOver[2] = 0.515088589598724;

        return [
            'angkaRandomCrossOver' => $angkaRandomCrossOver,
            'PC' => $PC
        ];
    }
    public function seleksiCrossOver($crossOver, $angkaRandomCrossOver, $PC)
    {
        $row = 0;
        $rowPlus = 0;
        $addCrosOver = [];
        foreach ($crossOver as $index => $value) {
            $getNilaiAngkaRandom = $angkaRandomCrossOver[$index];
            // if (floor($getNilaiAngkaRandom) <= $PC) {
            if (($getNilaiAngkaRandom) < $PC) {
                $addCrosOver[$row][$rowPlus] = $value;
                $rowPlus++;
                if ($rowPlus == 2) {
                    $rowPlus = 0;
                    $row++;
                }
            }
        }
        return $addCrosOver;
    }
    public function doCrossOver($addCrosOver)
    {
        $doCrossOver = [];
        foreach ($addCrosOver as $index_row => $val_row) {
            $arrPoint = [];
            $arrPotong = [];
            $arrMerge = [];

            $count = count($val_row);
            if ($count == 2) {
                $banding1 = $val_row[0];
                $banding2 = $val_row[1];

                foreach ($banding1 as $index_banding => $value) {
                    if ($index_banding <= 1) {
                        $arrPoint[0][] = $value;
                        $arrPoint[1][] = $banding2[$index_banding];
                    } else {
                        $arrPotong[0][] = $value;
                        $arrPotong[1][] = $banding2[$index_banding];
                    }
                }

                $arrMerge[0] = array_merge($arrPoint[0], $arrPotong[1]);
                $arrMerge[1] = array_merge($arrPoint[1], $arrPotong[0]);
                $doCrossOver[$index_row] = $arrMerge;
            }
        }
        return $doCrossOver;
    }
    public function orangTuaDanAnak($doCrossOver, $crossOver)
    {
        $mergeParent = [];
        foreach ($doCrossOver as $index_row => $value) {
            $count = count($value);
            $getCross = $crossOver;

            if ($count == 2) {
                foreach ($value as $index => $val) {
                    array_push($getCross, $val);
                }
            }
            $mergeParent = $getCross;
        }
        return $mergeParent;
    }
    public function nilaiKromosomMutasi($mergeParent)
    {
        $nilaiAcakMutasi = [];
        foreach ($mergeParent as $index_row => $value) {
            foreach ($value as $index => $val) {
                $randomAcak = numberFloat(0, 1);
                $nilaiAcakMutasi[$index_row][$index] = $randomAcak;
            }
        }

        // $nilaiAcakMutasi[0][0] = 0.0458852739184922;
        // $nilaiAcakMutasi[0][1] = 0.443818228653494;
        // $nilaiAcakMutasi[0][2] = 0.0910830625620329;
        // $nilaiAcakMutasi[0][3] = 0.356043401711099;
        // $nilaiAcakMutasi[0][4] = 0.0765588012128346;

        // $nilaiAcakMutasi[1][0] = 0.761899564370921;
        // $nilaiAcakMutasi[1][1] = 0.38259637260003;
        // $nilaiAcakMutasi[1][2] = 0.199583509059203;
        // $nilaiAcakMutasi[1][3] = 0.0436911700390508;
        // $nilaiAcakMutasi[1][4] = 0.129985650123635;

        // $nilaiAcakMutasi[2][0] = 0.169169827091768;
        // $nilaiAcakMutasi[2][1] = 0.93649045605328;
        // $nilaiAcakMutasi[2][2] = 0.373470772060686;
        // $nilaiAcakMutasi[2][3] = 0.260635191661098;
        // $nilaiAcakMutasi[2][4] = 0.170385594225736;

        // $nilaiAcakMutasi[3][0] = 0.262998983434961;
        // $nilaiAcakMutasi[3][1] = 0.502259865589734;
        // $nilaiAcakMutasi[3][2] = 0.844763300324387;
        // $nilaiAcakMutasi[3][3] = 0.217499772558868;
        // $nilaiAcakMutasi[3][4] = 0.144309997374422;

        // $nilaiAcakMutasi[4][0] = 0.567385571321477;
        // $nilaiAcakMutasi[4][1] = 0.665056965753162;
        // $nilaiAcakMutasi[4][2] = 0.563852682889018;
        // $nilaiAcakMutasi[4][3] = 0.682313199991744;
        // $nilaiAcakMutasi[4][4] = 0.929139028419798;

        return $nilaiAcakMutasi;
    }

    public function replaceMutasi($nilaiAcakMutasi, $mergeParent, $arrLatih, $PM)
    {
        $replace = [];
        foreach ($nilaiAcakMutasi as $index_row => $v_data) {
            foreach ($v_data as $index => $value) {
                $getKromosom = $mergeParent[$index_row][$index];
                $maxLatih = (count($arrLatih) - 1);
                $getDataKromosom = $mergeParent[$index_row];

                if ($value < $PM) {
                    $angkaAcakMutasi = angkaAcakMutasi(0, $maxLatih, $mergeParent[$index_row]);
                    $replace[$index_row][$index] = $angkaAcakMutasi;
                }
            }
        }

        return $replace;
    }

    public function selectMutasi($mergeParent, $replace)
    {
        $mutasi = [];
        foreach ($mergeParent as $index_row => $v_data) {
            if (isset($replace[$index_row])) {
                $repl = array_replace($v_data, $replace[$index_row]);
                $mutasi[$index_row] = $repl;
            }
        }
        return $mutasi;
    }

    // pengujian
    public function inisialisasiPengujian($kromosom, $indexTerbaik, $GtgInversXGtd, $nilaiBias)
    {
        $kromosom = $kromosom[$indexTerbaik];
        $getKromosom[0] = $kromosom;
        $kromosom = $getKromosom;


        $GtgInversXGtd = $GtgInversXGtd[$indexTerbaik];
        $nilaiBias = $nilaiBias[$indexTerbaik];
        $spread = 64;
        $ln = log(0.5) * -1;
        $sqrtLn = sqrt($ln);
        $b1 = $sqrtLn / $spread;

        return [
            'kromosom' => $kromosom,
            'GtgInversXGtd' => $GtgInversXGtd,
            'nilaiBias' => $nilaiBias,
            'b1' => $b1
        ];
    }
    public function ubahDataTesting1Pengujian($aktivasiFungsiGausian, $GtgInversXGtd, $nilaiBias)
    {
        $ubahDataTesting1 = [];
        foreach ($aktivasiFungsiGausian as $key => $v_data) {
            foreach ($v_data as $index_data => $v_column) {
                $totalHitung = 0;
                foreach ($v_column as $index_column => $value) {
                    $hitung  = $value * $GtgInversXGtd[$index_column];
                    $totalHitung += $hitung;
                }
                $totalHitung += $nilaiBias;
                $ubahDataTesting1[$index_data] = $totalHitung;
            }
        }
        return $ubahDataTesting1;
    }
    public function ubahDataTesting2Pengujian($arrLatih, $ubahDataTesting1, $dataTarget)
    {
        $countLatih = count($arrLatih);
        $inversLatih = 1 / $countLatih;
        foreach ($ubahDataTesting1 as $index => $v_data) {
            $getDataTarget = $dataTarget[$index];
            $hitung = ($inversLatih * (abs(($getDataTarget - $v_data) / $getDataTarget))) * 100;
            // $hitung = ($inversLatih * (abs(($getDataTarget - $v_data) / $getDataTarget))) * 100;
            $ubahDataTesting2[$index] = $hitung;
        }
        return $ubahDataTesting2;
    }
    public function ubahDataTesting3Pengujian($ubahDataTesting2)
    {
        foreach ($ubahDataTesting2 as $index => $value) {
            $ubahDataTesting3[$index] = $value * 100;
        }
        return $ubahDataTesting3;
    }

    public function prediksi($dataTargetAll, $rataRataTesting2)
    {
        $max = max($dataTargetAll);
        $min = min($dataTargetAll);

        $hitung = ((($rataRataTesting2 - 0.1) * ($max - $min)) / 0.8) + $min;
        return $hitung;
    }
}
