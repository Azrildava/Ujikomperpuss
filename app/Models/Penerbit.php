<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    public function penerbit()
{
    return $this->hasMany(Penerbit::class, 'id_penerbit');
}

}


