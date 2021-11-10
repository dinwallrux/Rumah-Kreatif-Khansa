<?php

namespace App\Http\Controllers\Auth;

use App\Anak;
use App\User;
use App\Http\Controllers\Controller;
use App\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateAttributes = $request->validate([
            'nama_orang_tua' => 'required',
            'email' => 'required|email|unique:users',
            'no_whatsapp_orang_tua' => 'required',
            'kata_sandi' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'nama_lengkap_anak' => 'required',
            'nama_panggilan_anak' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_whatsapp_anak' => 'required',
            'instagram' => 'required',
            'facebook' => 'required',
            'facebook' => 'required',
            'motivasi' => 'required',
            'sumber_info' => 'required',
            'posting_hasil_karya' => 'required',
            'bukti_pembayaran' => 'required',
            'jangka_pendaftaran' => 'required',
            'catatan' => 'required',
            'nama_bank' => 'required',
            'nominal' => 'required'
        ]);

        // replace kata_sandi to password in $validateAttributes array
        $validateAttributes['password'] = $validateAttributes['kata_sandi'];
        unset($validateAttributes['kata_sandi']);

        $orangTua = OrangTua::create([
            'nama_lengkap' => $validateAttributes['nama_orang_tua'],
            'email' => $validateAttributes['email'],
            'no_wa' => $validateAttributes['no_whatsapp_orang_tua'],
            'negara' => 'Indonesia',
            'provinsi' => $validateAttributes['provinsi'],
            'kota' => $validateAttributes['kota'],
            'kecamatan' => $validateAttributes['kecamatan'],
        ]);

        $anak = $orangTua->anak()->create([
            'nama_lengkap' => $validateAttributes['nama_lengkap_anak'],
            'nama_panggilan' => $validateAttributes['nama_panggilan_anak'],
            'tanggal_lahir' => $validateAttributes['tanggal_lahir'],
            'jenis_kelamin' => $validateAttributes['jenis_kelamin'],
            'no_wa' => $validateAttributes['no_whatsapp_anak'],
        ]);

        $pembelajaran = $anak->pembelajaran()->create([
            'bulan' => $validateAttributes['jangka_pendaftaran'],
            'tahun' => date("Y"),
            'bukti_transfer' => $validateAttributes['bukti_pembayaran'],
            'nama_bank' => $validateAttributes['nama_bank'],
            'nominal' => $validateAttributes['nominal'],
            'catatan' => $validateAttributes['catatan'],
        ]);

        $user = User::create([
            'name' => $validateAttributes['nama_orang_tua'],
            'email' => $validateAttributes['email'],
            'password' => Hash::make($validateAttributes['password'])
        ]);
    }
}
