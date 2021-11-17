<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getRegencies($id)
    {
        $province = Province::where('id', $id)->first();
        $regencies = $province->regencies;
        // $districts = $regencies->districts->where('id', '5171010')->first();
        // $villages = $districts->villages;
        return response()->json(['data' => $regencies]);
    }

    public function getDistricts($id, $regencyId)
    {
        $province = Province::where('id', $id)->first();
        $regencies = $province->regencies->where('id', $regencyId)->first();
        $districts = $regencies->districts;
        
        return response()->json(['data' => $districts]);
    }
}
