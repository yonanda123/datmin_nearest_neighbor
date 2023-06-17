@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="relative overflow-x-auto">
        <p class="mb-3 text-gray-500 dark:text-gray-400">Data Uji : x={{ $DataUjiX }} y={{ $DataUjiY }}</p>
        <p class="mb-3 text-gray-500 dark:text-gray-400">Nilai K = {{ $NilaiK }}</p>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data X
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data Y
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kelas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nilai Sequence
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jarak Peringkat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Apakah KNN ?
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Data as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="px-6 py-4">
                            {{ $loop->index+1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['x'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['y'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['kelas'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['nilai_sequence'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['peringkat'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['status'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Ada {{ count($KNNYA) }} yang sesuai yaitu
            @foreach ($KNNYA as $ya)
                <span>({{ $ya['x'] }}, {{ $ya['y'] }})</span>
            @endforeach
        </p>
        
    </div>
@endsection
