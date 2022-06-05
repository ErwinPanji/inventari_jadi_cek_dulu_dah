<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    use HasFactory;

    protected $table = 'tbl_satuan';
    protected $primaryKey = 'kode_satuan';
    public $incrementing = false;
    protected $guarded = [];
}
