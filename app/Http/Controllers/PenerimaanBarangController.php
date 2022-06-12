<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenerimaanBarang;
use App\Models\Penyedia;
use App\Models\SumberDana;
use App\Models\JenisBarang;
use App\Models\satuan;
use App\Models\Barang;

class PenerimaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyedia = Penyedia::all()->pluck('nama_penyedia','kode_penyedia');
        $sumberdana = SumberDana::all()->pluck('sumber_dana','kode_sumber_dana');
        $jenisbarang = JenisBarang::all()->pluck('jenis_barang','kode_jenis_barang');
        $satuan = satuan::all()->pluck('nama_satuan','kode_satuan');
        $barang = Barang::all()->pluck('nama_barang','kode_barang');

        return view('penerimaanbarang.index',compact('penyedia','sumberdana','jenisbarang','satuan','barang'));
    }

    public function data(){
        $penerimaanbarang = PenerimaanBarang::leftJoin('tbl_penyedia','tbl_penyedia.kode_penyedia','tbl_penerimaan_barang.kode_penyedia')
        ->leftJoin('tbl_sumber_dana','tbl_sumber_dana.kode_sumber_dana','tbl_penerimaan_barang.kode_sumber_dana')
        ->leftJoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_penerimaan_barang.kode_jenis_barang')
        ->leftJoin('tbl_barang','tbl_barang.kode_barang','tbl_penerimaan_barang.kode_barang')
        ->select('tbl_penerimaan_barang.*','tbl_penyedia.nama_penyedia','tbl_sumber_dana.sumber_dana','tbl_jenis_barang.jenis_barang','tbl_barang.kode_barang','tbl_barang.nama_barang')
        ->orderBy('kode_penerimaan_barang', 'desc')
        ->get();

        return datatables()
            ->of($penerimaanbarang)
            ->addIndexColumn()
            // ->addColumn('jenis_kategori', function($barang){
            //     return $barang->jenis_barang;
            // })
            ->addColumn('aksi', function ($penerimaanbarang){
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('penerimaanbarang.update', $penerimaanbarang->kode_penerimaan_barang). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('penerimaanbarang.destroy', $penerimaanbarang->kode_penerimaan_barang). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
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
        $penerimaanbarang = new PenerimaanBarang();

        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $penerimaanbarang->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'PB'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = PenerimaanBarang::where('kode_jenis_barang', $kode_generator)->count();
        $kode_penerimaan_barang = '';

        if($checkIt > 0){
            $kode_penerimaan_barang = 'PB'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_penerimaan_barang = $kode_generator;
        }

        $penerimaanbarang->kode_penerimaan_barang = $kode_penerimaan_barang;
        $penerimaanbarang->tanggal_penerimaan = $request->tanggal_penerimaan;
        $penerimaanbarang->kode_penyedia = $request->kode_penyedia;
        $penerimaanbarang->nomor_tanda_bukti = $request->nomor_bukti;
        $penerimaanbarang->kode_sumber_dana = $request->kode_sumber_dana;
        $penerimaanbarang->tahun_anggaran = $request->tahun_anggaran;
        $penerimaanbarang->bulan = $request->bulan;
        $penerimaanbarang->kode_jenis_barang = $request->kode_jenis_barang;

        $kode_barang = explode("-",$request->kode_barang);
        $penerimaanbarang->nama_barang =  $kode_barang[1];
        $penerimaanbarang->kode_barang = $kode_barang[0];

        $penerimaanbarang->spesifikasi_barang = $request->spesifikasi;
        $penerimaanbarang->jumlah_barang = $request->jumlah_barang;
        $penerimaanbarang->satuan_barang = $request->satuan;
        $penerimaanbarang->harga_satuan = $request->harga_satuan;
        $penerimaanbarang->subtotal = $request->subtotal;
        $penerimaanbarang->ppn = $request->ppn;
        $penerimaanbarang->total = $request->total;
        $penerimaanbarang->keterangan = $request->keterangan;

        if($penerimaanbarang->save()){
            $barang = Barang::where('kode_barang', $kode_barang[0])->first();

            $barang->jumlah_instock = $barang->jumlah_instock + $request->jumlah_barang;     
            $barang->tanggal_penerimaan_terakhir = $request->tanggal_penerimaan;

            $barang->update();
        }
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
        $penerimaanbarang = PenerimaanBarang::find($id);

        return response()->json($penerimaanbarang, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $penerimaanbarang = PenerimaanBarang::find($id);

        $penerimaanbarang->tanggal_penerimaan = $request->tanggal_penerimaan;
        $penerimaanbarang->kode_penyedia = $request->kode_penyedia;
        $penerimaanbarang->nomor_tanda_bukti = $request->nomor_bukti;
        $penerimaanbarang->kode_sumber_dana = $request->kode_sumber_dana;
        $penerimaanbarang->tahun_anggaran = $request->tahun_anggaran;
        $penerimaanbarang->bulan = $request->bulan;
        $penerimaanbarang->kode_jenis_barang = $request->kode_jenis_barang;

        $kode_barang = explode("-",$request->kode_barang);
        $penerimaanbarang->nama_barang =  $kode_barang[1];
        $penerimaanbarang->kode_barang = $kode_barang[0];

        $penerimaanbarang->spesifikasi_barang = $request->spesifikasi;
        $penerimaanbarang->jumlah_barang = $request->jumlah_barang;
        $penerimaanbarang->satuan_barang = $request->satuan;
        $penerimaanbarang->harga_satuan = $request->harga_satuan;
        $penerimaanbarang->subtotal = $request->subtotal;
        $penerimaanbarang->ppn = $request->ppn;
        $penerimaanbarang->total = $request->total;
        $penerimaanbarang->keterangan = $request->keterangan;

        if($penerimaanbarang->update()){
            $barang = Barang::where('kode_barang', $kode_barang[0])->first();

            if($barang->jumlah_instock != 0 AND $barang->tanggal_penerimaan_terakhir == $request->tanggal_penerimaan){
                $barang->jumlah_instock = 0 + $request->jumlah_barang;  
            }else{
                $barang->jumlah_instock = $barang->jumlah_instock + $request->jumlah_barang;     
                $barang->tanggal_penerimaan_terakhir = $request->tanggal_penerimaan;
            }
            // 

            $barang->update();
        }

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
        $penerimaanbarang = PenerimaanBarang::find($id);
        $penerimaanbarang->delete();

        return response()->json('Data berhasil diupdate !', 200);
    }
}
