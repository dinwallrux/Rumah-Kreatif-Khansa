@extends('layouts.app')

@section('content')
<div id="register" class="py-4 mt-10 sm:mt-0 flex items-center flex-col">
	<div class="prose lg:prose text-center mb-5">
		<h1>Rumah Kreatif Khansa</h1>
	</div>

    <div class="md:grid md:grid-cols-1 md:gap-6 mb-4">
        <ul class="w-full steps">
            <li class="step step-primary">Informasi Akun</li>
            <li class="step">Alamat</li>
            <li class="step">Informasi Anak</li>
            <li class="step">Survei</li>
            <li class="step">Bukti Pembayaran</li>
        </ul>
    </div>

    <form action="{{ route('daftar.store') }}" method="POST">
        @csrf

        <div id="account-info" class="show card md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="wrap-form">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Nama Orang tua/Wali</span>
                                        </label>
                                        <input type="text" name="nama_orang_tua" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Email</span>
                                        </label>
                                        <input type="email" name="email" autocomplete="email" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">No Whatsapp</span>
                                        </label>
                                        <input type="text" name="no_whatsapp_orang_tua" autocomplete="no_whatsapp_orang_tua" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Kata sandi</span>
                                        </label>
                                        <input type="password" autocomplete="kata-sandi" name="kata_sandi" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Konfirmasi kata sandi</span>
                                        </label>
                                        <input type="password" autocomplete="confirm-kata-sandi" name="konfirmasi_kata_sandi" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="button" class="next btn btn-primary">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="address" class="card md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="wrap-form">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Provinsi</span>
                                        </label>
                                        <select name="provinsi" class="select select-bordered select-primary w-full max-w-xs">
                                            <option disabled selected="selected">Pilih Provinsi</option>
                                            @foreach ($provinces as $province)
                                                <option value={{ $province->id }}>{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Kabupaten/Kota</span>
                                        </label>
                                        <select name="kota" class="select select-bordered select-primary w-full max-w-xs">
                                            <option disabled selected="selected">Pilih Kabupaten/Kota</option>
                                        </select>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Kecamatan/Desa</span>
                                        </label>
                                        <select name="kecamatan" class="select select-bordered select-primary w-full">
                                            <option disabled selected="selected">Pilih Kecamatan/Desa</option>
                                        </select>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 flex justify-between">
                        <button type="button" class="back btn btn-outline btn-accent">Kembali</button>
                        <button type="button" class="next btn btn-primary">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="student" class="card md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="wrap-form">
                        <div class="wrapper-form px-4 py-5 bg-white sm:p-6">

                            <div class="grid grid-cols-6 gap-3">

                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Jumlah anak yang didaftarkan</span>
                                        </label>
                                        <select name="total_student" class="select select-bordered select-primary w-full">
                                            <option selected="selected" value="1">1 anak</option>
                                            <option value="2">2 anak</option>
                                            <option value="3">3 anak</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <div class="divider"></div>
                                </div>

                            </div>

                            <div id="studentForm1" class="student-form grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Nama Lengkap Anak</span>
                                        </label>
                                        <input name="nama_lengkap_anak" type="text" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Nama Panggilan Anak</span>
                                        </label>
                                        <input name="nama_panggilan_anak" type="text" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                {{-- datepicker --}}
                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Tanggal lahir</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                            </div>
                                            <input name="tanggal_lahir" id="tanggal_lahir" autocomplete="off" datepicker type="text" class="input input-primary input-bordered pl-10 p-2.5 w-full" placeholder="01/01/2003">
                                        </div>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Jenis kelamin</span>
                                        </label>
                                        <select name="jenis_kelamin" class="select select-bordered select-primary w-full">
                                            <option selected="selected" value="laki-laki">Laki - laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">No Whatsapp</span>
                                        </label>
                                        <input name="no_whatsapp_anak" type="text" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Instagram</span>
                                        </label>
                                        <input name="instagram" type="text" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Facebook</span>
                                        </label>
                                        <input name="facebook" type="text" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <div class="divider"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 flex justify-between">
                        <button type="button" class="back btn btn-outline btn-accent">Kembali</button>
                        <button type="button" class="next btn btn-primary">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="survey" class="card md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="wrap-form">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Apa motivasi Ayah/Bunda mengikutkan anandanya belajar online bersama Rumah Kreatif Khansa?</span>
                                        </label>
                                        <textarea name="motivasi" class="textarea h-24 textarea-bordered textarea-primary"></textarea>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Darimana Ayah/Bunda mengetahui kelas belajar online bersama Rumah Kreatif Khansa?</span>
                                        </label>
                                        <label class="cursor-pointer label justify-start">
                                            <input type="radio" name="sumber_info" checked="checked" class="radio radio-primary mr-3" value="instagram">
                                            <span class="label-text">Instagram</span>
                                        </label>
                                        <label class="cursor-pointer label justify-start">
                                            <input type="radio" name="source_info" class="radio radio-primary mr-3" value="facebook">
                                            <span class="label-text">Facebook</span>
                                        </label>
                                        <label class="cursor-pointer label justify-start">
                                            <input type="radio" name="source_info" class="radio radio-primary mr-3" value="whatsapp">
                                            <span class="label-text">Whatsapp</span>
                                        </label>
                                        <label class="cursor-pointer label justify-start">
                                            <input type="radio" name="source_info" class="radio radio-primary mr-3" value="lainnya">
                                            <span class="label-text mr-3">Lainnya: </span>
                                            <input type="text" name="lainnya" class="input input-primary input-bordered w-full">
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Apakah Ayah/Bunda berkenan jika kami memposting hasil karya belajar Ananda di sosial media resmi kami?</span>
                                        </label>
                                        <label class="cursor-pointer label justify-start">
                                            <input type="radio" name="posting_hasil_karya" checked class="radio radio-primary mr-3" value="true">
                                            <span class="label-text">Ya</span>
                                        </label>
                                        <label class="cursor-pointer label justify-start">
                                            <input type="radio" name="posting_hasil_karya" class="radio radio-primary mr-3" value="false">
                                            <span class="label-text">Tidak</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 flex justify-between">
                        <button type="button" class="back btn btn-outline btn-accent">Kembali</button>
                        <button type="button" class="next btn btn-primary">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="payment" class="card md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="wrap-form">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <div class="grid grid-cols-6 gap-3">

                                <div class="col-span-6">
                                    <h2 class="font-medium mb-1" style="width: 600px;">
                                        Lampiran Bukti Transfer
                                    </h2>
                                    <p class="label-text-alt mb-3" style="width: 600px;">
                                        Terlampir adalah daftar nomor rekening Rumah Kreatif Khansa. <br><br>

                                        Biaya Belajar di Kelas Online Rumah Kreatif Khansa adalah *Rp 30.000,-/anak/bulan*. Ayah dan Bunda silahkan melakukan pembayaran ke salah satu dari nomor rekening yang kami lampirkan. <br><br>

                                        Setelah melakukan transfer, mohon ayah bunda mengupload bukti transfer di form ini.
                                    </p>
                                    <img src="{{asset('img/no-rekening.jpg')}}" alt="" style="width: 350px; margin: auto;">
                                </div>

                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Bukti tranfer</span>
                                        </label>
                                        <div class="relative">
                                            <input type="file" name="bukti_pembayaran" class="block w-full overflow-hidden cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm rounded-lg block w-full">
                                        </div>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Jangka pendaftaran</span>
                                        </label>
                                        <select name="jangka_pendaftaran" class="select select-bordered select-primary w-full">
                                            <option selected="selected" value="">Pilih jangka pendaftaran</option>
                                            <option>1 bulan</option>
                                            <option>2 bulan</option>
                                            <option>3 bulan</option>
                                        </select>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Catatan</span>
                                        </label>
                                        <label class="label pt-0">
                                            <span class="label-text-alt">*) Contoh Pengisian : Transfer untuk 2 bulan (Desember 2021 s/d Januari 2022) untuk 2 anak (Anna dan Anni)</span>
                                        </label>
                                        <textarea name="catatan" class="textarea h-24 textarea-bordered textarea-primary"></textarea>
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Nama Bank</span>
                                        </label>
                                        <input type="text" name="nama_bank" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="block text-sm font-medium text-gray-700">Nominal</span>
                                        </label>
                                        <input type="text" name="nominal" class="input input-primary input-bordered">
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 flex justify-between">
                        <button type="button" class="back btn btn-outline btn-accent">Kembali</button>
                        <button type="submit" id="submit-register" class="btn btn-primary">Daftar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection
