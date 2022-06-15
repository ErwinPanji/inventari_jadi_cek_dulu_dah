<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListBarangSPPB;
use App\Models\Pemohon;
use App\Models\Barang;


class ListBarangSPPBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode_sppb = session('kode_sppb');

        $barang = Barang::where('jumlah_instock','>',0)
            ->orderBy('nama_barang')->get();

        $pemohon = Pemohon::find(session('kode_pemohon'));
        $tanggal_spb = session('tanggal_spb');

        if (! $pemohon) {
            abort(404);
        }

        return view('sppblist.index', compact('kode_sppb', 'barang', 'pemohon','tanggal_spb'));
    }

    public function data($id){
        $sppblist = ListBarangSPPB::with('barang')
            ->where('kode_sppb', $id)
            ->get();
        $data = array();
        $total_item = 0;
        $keterangan = '';

        foreach ($sppblist as $item) {
            $row = array();
            $row['kode_barang'] = '<span class="badge badge-success">'. $item->barang['kode_barang'] .'</span';
            $row['nama_barang'] = $item->barang['nama_barang'];
            $row['jumlah_permintaan']      = '<input type="number" class="input-sm quantity" data-id="'. $item->kode_list_barang_sppb .'" value="'. $item->jumlah_permintaan .'">';
            $row['satuan']    = $item->barang['satuan'];
            $row['keterangan'] = '<input type="text" class="input-sm keterangan" data-id="'. $item->kode_list_barang_sppb .'" value="'. $item->keterangan .'">';
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('sppblist.destroy', $item->kode_list_barang_sppb) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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

        $sppblist = new ListBarangSPPB();
        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $sppblist->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'LS'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = ListBarangSPPB::where('kode_list_barang_sppb', $kode_generator)->count();
        $kode_list_barang_sppb = '';

        if($checkIt > 0){
            $kode_list_barang_sppb = 'LS'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_list_barang_sppb = $kode_generator;
        }

        $sppblist->kode_list_barang_sppb = $kode_list_barang_sppb;
        $sppblist->kode_sppb = $request->kode_sppb;
        $sppblist->kode_barang = $barang->kode_barang;
        $sppblist->satuan = $barang->satuan;
        $sppblist->jumlah_permintaan = 1;
        $sppblist->keterangan = '';
        $sppblist->save();

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
        $sppblist = ListBarangSPPB::find($id);
        if($request->jumlah == ''){
            $sppblist->jumlah_permintaan = $sppblist->jumlah_permintaan;
        }else{
            $sppblist->jumlah_permintaan = $request->jumlah;
        }

        if($request->keterangan == ''){
            $sppblist->keterangan = $sppblist->keterangan;
        }else{
            $sppblist->keterangan = $request->keterangan;
        }
        
        $sppblist->update();
    }

    public function updateket(Request $request, $id)
    {
        $sppblist = ListBarangSPPB::find($id);
        $sppblist->keterangan = $request->keterangan;
        $sppblist->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sppblist = ListBarangSPPB::find($id);
        $sppblist->delete();

        return response(null, 204);
    }

    // public function loadForm(){

    // }
}
