<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;
use App\Models\Barang;
use App\Models\BAST;
use App\Models\Satuan;
use App\Models\ListBarangBAST;
use App\Models\profilSKPD;

use PDF;

class BASTController extends Controller
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
        return view('bast.index',compact('pemohon'));
    }

    public function data(){
        $bast = BAST::leftJoin('tbl_pemohon','tbl_pemohon.kode_pemohon','tbl_bast_dist.kode_pemohon')
        ->select('tbl_bast_dist.*','nama_pemohon')
        ->orderBy('kode_pemohon', 'desc')
        ->get();

        return datatables()
            ->of($bast)
            ->addIndexColumn()
            ->addColumn('nama_pemohon', function($bast){
                return $bast->nama_pemohon;
            })
            ->addColumn('aksi', function ($bast){
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('bast.show', $bast->kode_bast_dist). '`)" class="btn btn-sm btn-primary btn-flat"><i class="fas fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('bast.destroy', $bast->kode_bast_dist). '`)" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
                    <a href="'. route('bast.cetakpdf', $bast->kode_bast_dist). '" target="_blank" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-print"></i></a>
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
        $bast = new BAST();
        $tgl =explode("-",date("Y-m-d"));
        $thn = $tgl[0];
        $bln = $tgl[1];
        $list = $bast->count();

        if($list < 1){
            $angka = 1;
        }else{
            $angka = $list + 1;
        }
        
        $kode_generator = 'DS'.$thn.$bln.substr('000'.$angka, -3);

        $checkIt = BAST::where('kode_bast_dist', $kode_generator)->count();
        $kode_bast_dist = '';

        if($checkIt > 0){
            $kode_bast_dist = 'DS'.$thn.$bln.substr('000'.$angka + 1, -3);
        }else{
            $kode_bast_dist = $kode_generator;
        }

        $bast->kode_bast_dist = $kode_bast_dist;
        $bast->nomor_sppb = '';
        $bast->kode_pemohon = $id;
        $bast->tanggal_sppb = date("Y-m-d");

        $bast->save();

        session(['kode_bast_dist' => $bast->kode_bast_dist]);
        session(['kode_pemohon' => $bast->kode_pemohon]);
        // session(['tanggal_spb' => $bast->tanggal_spb]);

        return redirect()->route('bastlist.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bast = BAST::findOrFail($request->kode_bast_dist);
        $bast->nomor_sppb = $request->nomor_sppb;
        $bast->tanggal_sppb = $request->tanggal_sppb;
        $bast->update();

        $bastlist = ListBarangBAST::where('kode_bast_dist', $bast->kode_bast_dist)->get();
        foreach ($bastlist as $item) {
            $barang = Barang::find($item->kode_barang);
            $barang->jumlah_instock -= $item->jumlah_permintaan;
            $barang->tanggal_distribusi = $request->tanggal_sppb;
            $barang->update();
        }

        session(['kode_bast_dist' => '']);
        session(['kode_pemohon' => '']);
        return redirect()->route('bast.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bastlist = ListBarangBAST::with('barang')->where('kode_bast_dist', $id)->get();

        return datatables()
            ->of($bastlist)
            ->addIndexColumn()
            // ->addColumn('kode_barang', function ($bastlist) {
            //     return '<span class="badge badge-success">'. $bastlist->barang->kode_barang .'</span>';
            // })
            ->addColumn('nama_barang', function ($bastlist) {
                return $bastlist->barang->nama_barang;
            })
            ->addColumn('jumlah', function ($bastlist) {
                return $bastlist->jumlah_permintaan;
                // return '<input type="number" class="input-sm quantity" data-id="'. $bastlist->kode_list_barang_bast_dist .'" value="'. $bastlist->jumlah_permintaan .'">';
            })
            ->addColumn('satuan', function ($bastlist) {
                return $bastlist->barang->satuan;
            })
            ->addColumn('keterangan', function ($bastlist) {
                return $bastlist->keterangan;
            })
            ->addColumn('aksi', function ($bastlist){
                return '<div class="btn-group">
                            <button onclick="deleteDetail(`'. route('sppblist.destroy', $bastlist->kode_list_barang_bast_dist) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                        </div>';
            })
            // ->rawColumns(['aksi','jumlah'])
            ->rawColumns(['aksi'])
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
        $bastlist = ListBarangBAST::find($id);
        if($request->jumlah == ''){
            $bastlist->jumlah_permintaan = $bastlist->jumlah_permintaan;
        }else{
            $bastlist->jumlah_permintaan = $request->jumlah;
        }
        
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
        $bast = BAST::find($id);
        $bastlist = ListBarangBAST::where('kode_bast_dist', $bast->kode_bast_dist)->get();
        foreach ($bastlist as $item) {
            $barang = Barang::find($item->kode_barang);
            if($barang){
                $barang->jumlah_instock += $item->jumlah_permintaan;
                $barang->update();
            }
            $item->delete();
        }

        $bast->delete();
        session(['kode_bast_dist' => '']);
        session(['kode_pemohon' => '']);
        session(['tanggal_spb' => '']);

        return response(null, 204);
    }

    public function cetakpdf($id)
    {
    	$bast = BAST::find($id);     
        $bastlist = ListBarangBAST::with('barang')
            ->where('kode_bast_dist', $id)
            ->get();

        $setting = profilSKPD::first();
        $nama_kepala = $setting->nama_kepala;
        $nip_kepala = $setting->nip_kepala;
        $nama_skpd = $setting->nama_skpd_ukpd;    
        
        $nama_petugas = $setting->nama_pengurus;
        $nip_petugas = $setting->nip_pengurus;

        $nomor_sppb = $bast->nomor_sppb;
        $tanggal_sppb = indo_date($bast->tanggal_sppb,false);

        $pemohon = Pemohon::find($bast->kode_pemohon);

        $nama_pemohon = $pemohon->nama_pemohon;
        $nip_pemohon = $pemohon->nip_niiki;

    	$pdf = PDF::loadview('bast.cetak',compact('nomor_sppb','tanggal_sppb','bastlist','nama_kepala','nip_kepala','nama_skpd','nama_pemohon','nip_pemohon','nama_petugas','nip_petugas'));
    	return $pdf->download('BAST_'.$nomor_sppb);
    }
}
