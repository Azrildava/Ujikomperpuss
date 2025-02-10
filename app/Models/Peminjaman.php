<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = "nama_penerbit";
    protected $visible = "nama_penerbit";
    protected $timestamps = true;
}
