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

        // Inisialisasi array kosong untuk menyimpan hasil akhir
        $resultClass = [];
        // Melakukan iterasi untuk setiap elemen dalam array $valuesKelas
        foreach ($valuesKelas as $kelas) {
            // Inisialisasi array kosong untuk menyimpan nilai yang berkaitan dengan setiap kelas
            $nestedArray = [];
            // Memeriksa jika kelas sama dengan $kelas1
            if ($kelas === $kelas1) {
                // Menambahkan nilai $valuesData1kls1 ke dalam $nestedArray
                $nestedArray[] = $valuesData1kls1;
                // Menambahkan nilai $valuesData2kls1 ke dalam $nestedArray
                $nestedArray[] = $valuesData2kls1;
            }
            // Memeriksa jika kelas sama dengan $kelas2
            elseif ($kelas === $kelas2) {
                // Menambahkan nilai $valuesData1kls2 ke dalam $nestedArray
                $nestedArray[] = $valuesData1kls2;
                // Menambahkan nilai $valuesData2kls2 ke dalam $nestedArray
                $nestedArray[] = $valuesData2kls2;
            }
            // Menyimpan $nestedArray dalam $resultClass dengan menggunakan $kelas sebagai kunci
            $resultClass[$kelas] = $nestedArray;
        }

        // Inisialisasi array kosong $grubXY dengan dua kunci 'x' dan 'y'
        $grubXY = [
            "x" => [],
            "y" => []
        ];
        // Inisialisasi array kosong $ArrayXY
        $ArrayXY = [];
        // Iterasi melalui setiap elemen dalam array $resultClass
        foreach ($resultClass as $class => $byClass) {
            // Membentuk array $ArrayXY dengan menggunakan $class sebagai kunci
            // dan nilai "x" dan "y" dari $byClass sebagai elemen array
            $ArrayXY[$class] = [
                "x" => $byClass[0],
                "y" => $byClass[1]
            ];
        }

        // Iterasi melalui setiap elemen dalam array $ArrayXY
        foreach ($ArrayXY as $index => $values) {
            // Menggabungkan elemen-elemen "x" dari $values ke dalam $grubXY["x"]
            $grubXY["x"] = array_merge($grubXY["x"], $values["x"]);
            // Menggabungkan elemen-elemen "y" dari $values ke dalam $grubXY["y"]
            $grubXY["y"] = array_merge($grubXY["y"], $values["y"]);
        }


        // Mengiterasi melalui elemen-elemen array `$resultClass[$kelas1][0]`
        // Mengubah setiap elemen dengan mengkuadratkan selisih antara `$value` dan `$x`
        foreach ($resultClass[$kelas1][0] as &$value) {
            $value = pow($value - $x, 2);
        }

        // Mengiterasi melalui elemen-elemen array `$resultClass[$kelas1][1]`
        // Mengubah setiap elemen dengan mengkuadratkan selisih antara `$value` dan `$y`
        foreach ($resultClass[$kelas1][1] as &$value) {
            $value = pow($value - $y, 2);
        }

        // Mengiterasi melalui elemen-elemen array `$resultClass[$kelas2][0]`
        // Mengubah setiap elemen dengan mengkuadratkan selisih antara `$value` dan `$x`
        foreach ($resultClass[$kelas2][0] as &$value) {
            $value = pow($value - $x, 2);
        }

        // Mengiterasi melalui elemen-elemen array `$resultClass[$kelas2][1]`
        // Mengubah setiap elemen dengan mengkuadratkan selisih antara `$value` dan `$y`
        foreach ($resultClass[$kelas2][1] as &$value) {
            $value = pow($value - $y, 2);
        }

        //Membentuk array $result dengan dua kunci, yaitu $kelas1 dan $kelas2.
        $result = [
            //Menggunakan fungsi array_map untuk mengaplikasikan fungsi anonim pada setiap pasangan elemen dalam array $resultClass[$kelas1][0] dan $resultClass[$kelas1][1].
            $kelas1 => array_map(function ($a, $b) {
                return sqrt($a + $b);
            }, $resultClass[$kelas1][0], $resultClass[$kelas1][1]),
            $kelas2 => array_map(function ($a, $b) {
                return sqrt($a + $b);
            }, $resultClass[$kelas2][0], $resultClass[$kelas2][1])
        ];

        //membuat jarak antar kelas
        $sequenceDistance = [];
        foreach ($result as $kelas => $nilai) {
            foreach ($nilai as $value) {
                $sequenceDistance[] = [
                    'kelas' => $kelas,
                    'nilai' => $value
                ];
            }
        }

        //Membuat array kosong $ValueByClass yang akan digunakan untuk menyimpan informasi nilai berdasarkan kelas.
        $ValueByClass = [];
        //Melakukan iterasi pada array $sequenceDistance menggunakan foreach, dengan variabel $index sebagai indeks dan $item sebagai nilai.
        foreach ($sequenceDistance as $index => $item) {
            $kelas = $item["kelas"];
            $nilai = $item["nilai"];
            $ValueByClass[] = [
                "kelas" => $kelas,
                "x" => $grubXY["x"][$index],
                "y" => $grubXY["y"][$index],
                'nilai_sequence' => $nilai,
                'original_index' => $index,
            ];
        }

        // Mengurutkan array berdasarkan nilai_sequence dari yang terkecil ke terbesar
        usort($ValueByClass, function ($a, $b) {
            return $a['nilai_sequence'] <=> $b['nilai_sequence'];
        });

        // Menambahkan peringkat berdasarkan urutan dari nilai_sequence terkecil
        $peringkat = 1;
        foreach ($ValueByClass as &$item) {
            $item['peringkat'] = $peringkat;
            $peringkat++;
        }

        // Mengurutkan array kembali berdasarkan indeks asli untuk mengembalikan urutan data asli
        usort($ValueByClass, function ($a, $b) {
            return $a['original_index'] <=> $b['original_index'];
        });

        // Menghapus kunci 'original_index' yang tidak diperlukan lagi
        foreach ($ValueByClass as &$item) {
            unset($item['original_index']);
        }

         // Melakukan iterasi pada array $ValueByClass menggunakan perulangan foreach
        // Setiap elemen array ($item) diubah statusnya berdasarkan peringkatnya terhadap $nilaiK
        foreach ($ValueByClass as &$item) {
            // Memeriksa apakah peringkat ($item['peringkat']) kurang dari atau sama dengan $nilaiK
            // Jika ya, maka status diubah menjadi 'Ya', jika tidak, status diubah menjadi 'Tidak'
            $item['status'] = ($item['peringkat'] <= $nilaiK) ? 'Ya' : 'Tidak';
        }

        // Membentuk array $KNNYA berdasarkan elemen-elemen dari array $ValueByClass yang memiliki status 'Ya'
        $KNNYA = []; // Inisialisasi array $KNNYA sebagai array kosong
        foreach ($ValueByClass as &$item) {
            // Memeriksa apakah status ($item['status']) adalah 'Ya'
            // Jika ya, maka elemen array $item ditambahkan ke array $KNNYA dengan kunci 'x' dan 'y'
            if ($item['status'] == 'Ya') {
                $KNNYA[] = [
                    'x' => $item['x'],
                    'y' => $item['y'],
                ];
            }
        }

        // Membentuk array $countClass berdasarkan elemen-elemen dari array $ValueByClass yang memiliki status 'Ya'
        $countClass = []; // Inisialisasi array $countClass sebagai array kosong
        foreach ($ValueByClass as &$item) {
            // Memeriksa apakah status ($item['status']) adalah 'Ya'
            // Jika ya, maka elemen array $item ditambahkan ke array $countClass dengan kunci 'x' dan 'y'
            if ($item['status'] == 'Ya') {
                $countClass[] = [
                    'x' => $item['x'],
                    'y' => $item['y'],
                ];
            }
        }

        // Mengurutkan array $sequenceDistance berdasarkan nilai-nilai 'nilai' di dalamnya secara ascending menggunakan fungsi pembanding
        usort($sequenceDistance, function ($a, $b) {
            return $a['nilai'] <=> $b['nilai'];
        });
        // Memilih sejumlah $nilaiK elemen teratas dari array $sequenceDistance
        $hasils = array_slice($sequenceDistance, 0, $nilaiK);
        // Menghitung jumlah elemen dengan kelas yang sesuai (kelas1 atau kelas2) dalam array $hasils
        $kelas1Count = 0;
        $kelas2Count = 0;
        foreach ($hasils as $dataHasil) {
            if ($dataHasil['kelas'] === $kelas1) {
                $kelas1Count++;
            } elseif ($dataHasil['kelas'] === $kelas2) {
                $kelas2Count++;
            }
        }
        // Menentukan kelas dengan jumlah terbanyak berdasarkan perbandingan $kelas1Count dan $kelas2Count
        if ($kelas1Count > $kelas2Count) {
            $kelasTerbanyak = $kelas1;
            $jumlahTerbanyak = $kelas1Count;
        } elseif ($kelas2Count > $kelas1Count) {
            $kelasTerbanyak = $kelas2;
            $jumlahTerbanyak = $kelas2Count;
        } else {
            $kelasTerbanyak = 'Tidak ada kelas yang lebih banyak';
            $jumlahTerbanyak = $kelas1Count;
        }

        return view('TableResult', [
            'KNNYA' => $KNNYA,
            'Data' =>  $ValueByClass,
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
