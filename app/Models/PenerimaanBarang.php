<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBarang extends Model
{
    use HasFactory;

    protected $table = 'tbl_penerimaan_barang';
    protected $primaryKey = 'kode_penerimaan_barang';
    public $incrementing = false;
    protected $guarded = [];
}
