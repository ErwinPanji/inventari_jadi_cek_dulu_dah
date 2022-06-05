<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SumberDana;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sumberdana.index');
    }

    public function data(){
        $sumberdana = SumberDana::orderBy('kode_sumber_dana', 'desc')->get();

        return datatables()
            ->of($sumberdana)
            ->addIndexColumn()
            ->addColumn('aksi', function ($sumberdana){
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('sumberdana.update', $sumberdana->kode_sumber_dana). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('sumberdana.destroy', $sumberdana->kode_sumber_dana). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sumberdana = new SumberDana();

        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $sumberdana->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'SB'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = SumberDana::where('kode_sumber_dana', $kode_generator)->count();
        $kode_sumber_dana = '';

        if($checkIt > 0){
            $kode_sumber_dana = 'SB'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_sumber_dana = $kode_generator;
        }

        $sumberdana->kode_sumber_dana = $kode_sumber_dana;
        $sumberdana->sumber_dana = $request->sumberdana;

        $sumberdana->save();
        return response()->json('Data berhasil disimpan !',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sumberdana = SumberDana::find($id);

        return response()->json($sumberdana, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sumberdana = SumberDana::find($id);

        $sumberdana->sumber_dana = $request->sumberdana;

        $sumberdana->update();
        return response()->json('Data berhasil diupdate !',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sumberdana = SumberDana::find($id);
        $sumberdana->delete();
        
        return response()->json('Data berhasil dihapus', 200);
    }
}
