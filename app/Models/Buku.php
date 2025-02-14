<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{

    protected $fillable = ['judul', 'tahun_terbit', 'stok', 'deskripsi', 'kode_buku', 'image'];
    protected $visible  = ['judul', 'tahun_terbit', 'stok', 'deskripsi', 'kode_buku', 'image'];
    public $timestamps  = true;

    public function deleteImage()
    {
        $imagePath = public_path('images/buku/' . $this->fotoBuku);

        if ($this->fotoBuku && file_exists($imagePath)) {
            return unlink($imagePath);
        }

        return false;
    }

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function Penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis');
    }

    public function Penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

}
