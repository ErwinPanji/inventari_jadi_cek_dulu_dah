<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilSKPD extends Model
{
    use HasFactory;

    protected $table = 'tbl_profil_skpd_ukpd';
    protected $primaryKey = 'kode_profil';
    public $incrementing = false;
    protected $guarded = [];
}
