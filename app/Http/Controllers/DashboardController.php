<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function classify(Request $request)
    {
        $x = $request->x;
        $y = $request->y;
        $nilaiK = $request->nilaiK;
        $kelas1 = $request->kelas1;
        $kelas2 = $request->kelas2;
        $inputData1kls1 =  $request->only(['kls1matriks1x1', 'kls1matriks1x2', 'kls1matriks1x3', 'kls1matriks1x4', 'kls1matriks1x5']);
        $inputData2kls1 =  $request->only(['kls1matriks2x1', 'kls1matriks2x2', 'kls1matriks2x3', 'kls1matriks2x4', 'kls1matriks2x5']);
        $inputData1kls2 =  $request->only(['kls2matriks1x1', 'kls2matriks1x2', 'kls2matriks1x3', 'kls2matriks1x4', 'kls2matriks1x5']);
        $inputData2kls2 =  $request->only(['kls2matriks2x1', 'kls2matriks2x2', 'kls2matriks2x3', 'kls2matriks2x4', 'kls2matriks2x5']);
        $inputkelas =  $request->only(['kelas1', 'kelas2']);
        $valuesKelas = array_values($inputkelas);

        $valuesData1kls1 = array_values($inputData1kls1);
        $valuesData2kls1 = array_values($inputData2kls1);
        $valuesData1kls2 = array_values($inputData1kls2);
        $valuesData2kls2 = array_values($inputData2kls2);

        $resultClass = [];

        foreach ($valuesKelas as $kelas) {
            $nestedArray = [];

            if ($kelas === $kelas1) {
                $nestedArray[] = $valuesData1kls1;
                $nestedArray[] = $valuesData2kls1;
            } elseif ($kelas === $kelas2) {
                $nestedArray[] = $valuesData1kls2;
                $nestedArray[] = $valuesData2kls2;
            }

            $resultClass[$kelas] = $nestedArray;
        }

        $grubxy = [
            "x" => [],
            "y" => []
        ];

        $coba = [];
        foreach ($resultClass as $class => $byclass) {
            $coba[$class] = [
                "x" => $byclass[0],
                "y" => $byclass[1]
            ];
        }
        foreach ($coba as $index => $values) {
            $grubxy["x"] = array_merge($grubxy["x"], $values["x"]);
            $grubxy["y"] = array_merge($grubxy["y"], $values["y"]);
        }

        //dd($resultClass);
        foreach ($resultClass[$kelas1][0] as &$value) {
            $value = pow($value - $x, 2);
        }

        foreach ($resultClass[$kelas1][1] as &$value) {
            $value = pow($value - $y, 2);
        }

        foreach ($resultClass[$kelas2][0] as &$value) {
            $value = pow($value - $x, 2);
        }

        foreach ($resultClass[$kelas2][1] as &$value) {
            $value = pow($value - $y, 2);
        }
        //dd($resultClass);

        $result = [
            $kelas1 => array_map(function ($a, $b) {
                return sqrt($a + $b);
            }, $resultClass[$kelas1][0], $resultClass[$kelas1][1]),
            $kelas2 => array_map(function ($a, $b) {
                return sqrt($a + $b);
            }, $resultClass[$kelas2][0], $resultClass[$kelas2][1])
        ];


        $sequenceDistance = [];
        foreach ($result as $kelas => $nilai) {
            foreach ($nilai as $value) {
                $sequenceDistance[] = [
                    'kelas' => $kelas,
                    'nilai' => $value
                ];
            }
        }

        $kepeseng = [];
        foreach ($sequenceDistance as $index => $item) {
            $kelas = $item["kelas"];
            $nilai = $item["nilai"];

            $kepeseng[] = [
                "kelas" => $kelas,
                "x" => $grubxy["x"][$index],
                "y" => $grubxy["y"][$index],
                'nilai_sequence' => $nilai,
                'original_index' => $index, // Menyimpan indeks asli dari data
            ];
        }
        // // Buat salinan array kepeseng
        // $sortedKepeseng = $kepeseng;

        // // Mengurutkan array salinan berdasarkan nilai_sequence dari yang terkecil ke terbesar
        // usort($sortedKepeseng, function ($a, $b) {
        //     if ($a['nilai_sequence'] != $b['nilai_sequence']) {
        //         return $a['nilai_sequence'] <=> $b['nilai_sequence'];
        //     }
        //     // Jika nilai_sequence sama, diurutkan berdasarkan indeks asli
        //     return $a['original_index'] <=> $b['original_index'];
        // });

        // // Menentukan peringkat berdasarkan urutan data asli
        // $peringkat = 1;
        // foreach ($sortedKepeseng as &$item) {
        //     $item['peringkat'] = $peringkat;
        //     $peringkat++;
        // }

        // // Menggabungkan peringkat yang sudah ditentukan dengan array asli
        // foreach ($kepeseng as &$item) {
        //     foreach ($sortedKepeseng as $sortedItem) {
        //         if ($item['original_index'] === $sortedItem['original_index']) {
        //             $item['peringkat'] = $sortedItem['peringkat'];
        //             break;
        //         }
        //     }
        // }


        // Mengurutkan array berdasarkan nilai_sequence dari yang terkecil ke terbesar
        usort($kepeseng, function ($a, $b) {
            return $a['nilai_sequence'] <=> $b['nilai_sequence'];
        });

        // Menambahkan peringkat berdasarkan urutan dari nilai_sequence terkecil
        $peringkat = 1;
        foreach ($kepeseng as &$item) {
            $item['peringkat'] = $peringkat;
            $peringkat++;
        }

        // Mengurutkan array kembali berdasarkan indeks asli untuk mengembalikan urutan data asli
        usort($kepeseng, function ($a, $b) {
            return $a['original_index'] <=> $b['original_index'];
        });

        // Menghapus kunci 'original_index' yang tidak diperlukan lagi
        foreach ($kepeseng as &$item) {
            unset($item['original_index']);
        }

        usort($sequenceDistance, function ($a, $b) {
            return $a['nilai'] <=> $b['nilai'];
        });

        foreach ($kepeseng as &$item) {
            $item['status'] = ($item['peringkat'] <= $nilaiK) ? 'Ya' : 'Tidak';
        }

        $KNNYA = [];
        foreach ($kepeseng as &$item) {
            if ($item['status'] == 'Ya') {
                $KNNYA[] = [
                    'x' => $item['x'],
                    'y' => $item['y'],
                ];
            }
        }

//         $totals = array();

// // Inisialisasi total untuk setiap kelas menjadi 0
// foreach ($kepeseng as $item) {
    // $kelas = $item['kelas'];
    // $totals[$kelas] = 0;
// }

// // Menghitung total data "Ya" untuk setiap kelas
// foreach ($kepeseng as $item) {
//     $kelas = $item['kelas'];
//     if ($item['status'] == 'Ya') {
//         $totals[$kelas]++;
//     }
// }
        // $countClass = [];
        // foreach ($kepeseng as $item) {
        //     if ($item['status'] == 'Ya') {
        //         $kelas = $item['kelas'];
        //         if (!isset($countClass[$kelas])) {
        //             $countClass[$kelas] = 1;
        //         } else {
        //             $countClass[$kelas]++;
        //         }
        //     }
        // }
        // dd($countClass);

        // // Membentuk array hasil yang berisi kelas dan jumlah
        // $hasilCountKelas = [];
        // foreach ($countClass as $kelas => $jumlah) {
        //     $hasilCountKelas[] = [
        //         'kelas' => $kelas,
        //         'jumlah' => $jumlah,
        //     ];
        // }

        $hasils = array_slice($sequenceDistance, 0, $nilaiK);
        dd($kepeseng);

        return view('TableResult', [
            'KNNYA' => $KNNYA,
            'Data' =>  $kepeseng,
            'DataUjiX' => $x,
            'DataUjiY' => $y,
            'NilaiK' => $nilaiK,
        ]);
    }
}
