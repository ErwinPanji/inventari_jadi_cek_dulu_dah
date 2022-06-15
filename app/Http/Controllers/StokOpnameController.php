<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\PenerimaanBarang;
use App\Models\JenisBarang;
use App\Models\profilSKPD;
use PDF;

class StokOpnameController extends Controller
{
    public function index(Request $request)
    {
        $jenisbarang = JenisBarang::all()->pluck('jenis_barang','kode_jenis_barang');
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');
        $jenis_barang = 'all';

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir && $request->has('jenis_barang') && $request->jenis_barang) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
            $jenis_barang = $request->jenis_barang; 
        }

        return view('stokopname.index',compact('jenisbarang','tanggalAwal','tanggalAkhir','jenis_barang'));
    }

    public function getData($awal, $akhir, $kode)
    {
        $no = 1;
        $data = array();
        $jumlah_termasuk_ppn = 0;
        $total = 0;

        if($kode == 'all'){
            $inStok = Barang::leftjoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_barang.kode_jenis_barang')
            ->leftjoin('tbl_penerimaan_barang','tbl_penerimaan_barang.kode_barang','tbl_barang.kode_barang')
            ->select('tbl_barang.*','tbl_penerimaan_barang.spesifikasi_barang','tbl_penerimaan_barang.keterangan','tbl_penerimaan_barang.harga_satuan','tbl_jenis_barang.jenis_barang')
            ->whereBetween('tbl_barang.tanggal_penerimaan_terakhir', [$awal, $akhir])
            ->groupBy('tbl_barang.kode_barang')
            ->get();
        }else{
            $inStok = Barang::leftjoin('tbl_jenis_barang','tbl_jenis_barang.kode_jenis_barang','tbl_barang.kode_jenis_barang')
            ->leftjoin('tbl_penerimaan_barang','tbl_penerimaan_barang.kode_barang','tbl_barang.kode_barang')
            ->select('tbl_barang.*','tbl_penerimaan_barang.spesifikasi_barang','tbl_penerimaan_barang.keterangan','tbl_penerimaan_barang.harga_satuan','tbl_jenis_barang.jenis_barang')
            ->whereBetween('tbl_barang.tanggal_penerimaan_terakhir', [$awal, $akhir])
            ->where('tbl_jenis_barang.kode_jenis_barang', $kode)
            ->groupBy('tbl_barang.kode_barang')
            ->get();
        }
        

        foreach ($inStok as $item) {
            $row = array();

            $total_bayar = $item->harga_satuan * $item->jumlah_instock;
            $jumlah_termasuk_ppn = $total_bayar + ($total_bayar*(11/100));
            $total += $jumlah_termasuk_ppn;

            $row['DT_RowIndex'] = $no++;
            $row['nama_barang'] = $item->nama_barang;
            $row['spesifikasi_barang'] = $item->spesifikasi_barang;
            $row['jumlah_instock'] = format_angka($item->jumlah_instock);
            $row['satuan'] = $item->satuan;
            $row['harga_satuan'] = format_angka($item->harga_satuan);
            $row['jumlah_termasuk_ppn'] = format_angka($jumlah_termasuk_ppn);
            $row['keterangan'] = $item->keterangan;

            $data[] = $row;

        }
        $data[] = [
            'DT_RowIndex' => '',
            'nama_barang' => '',
            'spesifikasi_barang' => '' ,
            'jumlah_instock' => '' ,
            'satuan' => '' ,
            'harga_satuan' => 'Total',
            'jumlah_termasuk_ppn' => format_angka($total),
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
            $jenis_barang = "Semua Barang";
        }else{
            $JB = JenisBarang::find($kode);
            $jenis_barang = $JB->jenis_barang;
        }
        

        $data = $this->getData($awal, $akhir, $kode);

        $pdf = PDF::loadview('stokopname.cetak',compact('awal', 'akhir','kode','nama_kepala','nip_kepala','nama_skpd','nama_petugas','nip_petugas','jenis_barang','data'));
    	return $pdf->download('stok_opname'.date('y_m_d'));
    }
}
