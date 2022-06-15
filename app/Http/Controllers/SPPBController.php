<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;
use App\Models\Barang;
use App\Models\SPPB;
use App\Models\Satuan;
use App\Models\ListBarangSPPB;
use App\Models\profilSKPD;

use PDF;


class SPPBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemohon = Pemohon::orderBy('nama_pemohon')->get();
        // $barang = Barang::where('jumlah_instock', ">", 0)->get();
        return view('sppb.index',compact('pemohon'));
    }

    public function data(){
        $sppb = SPPB::leftJoin('tbl_pemohon','tbl_pemohon.kode_pemohon','tbl_sppb.kode_pemohon')
        ->select('tbl_sppb.*','nama_pemohon')
        ->orderBy('kode_pemohon', 'desc')
        ->get();

        return datatables()
            ->of($sppb)
            ->addIndexColumn()
            ->addColumn('nama_pemohon', function($sppb){
                return $sppb->nama_pemohon;
            })
            ->addColumn('aksi', function ($sppb){
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('sppb.show', $sppb->kode_sppb). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('sppb.destroy', $sppb->kode_sppb). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
                    <a href="'. route('sppb.cetakpdf', $sppb->kode_sppb). '" target="_blank" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-print"></i></a>
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
    public function create($id)
    {
        $sppb = new SPPB();
        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $sppb->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'SP'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = SPPB::where('kode_sppb', $kode_generator)->count();
        $kode_sppb = '';

        if($checkIt > 0){
            $kode_sppb = 'SP'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_sppb = $kode_generator;
        }

        $sppb->kode_sppb = $kode_sppb;
        $sppb->nomor_spb = '';
        $sppb->kode_pemohon = $id;
        $sppb->tanggal_spb = date("Y-m-d");

        $sppb->save();

        session(['kode_sppb' => $sppb->kode_sppb]);
        session(['kode_pemohon' => $sppb->kode_pemohon]);
        // session(['tanggal_spb' => $sppb->tanggal_spb]);

        return redirect()->route('sppblist.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sppb = SPPB::findOrFail($request->kode_sppb);
        $sppb->nomor_spb = $request->nomor_spb;
        $sppb->tanggal_spb = $request->tanggal_spb;
        $sppb->update();

        // $sppblist = ListBarangSPPB::where('kode_sppb', $sppb->id_sppb)->get();
        // foreach ($sppblist as $item) {
        //     $produk = Produk::find($item->id_produk);
        //     $produk->stok += $item->jumlah;
        //     $produk->update();
        // }

        session(['kode_sppb' => '']);
        session(['kode_pemohon' => '']);
        return redirect()->route('sppb.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sppblist = ListBarangSPPB::with('barang')->where('kode_sppb', $id)->get();

        return datatables()
            ->of($sppblist)
            ->addIndexColumn()
            // ->addColumn('kode_barang', function ($sppblist) {
            //     return '<span class="badge badge-success">'. $sppblist->barang->kode_barang .'</span>';
            // })
            ->addColumn('nama_barang', function ($sppblist) {
                return $sppblist->barang->nama_barang;
            })
            ->addColumn('jumlah', function ($sppblist) {
                // return $sppblist->jumlah_permintaan;
                return '<input type="number" class="input-sm quantity" data-id="'. $sppblist->kode_list_barang_sppb .'" value="'. $sppblist->jumlah_permintaan .'">';
            })
            ->addColumn('satuan', function ($sppblist) {
                return $sppblist->barang->satuan;
            })
            ->addColumn('keterangan', function ($sppblist) {
                return $sppblist->keterangan;
            })
            ->addColumn('aksi', function ($sppblist){
                return '<div class="btn-group">
                            <button onclick="deleteDetail(`'. route('sppblist.destroy', $sppblist->kode_list_barang_sppb) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                        </div>';
            })
            ->rawColumns(['aksi','jumlah'])
            ->make(true);
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
        $sppb = SPPB::find($id);
        $sppblist = ListBarangSPPB::where('kode_sppb', $sppb->kode_sppb)->get();
        foreach ($sppblist as $item) {
            // $produk = Produk::find($item->id_produk);
            // if ($produk) {
            //     $produk->stok -= $item->jumlah;
            //     $produk->update();
            // }
            $item->delete();
        }

        $sppb->delete();
        session(['kode_sppb' => '']);
        session(['kode_pemohon' => '']);
        session(['tanggal_spb' => '']);

        return response(null, 204);
    }

    public function cetakpdf($id)
    {
    	$sppb = SPPB::find($id);     
        $sppblist = ListBarangSPPB::with('barang')
            ->where('kode_sppb', $id)
            ->get();

        

        $setting = profilSKPD::first();
        $nama_kepala = $setting->nama_kepala;
        $nip_kepala = $setting->nip_kepala;
        $nama_skpd = $setting->nama_skpd_ukpd;     

        $nomor_spb = $sppb->nomor_spb;
        $tanggal_spb = indo_date($sppb->tanggal_spb,false);

        $pemohon = Pemohon::find($sppb->kode_pemohon);

        $jabatan_pemohon = $pemohon->jabatan;

    	$pdf = PDF::loadview('sppb.cetak',compact('nomor_spb','tanggal_spb','sppblist','nama_kepala','nip_kepala','nama_skpd','jabatan_pemohon'));
    	return $pdf->download('SPPB_'.$nomor_spb);
    }
}
