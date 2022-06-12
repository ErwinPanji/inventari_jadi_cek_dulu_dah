<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPPB extends Model
{
    use HasFactory;

    protected $table = 'tbl_sppb';
    protected $primaryKey = 'kode_sppb';
    public $incrementing = false;
    protected $guarded = [];
}
