<?php

namespace App\Http\Controllers\Api;

use App\Models\Motor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MotorController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->admin != true){
            return response()->json([
                'error' => 'Unathorized',
            ], 422);
        }
        $motor = new Motor();
        $motor->nama = $request->nama;
        $motor->merk = $request->merk;
        $motor->tahun = $request->tahun;
        $motor->jenis = $request->jenis;
        
        $motor->save();

        return response()->json([
            'success' => 'Data Berhasil Disimpan'
        ], 200);
    }
}
