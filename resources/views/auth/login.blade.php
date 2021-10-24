@extends('layouts.app')

@section('content')
<div id="login" class="py-4 mt-10 sm:mt-0 flex items-center flex-col">
	<div class="prose lg:prose text-center mb-5">
		<h1>Rumah Kreatif Khansa</h1>
	</div>

	<div id="account-login" class="show card md:grid md:grid-cols-2 md:gap-6">
		<div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="#" method="POST">
                    <div class="px-4 py-5 bg-white sm:p-6">

						<div class="grid grid-cols-6 gap-6">

							<div class="col-span-6">
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
                                        <span class="block text-sm font-medium text-gray-700">Kata sandi</span>
                                    </label> 
                                    <input type="password" autocomplete="new-password" name="password" class="input input-primary input-bordered">
                                    <label class="label error">
                                        <span class="label-text-alt text-red-600"></span>
                                    </label>
                                </div>
                            </div> 

                            <div class="col-span-6">
                                <p class="text-xs">
                                    Belum daftar? <a href="{{ route('register') }}" class="link link-primary">daftar sekarang</a>
                                </p>
                            </div> 

						</div>

                    </div>
                </form>
                <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                    <button class="w-full next btn btn-primary">Masuk</button>
                </div>
            </div>
		</div>
	</div>

</div>
@endsection
