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

	<div id="account-info" class="show card md:grid md:grid-cols-2 md:gap-6">
		<div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="#" method="POST">
                    <div class="px-4 py-5 bg-white sm:p-6">
						<div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Nama Orang tua/Wali</span>
                                    </label> 
                                    <input type="text" name="name" class="input input-primary input-bordered">
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
                                        <span class="block text-sm font-medium text-gray-700">No Telefon</span>
                                    </label> 
                                    <input type="text" name="phone" autocomplete="phone" class="input input-primary input-bordered">
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
                                    <input type="password" autocomplete="new-password" name="password" class="input input-primary input-bordered">
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
                                    <input type="password" autocomplete="confirm-password" name="confirm_password" class="input input-primary input-bordered">
                                    <label class="label error">
                                        <span class="label-text-alt text-red-600"></span>
                                    </label>
                                </div>
							</div>
						</div>
                    </div>
                </form>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button class="next btn btn-primary">Lanjut</button>
                </div>
            </div>
		</div>
	</div>
    
    <div id="address" class="card md:grid md:grid-cols-2 md:gap-6">
		<div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="#" method="POST">
                    <div class="px-4 py-5 bg-white sm:p-6">
						<div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Provinsi</span>
                                    </label> 
                                    <select class="select select-bordered select-primary w-full max-w-xs">
                                        <option disabled selected="selected">Pilih Provinsi</option>
                                        <option>Bali</option>
                                        <option>Jakarta</option>
                                        <option>Kalimantan</option>
                                        <option>Sulawesi</option>
                                        <option>Sumatera</option>
                                    </select>
                                </div>
                            </div> 
							<div class="col-span-6 sm:col-span-3">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Kabupaten/Kota</span>
                                    </label> 
                                    <select class="select select-bordered select-primary w-full max-w-xs">
                                        <option disabled selected="selected">Pilih Kabupaten/Kota</option> 
                                        <option>Badung</option>
                                        <option>Klungkung</option>
                                        <option>Kota Denpasar</option>
                                    </select>
                                </div>
							</div>

							<div class="col-span-6">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Kecamatan/Desa</span>
                                    </label> 
                                    <select class="select select-bordered select-primary w-full">
                                        <option disabled selected="selected">Pilih Kecamatan/Desa</option> 
                                        <option>Denpasar Selatan</option>
                                        <option>Denpasar Barat</option>
                                    </select>
                                </div>
							</div>

						</div>
                    </div>
                </form>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button class="next btn btn-primary">Lanjut</button>
                </div>
            </div>
		</div>
	</div>

    <div id="student" class="card md:grid md:grid-cols-2 md:gap-6">
		<div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="#" method="POST">
                    <div class="px-4 py-5 bg-white sm:p-6">

						<div class="grid grid-cols-6 gap-3">

                            <div class="col-span-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Jumlah anak yang didaftarkan</span>
                                    </label> 
                                    <select class="select select-bordered select-primary w-full">
                                        <option selected="selected">1 anak</option>
                                        <option>2 anak</option>
                                        <option>3 anak</option>
                                    </select>
                                </div>
                            </div> 

                            <div class="col-span-6">
                                <div class="divider"></div>
                            </div>

						</div>

                        <div class="student-form grid grid-cols-6 gap-6">

							<div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Nama Lengkap Anak</span>
                                    </label> 
                                    <input type="text" class="input input-primary input-bordered">
                                </div>
                            </div> 
							<div class="col-span-6 sm:col-span-3">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Nama Panggilan Anak</span>
                                    </label> 
                                    <input type="text" class="input input-primary input-bordered">
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
                                        <input id="tanggal_lahir" datepicker type="text" class="input input-primary input-bordered pl-10 p-2.5 w-full" placeholder="01/01/1990">
                                    </div>
                                </div>
                            </div>

							<div class="col-span-6 sm:col-span-3">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Jenis kelamin</span>
                                    </label> 
                                    <select class="select select-bordered select-primary w-full">
                                        <option selected="selected" value="laki-laki">Laki - laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
							</div>

                            <div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">No Whatshapp</span>
                                    </label> 
                                    <input type="text" class="input input-primary input-bordered">
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Instagram</span>
                                    </label> 
                                    <input type="text" class="input input-primary input-bordered">
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Facebook</span>
                                    </label> 
                                    <input type="text" class="input input-primary input-bordered">
                                </div>
                            </div>

						</div>

                    </div>
                </form>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button class="next btn btn-primary">Lanjut</button>
                </div>
            </div>
		</div>
	</div>

    <div id="survey" class="card md:grid md:grid-cols-2 md:gap-6">
		<div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="#" method="POST">
                    <div class="px-4 py-5 bg-white sm:p-6">
						<div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Apa motivasi Ayah/Bunda mengikutkan anandanya belajar online bersama Rumah Kreatif Khansa?</span>
                                    </label> 
                                    <textarea class="textarea h-24 textarea-bordered textarea-primary"></textarea>
                                </div>
                            </div> 
							<div class="col-span-6">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Darimana Ayah/Bunda mengetahui kelas belajar online bersama Rumah Kreatif Khansa?</span>
                                    </label> 
                                    <label class="cursor-pointer label justify-start">
                                        <input type="radio" name="opt" checked="checked" class="radio radio-primary mr-3" value="">
                                        <span class="label-text">Instagram</span> 
                                    </label>
                                    <label class="cursor-pointer label justify-start">
                                        <input type="radio" name="opt" checked="checked" class="radio radio-primary mr-3" value="">
                                        <span class="label-text">Facebook</span> 
                                    </label>
                                    <label class="cursor-pointer label justify-start">
                                        <input type="radio" name="opt" checked="checked" class="radio radio-primary mr-3" value="">
                                        <span class="label-text">Whatsapp</span> 
                                    </label>
                                    <label class="cursor-pointer label justify-start">
                                        <input type="radio" name="opt" checked="checked" class="radio radio-primary mr-3" value="">
                                        <span class="label-text mr-3">Lainnya: </span>
                                        <input type="text" class="input input-primary input-bordered w-full">
                                    </label>
                                </div>
							</div>

							<div class="col-span-6">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Apakah Ayah/Bunda berkenan jika kami memposting hasil karya belajar Ananda di sosial media resmi kami?</span>
                                    </label> 
                                    <label class="cursor-pointer label justify-start">
                                        <input type="radio" name="publish" checked class="radio radio-primary mr-3" value="true">
                                        <span class="label-text">Ya</span> 
                                    </label>
                                    <label class="cursor-pointer label justify-start">
                                        <input type="radio" name="publish" class="radio radio-primary mr-3" value="false">
                                        <span class="label-text">Tidak</span> 
                                    </label>
                                </div>
							</div>

						</div>
                    </div>
                </form>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button class="next btn btn-primary">Lanjut</button>
                </div>
            </div>
		</div>
	</div>

    <div id="payment" class="card md:grid md:grid-cols-2 md:gap-6">
		<div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="#" method="POST">
                    <div class="px-4 py-5 bg-white sm:p-6">

						<div class="grid grid-cols-6 gap-3">

                            <div class="col-span-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Bukti tranfer</span>
                                    </label> 
                                    <div class="relative">
                                        <input class="block w-full overflow-hidden cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm rounded-lg block w-full" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Jangka pendaftaran</span>
                                    </label> 
                                    <select class="select select-bordered select-primary w-full">
                                        <option disabled selected="selected">Pilih jangka pendaftaran</option> 
                                        <option>1 bulan</option>
                                        <option>2 bulan</option>
                                        <option>3 bulan</option>
                                    </select>
                                </div>
							</div>

                            <div class="col-span-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Catatan</span>
                                    </label> 
                                    <textarea class="textarea h-24 textarea-bordered textarea-primary"></textarea>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Nama Bank</span>
                                    </label> 
                                    <input type="text" class="input input-primary input-bordered">
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Nominal</span>
                                    </label> 
                                    <input type="text" class="input input-primary input-bordered">
                                </div>
                            </div>

						</div>

                    </div>
                </form>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button class="btn btn-primary">Daftar</button>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
