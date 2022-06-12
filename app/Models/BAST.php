<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BAST extends Model
{
    use HasFactory;

    protected $table = 'tbl_bast_dist';
    protected $primaryKey = 'kode_bast_dist';
    public $incrementing = false;
    protected $guarded = [];
}
