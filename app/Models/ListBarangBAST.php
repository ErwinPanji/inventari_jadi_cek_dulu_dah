<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBarangBAST extends Model
{
    use HasFactory;

    protected $table = 'tbl_list_barang_bast_dist';
    protected $primaryKey = 'kode_list_barang_bast_dist';
    public $incrementing = false;
    protected $guarded = [];

    public function barang()
    {
        return $this->hasOne(Barang::class, 'kode_barang', 'kode_barang');
    }
}
