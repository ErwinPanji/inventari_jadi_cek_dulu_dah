<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\satuan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('satuan.index');
    }

    public function data(){
        $satuan = satuan::orderBy('kode_satuan', 'desc')->get();

        return datatables()
            ->of($satuan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($satuan){
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('satuan.update', $satuan->kode_satuan). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('satuan.destroy', $satuan->kode_satuan). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
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
        $satuan = new satuan();

        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $satuan->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'ST'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = satuan::where('kode_satuan', $kode_generator)->count();
        $kode_satuan = '';

        if($checkIt > 0){
            $kode_satuan = 'ST'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_satuan = $kode_generator;
        }

        $satuan->kode_satuan = $kode_satuan;
        $satuan->nama_satuan = $request->satuan;
        $satuan->keterangan = $request->keterangan;

        $satuan->save();
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
        $satuan = satuan::find($id);

        return response()->json($satuan, 200);
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
        $satuan = satuan::find($id);

        $satuan->nama_satuan = $request->satuan;
        $satuan->keterangan = $request->keterangan;

        $satuan->update();
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
        $satuan = satuan::find($id);
        $satuan->delete();

        return response()->json('Data berhasil dihapus', 200);
    }
}
