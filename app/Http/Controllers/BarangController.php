<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\satuan;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisbarang = JenisBarang::all()->pluck('jenis_barang','kode_jenis_barang');
        $satuan = satuan::all()->pluck('nama_satuan','kode_satuan');

        return view('barang.index',compact('jenisbarang','satuan'));
    }

    public function data(){
        $barang = Barang::leftJoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_barang.kode_jenis_barang')
        ->select('tbl_barang.*','jenis_barang')
        ->orderBy('kode_barang', 'desc')
        ->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addColumn('jenis_kategori', function($barang){
                return $barang->jenis_barang;
            })
            ->addColumn('aksi', function ($barang){
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('barang.update', $barang->kode_barang). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('barang.destroy', $barang->kode_barang). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
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
        $barang = new Barang();

        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $barang->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'BR'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = Barang::where('kode_jenis_barang', $kode_generator)->count();
        $kode_barang = '';

        if($checkIt > 0){
            $kode_barang = 'BR'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_barang = $kode_generator;
        }

        $barang->kode_barang = $kode_barang;
        $barang->kode_jenis_barang = $request->jenis_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->jumlah_instock = 0;
        $barang->satuan = $request->satuan;
        $barang->tanggal_penerimaan_terakhir = date("Y-m-d");
        $barang->tanggal_distribusi = date("Y-m-d");


        $barang->save();
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
        $barang = Barang::find($id);

        return response()->json($barang, 200);
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
        $barang = Barang::find($id);

        $barang->kode_jenis_barang = $request->jenis_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->jumlah_instock = 0;
        $barang->satuan = $request->satuan;
        $barang->tanggal_penerimaan_terakhir = date("Y-m-d");
        $barang->tanggal_distribusi = date("Y-m-d");

        $barang->update();

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
        $barang = Barang::find($id);
        $barang->delete();

        return response()->json('Data berhasil diupdate !', 200);
    }
}
