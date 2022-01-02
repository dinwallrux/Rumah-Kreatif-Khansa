<?php

namespace App\Http\Controllers;

use App\Anak;
use App\OrangTua;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('anak');
    }
}
