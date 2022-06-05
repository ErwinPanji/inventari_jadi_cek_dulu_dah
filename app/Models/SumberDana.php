<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    use HasFactory;

    protected $table = 'tbl_sumber_dana';
    protected $primaryKey = 'kode_sumber_dana';
    public $incrementing = false;
    protected $guarded = [];
}
