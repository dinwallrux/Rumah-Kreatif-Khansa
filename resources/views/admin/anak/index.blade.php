@extends('layouts.admin.index', ['title' => 'Anak'])
@section('content')
<div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
    <div class="overflow-x-auto rounded-md">
        <table class="table w-full">
            <thead>
                <tr>
                    <th class="bg-white dark:bg-darker">
                        <label>
                            <input type="checkbox" class="checkbox">
                        </label>
                    </th>
                    <th class="bg-white dark:bg-darker">Nama lengkap anak</th>
                    <th class="bg-white dark:bg-darker">Nama panggilan anak</th>
                    <th class="bg-white dark:bg-darker">Usia</th>
                    <th class="bg-white dark:bg-darker">Jenis kelamin</th>
                    <th class="bg-white dark:bg-darker">Alamat</th>
                    <th class="bg-white dark:bg-darker">Asal daerah</th>
                    <th class="bg-white dark:bg-darker">Kode pos</th>
                    <th class="bg-white dark:bg-darker">Nama orang tua</th>
                    <th class="bg-white dark:bg-darker">No WA</th>
                    <th class="bg-white dark:bg-darker"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <th class="bg-white dark:bg-darker">
                        <label>
                            <input type="checkbox" class="checkbox">
                        </label>
                    </th>
                    <td class="bg-white dark:bg-darker">{{ $student->nama_lengkap }}</td>
                    <td class="bg-white dark:bg-darker">{{ $student->nama_panggilan }}</td>
                    <td class="bg-white dark:bg-darker">{{ (date('Y') - date('Y', strtotime($student->tanggal_lahir))) }}</td>
                    <td class="bg-white dark:bg-darker">{{ $student->jenis_kelamin }}</td>
                    <td class="bg-white dark:bg-darker">{{ $student->orangTua->alamat }}</td>
                    <td class="bg-white dark:bg-darker">{{ $student->orangTua->provinsi }}, {{ $student->orangTua->kota }}, {{ $student->orangTua->kecamatan }}</td>
                    <td class="bg-white dark:bg-darker">{{ $student->orangTua->kode_pos }}</td>
                    <td class="bg-white dark:bg-darker">{{ $student->orangTua->nama_lengkap }}</td>
                    <td class="bg-white dark:bg-darker">{{ $student->no_wa }}</td>
                    <th class="bg-white dark:bg-darker">
                        <button class="btn btn-ghost btn-xs">detail</button>
                    </th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="bg-white dark:bg-darker"></th>
                    <th class="bg-white dark:bg-darker">Nama lengkap anak</th>
                    <th class="bg-white dark:bg-darker">Nama panggilan anak</th>
                    <th class="bg-white dark:bg-darker">Usia</th>
                    <th class="bg-white dark:bg-darker">Jenis kelamin</th>
                    <th class="bg-white dark:bg-darker">Alamat</th>
                    <th class="bg-white dark:bg-darker">Asal daerah</th>
                    <th class="bg-white dark:bg-darker">Kode pos</th>
                    <th class="bg-white dark:bg-darker">Nama orang tua</th>
                    <th class="bg-white dark:bg-darker">No WA</th>
                    <th class="bg-white dark:bg-darker"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection