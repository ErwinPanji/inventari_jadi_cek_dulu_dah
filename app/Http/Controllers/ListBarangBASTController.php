<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;
use App\Models\Barang;
use App\Models\BAST;
use App\Models\Satuan;
use App\Models\ListBarangBAST;
use App\Models\profilSKPD;


class ListBarangBASTController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode_bast_dist = session('kode_bast_dist');

        $barang = Barang::where('jumlah_instock','>',0)
            ->orderBy('nama_barang')->get();

        $pemohon = Pemohon::find(session('kode_pemohon'));
        // $tanggal_spb = session('tanggal_spb');

        if (! $pemohon) {
            abort(404);
        }

        return view('bastlist.index', compact('kode_bast_dist', 'barang', 'pemohon'));
    }

    public function data($id){
        $bastlist = ListBarangBAST::with('barang')
            ->where('kode_bast_dist', $id)
            ->get();
        $data = array();
        $total_item = 0;
        $keterangan = '';

        foreach ($bastlist as $item) {
            $row = array();
            $row['kode_barang'] = '<span class="badge badge-success">'. $item->barang['kode_barang'] .'</span';
            $row['nama_barang'] = $item->barang['nama_barang'];
            $row['stok'] = $item->instock;
            $row['jumlah_permintaan']      = '<input type="number" class="input-sm quantity" data-id="'. $item->kode_list_barang_bast_dist .'" value="'. $item->jumlah_permintaan .'">';
            $row['satuan']    = $item->barang['satuan'];
            $row['keterangan'] = '<input type="text" class="input-sm keterangan" data-id="'. $item->kode_list_barang_bast_dist .'" value="'. $item->keterangan .'">';
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('bastlist.destroy', $item->kode_list_barang_bast_dist) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;
        }
        // $data[] = [
        //     'kode_barang' => '',
        //     'nama_barang' => '',
        //     'jumlah_permintaan'  => '',
        //     'satuan'      => '',
        //     'keterangan' => '',
        //     'aksi'        => '',
        // ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_barang', 'jumlah_permintaan','keterangan','total_item'])
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
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        if (! $barang) {
            return response()->json('Data gagal disimpan', 400);
        }

        $bastlist = new ListBarangBAST();
        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $bastlist->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'LB'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = ListBarangBAST::where('kode_list_barang_bast_dist', $kode_generator)->count();
        $kode_list_barang_bast_dist = '';

        if($checkIt > 0){
            $kode_list_barang_bast_dist = 'LB'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_list_barang_bast_dist = $kode_generator;
        }

        $bastlist->kode_list_barang_bast_dist = $kode_list_barang_bast_dist;
        $bastlist->kode_bast_dist = $request->kode_bast_dist;
        $bastlist->kode_barang = $barang->kode_barang;
        $bastlist->instock = $barang->jumlah_instock;
        $bastlist->satuan = $barang->satuan;
        $bastlist->jumlah_permintaan = 1;
        $bastlist->keterangan = '';
        $bastlist->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $bastlist = ListBarangBAST::find($id);
        if($request->jumlah == ''){
            $bastlist->jumlah_permintaan = $bastlist->jumlah_permintaan;
        }else{
            $bastlist->jumlah_permintaan = $request->jumlah;
        }

        if($request->keterangan == ''){
            $bastlist->keterangan = $bastlist->keterangan;
        }else{
            $bastlist->keterangan = $request->keterangan;
        }
        
        $bastlist->update();
    }

    public function updateket(Request $request, $id)
    {
        $bastlist = ListBarangBAST::find($id);
        $bastlist->keterangan = $request->keterangan;
        $bastlist->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bastlist = ListBarangBAST::find($id);
        $bastlist->delete();

        return response(null, 204);
    }
}
