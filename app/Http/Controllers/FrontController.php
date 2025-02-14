<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function daftarBuku()
    {
        $buku = buku::all();
        return view('user.daftarBuku', compact('buku'));
    }
}
