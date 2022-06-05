<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'tbl_jenis_barang';
    protected $primaryKey = 'kode_jenis_barang';
    public $incrementing = false;
    protected $guarded = [];
}
