<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchInstansi(Request $request)
    {
        // ambil semua instansi yang namanya menyerupai request
        $instansi = Instansi::getDataLikeName($request->name);

        return response()->json($instansi);
    }
}
