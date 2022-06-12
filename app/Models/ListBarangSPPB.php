<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBarangSPPB extends Model
{
    use HasFactory;

    protected $table = 'tbl_list_barang_sppb';
    protected $primaryKey = 'kode_list_barang_sppb';
    public $incrementing = false;
    protected $guarded = [];

    public function barang()
    {
        return $this->hasOne(Barang::class, 'kode_barang', 'kode_barang');
    }
}
