<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;

    protected $table = 'tbl_pemohon';
    protected $primaryKey = 'kode_pemohon';
    public $incrementing = false;
    protected $guarded = [];
}
