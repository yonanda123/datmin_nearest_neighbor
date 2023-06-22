@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="relative overflow-x-auto">
        <p class="mb-3 text-gray-500 dark:text-gray-400">Data Uji : X={{ $DataUjiX }} Y={{ $DataUjiY }}</p>
        <p class="mb-3 text-gray-500 dark:text-gray-400">Nilai K = {{ $NilaiK }}</p>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Data X
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Data Y
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Kategori Nearst Neigbor
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Square Distance to Query Distance ({{ $DataUjiX }},{{ $DataUjiY }})
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Jarak Terkecil
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Apakah Termasuk KNN ?
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Data as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-center">
                            {{ $loop->index+1 }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $item['x'] }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $item['y'] }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $item['kelas'] }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <p>({{ $item['x'] }} - {{ $DataUjiX }})<sup>2</sup> + ({{ $item['y'] }} - {{ $DataUjiY }})<sup>2</sup> = {{ $item['nilai_sequence'] }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $item['peringkat'] }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $item['status'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="mt-2">Ada {{ count($KNNYA) }} yang sesuai yaitu
            @foreach ($KNNYA as $ya)
                <span>({{ $ya['x'] }}, {{ $ya['y'] }})</span>
            @endforeach
        </p>
        <p>
            Sehingga diperoleh {{ $kelas1 }} = {{ $countKelas1 }} ; {{ $kelas2 }} = {{ $countKelas2 }}
        </p>
        <p>
            Maka hasil klasifikasi adalah {{ $kelasKlasifikasi }} yaitu dengan total jumlah klasifikasi sebanyak {{ $hasilKlasifikasi }}
        </p>
    </div>
@endsection 
