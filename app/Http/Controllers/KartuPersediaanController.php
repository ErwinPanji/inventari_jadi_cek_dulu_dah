<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\PenerimaanBarang;
use App\Models\JenisBarang;
use App\Models\profilSKPD;
use App\Models\ListBarangBAST;
use PDF;

class KartuPersediaanController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::all()->pluck('nama_barang','kode_barang');
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');
        $kode_barang = 'all';
        $nama_barang = "Semua Barang";
        $satuan = "Semua Satuan";

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir && $request->has('kode_barang') && $request->kode_barang) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
            $kode_barang = $request->kode_barang; 


            if($kode_barang == 'all'){
                $nama_barang = "Semua Barang";
                $satuan = "Semua Satuan";
            }else{
                $JB = Barang::find($kode_barang);
                $nama_barang = $JB->nama_barang;
                $satuan = $JB->satuan;
            }
        }

        return view('kartupersediaan.index',compact('barang','tanggalAwal','tanggalAkhir','kode_barang','nama_barang','satuan'));
    }

    public function getData($awal, $akhir, $kode)
    {
        $no = 1;
        $data = array();
        $jumlah_termasuk_ppn = 0;
        $total = 0;
        $sisa = 0;

        if($kode == 'all'){
            // $inStok = array();
            // $outStok = array();

            $inStok = PenerimaanBarang::leftjoin('tbl_barang','tbl_penerimaan_barang.kode_barang','tbl_barang.kode_barang')
                ->leftjoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_barang.kode_jenis_barang')
                ->select('tbl_penerimaan_barang.*','tbl_barang.nama_barang','tbl_jenis_barang.jenis_barang')
                ->whereBetween('tbl_penerimaan_barang.tanggal_penerimaan', [$awal, $akhir])
                ->get();

            $outStok = ListBarangBAST::leftjoin('tbl_bast_dist','tbl_bast_dist.kode_bast_dist','tbl_list_barang_bast_dist.kode_bast_dist')
                ->leftjoin('tbl_barang','tbl_list_barang_bast_dist.kode_barang','tbl_barang.kode_barang')
                ->leftjoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_barang.kode_jenis_barang')
                ->select('tbl_list_barang_bast_dist.*','tbl_bast_dist.tanggal_sppb','tbl_barang.kode_barang','tbl_barang.jumlah_instock',
                        'tbl_barang.nama_barang','tbl_jenis_barang.kode_jenis_barang','tbl_jenis_barang.jenis_barang',
                        )
                ->whereBetween('tbl_bast_dist.tanggal_sppb', [$awal, $akhir])
                ->get();

        }else{
            $inStok = PenerimaanBarang::leftjoin('tbl_barang','tbl_penerimaan_barang.kode_barang','tbl_barang.kode_barang')
                ->leftjoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_barang.kode_jenis_barang')
                ->select('tbl_penerimaan_barang.*','tbl_barang.nama_barang','tbl_jenis_barang.jenis_barang')
                ->whereBetween('tbl_penerimaan_barang.tanggal_penerimaan', [$awal, $akhir])
                ->where('tbl_penerimaan_barang.kode_barang',$kode)
                ->get();

            $outStok = ListBarangBAST::leftjoin('tbl_bast_dist','tbl_bast_dist.kode_bast_dist','tbl_list_barang_bast_dist.kode_bast_dist')
                ->leftjoin('tbl_barang','tbl_list_barang_bast_dist.kode_barang','tbl_barang.kode_barang')
                ->leftjoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_barang.kode_jenis_barang')
                ->select('tbl_list_barang_bast_dist.*','tbl_bast_dist.tanggal_sppb','tbl_barang.kode_barang','tbl_barang.jumlah_instock',
                        'tbl_barang.nama_barang','tbl_jenis_barang.kode_jenis_barang','tbl_jenis_barang.jenis_barang',
                        )
                ->whereBetween('tbl_bast_dist.tanggal_sppb', [$awal, $akhir])
                ->where('tbl_list_barang_bast_dist.kode_barang',$kode)
                ->get();
        }

        foreach ($inStok as $item) {
            $row = array();

            $total_bayar = $item->jumlah_barang * $item->harga_satuan;
            $total += $total_bayar;
         
            $sisa = $item->jumlah_barang + $item->instock;

            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = indo_date($item->tanggal_penerimaan,false);
            $row['jumlah_barang_masuk'] = $item->jumlah_barang;
            $row['harga_satuan_masuk'] = format_angka($item->harga_satuan);
            $row['total_harga_masuk'] = format_angka($total_bayar);
            $row['keluar'] = '';
            $row['sisa'] = $sisa;
            $row['keterangan'] = $item->nama_barang;

            $data[] = $row;

        }
        
        foreach ($outStok as $item) {
            $row = array();

            $sisa = $item->instock - $item->jumlah_permintaan;

            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = indo_date($item->tanggal_sppb,false);
            $row['jumlah_barang_masuk'] = '';
            $row['harga_satuan_masuk'] = '';
            $row['total_harga_masuk'] = '';
            $row['keluar'] = $item->jumlah_permintaan;
            $row['sisa'] = $sisa;
            $row['keterangan'] = $item->nama_barang;

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'jumlah_barang_masuk' => '' ,
            'harga_satuan_masuk' => 'Total' ,
            'total_harga_masuk' => format_angka($total) ,
            'keluar' => '',
            'sisa' => '',
            'keterangan' => ''
        ];

        return $data;
    }

    public function data($awal, $akhir, $kode)
    {
        $data = $this->getData($awal, $akhir ,$kode);

        return datatables()
            ->of($data)
            // ->addIndexColumn()
            ->make(true);
    }

    public function exportPDF($awal, $akhir, $kode){
        $setting = profilSKPD::first();
        $nama_kepala = $setting->nama_kepala;
        $nip_kepala = $setting->nip_kepala;
        $nama_skpd = $setting->nama_skpd_ukpd;
        $nama_petugas = $setting->nama_pengurus;
        $nip_petugas = $setting->nip_pengurus;

        if($kode == 'all'){
            $nama_barang = "Semua Barang";
            $satuan = "Semua Satuan";
        }else{
            $JB = Barang::find($kode);
            $nama_barang = $JB->nama_barang;
            $satuan = $JB->satuan;
        }
        

        $data = $this->getData($awal, $akhir, $kode);

        $pdf = PDF::loadview('kartupersediaan.cetak',compact('awal', 'akhir','kode','nama_kepala','nip_kepala','nama_skpd','nama_petugas','nip_petugas','nama_barang','satuan','data'));
    	return $pdf->download('kartu_persediaan'.date('y_m_d').'.pdf');
    }
}
