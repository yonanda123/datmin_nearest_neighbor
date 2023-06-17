@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <form action="{{ route('classify') }}" method="POST">
        @csrf
        <div class="container mx-auto">
            <table class="border-collapse">
                <tbody>
                    @csrf
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="nilaiK" placeholder="NILAI K" class="w-16" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <hr>
        <br>
        <div class="container mx-auto">
            <table class="border-collapse">
                <tbody>
                    @csrf
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="x" placeholder="X" class="w-16" />
                        </td>
                        <td class="border px-4 py-2"><input type="number" name="y"  placeholder="Y" class="w-16" />
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <hr>
        <br>
        <div class="container mx-auto">
            <table class="border-collapse">
                <tbody>
                    <tr>
                        <td class="border px-4 py-2"><input type="text" name="kelas1" placeholder="Kelas" class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x1" class="w-16" />
                        </td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x1"  class="w-16" />
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x2" 
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x2" 
                                class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x3" 
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x3" 
                                class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x4" 
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x4" 
                                class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks1x5" 
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls1matriks2x5"
                                class="w-16" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <hr>
        <br>
        <div class="container mx-auto">
            <table class="border-collapse">
                <tbody>
                    <tr>
                        <td class="border px-4 py-2"><input type="text" name="kelas2" placeholder="Kelas" class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x1" class="w-16" />
                        </td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x1" class="w-16" />
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x2"
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x2" 
                                class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x3" 
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x3" 
                                class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x4" 
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x4" 
                                class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks1x5" 
                                class="w-16" /></td>
                        <td class="border px-4 py-2"><input type="number" name="kls2matriks2x5" 
                                class="w-16" /></td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"><button type="submit"
                                class="focus:outline-none text-green bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Green</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </form>
@endsection
