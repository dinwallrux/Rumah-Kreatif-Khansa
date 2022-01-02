@extends('layouts.admin.index', ['title' => 'Orang tua'])
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
                    <th class="bg-white dark:bg-darker">Nama lengkap</th>
                    <th class="bg-white dark:bg-darker">Email</th>
                    <th class="bg-white dark:bg-darker">No WA</th>
                    <th class="bg-white dark:bg-darker">Alamat</th>
                    <th class="bg-white dark:bg-darker">Asal daerah</th>
                    <th class="bg-white dark:bg-darker">Kode pos</th>
                    <th class="bg-white dark:bg-darker"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parents as $parent)
                <tr>
                    <th class="bg-white dark:bg-darker">
                        <label>
                            <input type="checkbox" class="checkbox">
                        </label>
                    </th>
                    <td class="bg-white dark:bg-darker">{{ $parent->nama_lengkap }}</td>
                    <td class="bg-white dark:bg-darker">{{ $parent->email }}</td>
                    <td class="bg-white dark:bg-darker">{{ $parent->no_wa }}</td>
                    <td class="bg-white dark:bg-darker">{{ $parent->alamat }}</td>
                    <td class="bg-white dark:bg-darker">{{ $parent->provinsi }}, {{ $parent->kota }}, {{ $parent->kecamatan }}</td>
                    <td class="bg-white dark:bg-darker">{{ $parent->kode_pos }}</td>
                    <th class="bg-white dark:bg-darker">
                        <button class="btn btn-ghost btn-xs">detail</button>
                    </th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="bg-white dark:bg-darker">Nama lengkap</th>
                    <th class="bg-white dark:bg-darker">Email</th>
                    <th class="bg-white dark:bg-darker">No WA</th>
                    <th class="bg-white dark:bg-darker">Alamat</th>
                    <th class="bg-white dark:bg-darker">Asal daerah</th>
                    <th class="bg-white dark:bg-darker">Kode pos</th>
                    <th class="bg-white dark:bg-darker"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection