@extends('layouts.app')

@section('content')
<div id="login" class="py-4 mt-10 sm:mt-0 flex items-center flex-col">
	<div class="prose lg:prose text-center mb-5">
		<h1>Rumah Kreatif Khansa</h1>
	</div>

	<div id="account-login" class="show card md:grid md:grid-cols-2 md:gap-6">
		<div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf

                    <div class="px-4 py-5 bg-white sm:p-6">

						<div class="grid grid-cols-6 gap-6">

                            @if(session('error'))
                                <div class="col-span-6">
                                    <div class="alert alert-error">
                                        <div class="flex-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                class="w-6 h-6 mx-2 stroke-current">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                                </path>
                                            </svg>
                                            <label>{{session('error')}}</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

							<div class="col-span-6">
								<div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Email</span>
                                    </label> 
                                    <input type="email" name="email" autocomplete="email" value="{{ old('email') }}" class="input input-primary input-bordered">
                                    @error('email')
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600">{{ $errors->first('email') }}</span>
                                        </label>
                                    @enderror
                                </div>
							</div>

                            <div class="col-span-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="block text-sm font-medium text-gray-700">Kata sandi</span>
                                    </label> 
                                    <input type="password" autocomplete="new-password" name="password" class="input input-primary input-bordered">
                                    @error('password')
                                        <label class="label error">
                                            <span class="label-text-alt text-red-600">{{ $errors->first('password') }}</span>
                                        </label>
                                    @enderror
                                </div>
                            </div> 

                            <div class="col-span-6">
                                <p class="text-xs">
                                    Belum daftar? <a href="{{ route('daftar.index') }}" class="link link-primary">daftar sekarang</a>
                                </p>
                            </div> 

						</div>

                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                        <button type="submit" class="w-full next btn btn-primary">Masuk</button>
                    </div>
                </form>
            </div>
		</div>
	</div>

</div>
@endsection
