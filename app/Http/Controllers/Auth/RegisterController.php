<?php

namespace App\Http\Controllers\Auth;

use App\Anak;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();
        return view('auth.register', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_orang_tua' => 'required',
            'email' => 'required|email|unique:users',
            'no_whatsapp_orang_tua' => 'required',
            'kata_sandi' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'nama_lengkap_anak[].*' => 'required',
            'nama_panggilan_anak[].*' => 'required',
            'tanggal_lahir[].*' => 'required',
            'jenis_kelamin[].*' => 'required',
            'no_whatsapp_anak[].*' => 'required',
            'instagram[].*' => 'required',
            'facebook[].*' => 'required',
            'motivasi' => 'required',
            'sumber_info' => 'required',
            'posting_hasil_karya' => 'required',
            'bukti_pembayaran' => 'required',
            'jangka_pendaftaran' => 'required',
            'catatan' => 'required',
            'nama_bank' => 'required',
            'nominal' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json(['error'=>$validator->errors()->all()]);
            // return redirect()->route('daftar.index')->withErrors($errors)->withInput($request->all());
        } else {
            $orangTua = OrangTua::create([
                'nama_lengkap' => $request['nama_orang_tua'],
                'email' => $request['email'],
                'no_wa' => $request['no_whatsapp_orang_tua'],
                'negara' => 'Indonesia',
                'provinsi' => $request['provinsi'],
                'kota' => $request['kota'],
                'kecamatan' => $request['kecamatan'],
            ]);
    
            for ($i=0; $i < count($request['nama_lengkap_anak']); $i++) { 
                $anak = $orangTua->anak()->create([
                    'nama_lengkap' => $request['nama_lengkap_anak'][$i],
                    'nama_panggilan' => $request['nama_panggilan_anak'][$i],
                    'tanggal_lahir' => $request['tanggal_lahir'][$i],
                    'jenis_kelamin' => $request['jenis_kelamin'][$i],
                    'no_wa' => $request['no_whatsapp_anak'][$i],
                ]);
    
                $pembelajaran = $anak->pembelajaran()->create([
                    'bulan' => $request['jangka_pendaftaran'],
                    'tahun' => date("Y"),
                    'bukti_transfer' => $request['bukti_pembayaran'],
                    'nama_bank' => $request['nama_bank'],
                    'nominal' => $request['nominal'],
                    'catatan' => $request['catatan'],
                ]);
            }
    
            $user = User::create([
                'name' => $request['nama_orang_tua'],
                'email' => $request['email'],
                'password' => Hash::make($request['kata_sandi'])
            ]);

            return redirect()->route('login.index');
        }
    }
}
