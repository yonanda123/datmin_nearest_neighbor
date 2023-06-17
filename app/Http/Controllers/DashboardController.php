<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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

        $countClass = [];
        foreach ($kepeseng as &$item) {
            if ($item['status'] == 'Ya') {
                $countClass[] = [
                    'x' => $item['x'],
                    'y' => $item['y'],
                ];
            }
        }

        $hasils = array_slice($sequenceDistance, 0, $nilaiK);

        $kelas1Count = 0;
        $kelas2Count = 0;

        foreach ($hasils as $dataHasil) {
            if ($dataHasil['kelas'] === $kelas1) {
                $kelas1Count++;
            } elseif ($dataHasil['kelas'] === $kelas2) {
                $kelas2Count++;
            }
        }

        if ($kelas1Count > $kelas2Count) {
            $kelasTerbanyak = $kelas1;
            $jumlahTerbanyak = $kelas1Count;
        } elseif ($kelas2Count > $kelas1Count) {
            $kelasTerbanyak = $kelas2;
            $jumlahTerbanyak = $kelas2Count;
        } else {
            // Jika kelas1Count dan kelas2Count sama, Anda dapat menentukan tindakan yang sesuai
            $kelasTerbanyak = 'Tidak ada kelas yang lebih banyak';
            $jumlahTerbanyak = $kelas1Count; // Atau $kelas2Count, karena keduanya sama
        }

        return view('TableResult', [
            'KNNYA' => $KNNYA,
            'Data' =>  $kepeseng,
            'DataUjiX' => $x,
            'DataUjiY' => $y,
            'NilaiK' => $nilaiK,
            'kelas1' => $kelas1,
            'kelas2' => $kelas2,
            'countKelas1' => $kelas1Count,
            'countKelas2' => $kelas2Count,
            'hasilKlasifikasi' => $jumlahTerbanyak,
            'kelasKlasifikasi' => $kelasTerbanyak,
        ]);
    }
}
