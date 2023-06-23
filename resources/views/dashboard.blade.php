@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <form action="{{ route('classify') }}" method="POST">
        @csrf
        <div class="container mx-auto">
            <p class="font-bold mb-2">Input Nilai K</p>
            <input type="number" name="nilaiK" placeholder="Input Nilai 1-10" class="w-44" />
        </div>
        <br>
        <hr>
        <br>
        <div class="container mx-auto">
            <p class="font-bold mb-2">Input Data Uji X dan Y</p>
            <input type="number" name="x" placeholder="Nilai X " class="w-32 mr-4" />
            <input type="number" name="y" placeholder="Nilai Y" class="w-32" />
        </div>
        <br>
        <hr>
        <br>
        <div class="container mx-auto">
            <table class="border-none">
                <tbody>
                    <tr>
                        <p class="font-bold mb-4">Input Kategori Nearst Neigborr</p>
                        <input type="text" name="kelas1" placeholder="Class 1" class="w-44" />
                        <td class="px-4 py-2"></td>
                        <input type="text" name="kelas2" placeholder="Class 2" class="w-44 ml-20" />
                        <p class="font-bold mt-4">Input Data Training</p>
                    </tr>
                    <tr>
                        <td class="text-center font-semibold">Nilai X</td>
                        <td class="text-center font-semibold">Nilai Y</td>
                        <td></td>
                        <td class="text-center font-semibold">Nilai X</td>
                        <td class="text-center font-semibold">Nilai Y</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x1" class="w-20" />
                        </td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x1" class="w-20" />
                        <td class="px-4 py-2"></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x1" class="w-20" />
                        </td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x1" class="w-20" />
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x2" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x2" class="w-20" /></td>
                        <td class="px-4 py-2"></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x2" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x2" class="w-20" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x3" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x3" class="w-20" /></td>
                        <td class="px-4 py-2"></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x3" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x3" class="w-20" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x4" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x4" class="w-20" /></td>
                        <td class="px-4 py-2"></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x4" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x4" class="w-20" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x5" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x5" class="w-20" /></td>
                        <td class="px-4 py-2"></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x5" class="w-20" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x5" class="w-20" /></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit"
                class="focus:outline-none text-green mt-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Classify</button>
        </div>
    </form>
@endsection
