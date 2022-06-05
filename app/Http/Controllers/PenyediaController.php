<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyedia;

class PenyediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penyedia.index');
    }

    public function data(){
        $penyedia = Penyedia::orderBy('kode_penyedia', 'desc')->get();

        return datatables()
            ->of($penyedia)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penyedia){
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('penyedia.update', $penyedia->kode_penyedia). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('penyedia.destroy', $penyedia->kode_penyedia). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
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
        $penyedia = new Penyedia();

        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $penyedia->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'SU'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = Penyedia::where('kode_penyedia', $kode_generator)->count();
        $kode_penyedia = '';

        if($checkIt > 0){
            $kode_penyedia = 'SU'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_penyedia = $kode_generator;
        }

        $penyedia->kode_penyedia = $kode_penyedia;
        $penyedia->nama_penyedia = $request->nama_penyedia;
        $penyedia->alamat = $request->alamat;

        $penyedia->save();
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
        $penyedia = Penyedia::find($id);

        return response()->json($penyedia, 200);
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
        $penyedia = Penyedia::find($id);

        $penyedia->nama_penyedia = $request->nama_penyedia;
        $penyedia->alamat = $request->alamat;

        $penyedia->update();
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
        $penyedia = Penyedia::find($id);
        $penyedia->delete();
        
        return response()->json('Data berhasil dihapus', 200);
    }
}
