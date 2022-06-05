<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jenisbarang.index');
    }

    public function data()
    {
        $jenisbarang = JenisBarang::orderBy('kode_jenis_barang', 'desc')->get();

        return datatables()
            ->of($jenisbarang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jenisbarang){
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('jenisbarang.update', $jenisbarang->kode_jenis_barang). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('jenisbarang.destroy', $jenisbarang->kode_jenis_barang). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
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
        $jenisbarang = new JenisBarang();

        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $jenisbarang->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'JB'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = JenisBarang::where('kode_jenis_barang', $kode_generator)->count();
        $kode_jenis_barang = '';

        if($checkIt > 0){
            $kode_jenis_barang = 'JB'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_jenis_barang = $kode_generator;
        }

        $jenisbarang->kode_jenis_barang = $kode_jenis_barang;
        $jenisbarang->jenis_barang = $request->jenisbarang;
        $jenisbarang->keterangan = $request->keterangan;

        $jenisbarang->save();
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
        $jenisbarang = JenisBarang::find($id);

        return response()->json($jenisbarang, 200);
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
        $jenisbarang = JenisBarang::find($id);

        $jenisbarang->jenis_barang = $request->jenisbarang;
        $jenisbarang->keterangan = $request->keterangan;

        $jenisbarang->update();

        return response()->json('Data berhasil diupdate !', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenisbarang = JenisBarang::find($id);
        $jenisbarang->delete();

        return response()->json('Data berhasil diupdate !', 200);
    }
}
