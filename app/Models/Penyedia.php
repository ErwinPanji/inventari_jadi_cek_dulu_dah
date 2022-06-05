<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyedia extends Model
{
    use HasFactory;

    protected $table = 'tbl_penyedia';
    protected $primaryKey = 'kode_penyedia';
    public $incrementing = false;
    protected $guarded = [];
}
