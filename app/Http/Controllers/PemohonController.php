<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;

class PemohonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pemohon.index');
    }

    public function data(){
        $pemohon = Pemohon::orderBy('kode_pemohon', 'desc')->get();

        return datatables()
            ->of($pemohon)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pemohon){
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('pemohon.update', $pemohon->kode_pemohon). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('pemohon.destroy', $pemohon->kode_pemohon). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
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
        $pemohon = new Pemohon();

        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $pemohon->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'RQ'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = Pemohon::where('kode_pemohon', $kode_generator)->count();
        $kode_pemohon = '';

        if($checkIt > 0){
            $kode_pemohon = 'RQ'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_pemohon = $kode_generator;
        }

        $pemohon->kode_pemohon = $kode_pemohon;
        $pemohon->nama_pemohon = $request->nama_pemohon;
        $pemohon->nip_niiki = $request->nip_niiki;
        $pemohon->jabatan = $request->jabatan;

        $pemohon->save();
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
        $pemohon = Pemohon::find($id);

        return response()->json($pemohon, 200);
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
        $pemohon = Pemohon::find($id);

        $pemohon->nama_pemohon = $request->nama_pemohon;
        $pemohon->nip_niiki = $request->nip_niiki;
        $pemohon->jabatan = $request->jabatan;

        $pemohon->update();
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
        $pemohon = Pemohon::find($id);
        $pemohon->delete();
        
        return response()->json('Data berhasil dihapus', 200);
    }
}
