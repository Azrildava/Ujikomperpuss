<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function pinjamBuku($id)
    {
        // Cek apakah buku tersedia
        $buku = Buku::findOrFail($id);

        // Simpan data peminjaman ke database
        Peminjaman::create([
            'user_id'         => Auth::id(),
            'buku_id'         => $buku->id,
            'tanggal_pinjam'  => now(), //Atur default peminjaman selama 7 hari
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dipinjam!');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
