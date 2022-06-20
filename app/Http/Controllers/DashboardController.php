<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;
use App\Models\Barang;
use App\Models\ListBarangBast;
use App\Models\PenerimaanBarang;
use App\Models\Satuan;


class DashboardController extends Controller
{
    public function index(){
        $barang = Barang::sum('jumlah_instock');
        $pemohon = Pemohon::count();
        $listBarang = ListBarangBast::sum('jumlah_permintaan');
        $penerimaan = PenerimaanBarang::sum('jumlah_barang');

        return view('admin.home',compact('barang','pemohon','listBarang','penerimaan'));
    }
}
