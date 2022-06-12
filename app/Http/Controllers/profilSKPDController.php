<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profilSKPD;

class profilSKPDController extends Controller
{
    public function index(){
        return view('profilskpd.index');
    }

    public function show(){
        return profilSKPD::first();
    }

    public function update(Request $request){
        $setting = profilSKPD::first();
        $setting->nama_skpd_ukpd = $request->nama_skpd_ukpd;
        $setting->telepon = $request->telepon;
        $setting->alamat = $request->alamat;
        $setting->nama_kepala = $request->nama_kepala;
        $setting->no_telp_kepala = $request->telp_kepala;
        $setting->nip_kepala = $request->nip_kepala;
        $setting->nama_pengurus = $request->nama_pengurus;
        $setting->no_telp_pengurus = $request->telp_pengurus;
        $setting->nip_pengurus = $request->nip_pengurus;
        $setting->ppn = $request->ppn;

        $setting->update();

        return response()->json('Data berhasil disimpan', 200);
    }
}
