<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Penerbit;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;



class BukuController extends Controller
{

    public function index()
    {
        $buku = Buku::orderBy("id", "desc")->get();
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();

        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.buku.index', compact('buku', 'kategori', 'penulis', 'penerbit'));
    }


    public function create()
    {
        $buku = Buku::all();
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();

        return view('admin.buku.create', compact('buku', 'kategori', 'penulis', 'penerbit', ));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|unique:bukus,judul',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'kode_buku' => 'required',
            'id_kategori' => 'required',
            'id_penulis' => 'required',
            'id_penerbit' => 'required',
            'image' => 'required|max:4000|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all());
            Alert::error('Gagal', 'Gagal: ' . $errorMessages)->autoClose(2000);
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $buku = new buku();
        $buku->judul = $request->judul;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        $buku->deskripsi = $request->deskripsi;
        $buku->kode_buku = $request->kode_buku;
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penulis = $request->id_penulis;
        $buku->id_penerbit = $request->id_penerbit;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = rand(2000, 9999) . $img->getClientOriginalName();
            $img->move('images/buku/', $name);
            $buku->image = $name;
        }

        $buku->save();
        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(2000);
        return redirect()->route('buku.index');
    }


    public function show($id)
    {
        $buku = Buku::findorfail($id);
        return view('admin.buku.detail', compact('buku', ));
    }


    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();

        return view('admin.buku.edit', compact('buku', 'kategori', 'penulis', 'penerbit', ));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',
                'tahun_terbit' => 'required',
                'stok' => 'required',
                'deskripsi' => 'required',
                'kode_buku' => 'required',
                'id_kategori' => 'required',
                'id_penulis' => 'required',
                'id_penerbit' => 'required',
                'image' => 'required|max:4000|mimes:jpeg,png,jpg,gif,svg',
            ]
        );

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all());
            Alert::error('Gagal', 'Gagal: ' . $errorMessages)->autoClose(2000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $buku = Buku::findOrFail($id);
        $buku->judul = $request->judul;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        $buku->deskripsi = $request->deskripsi;
        $buku->kode_buku = $request->kode_buku;
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penulis = $request->id_penulis;
        $buku->id_penerbit = $request->id_penerbit;

        if ($request->hasFile('image')) {
            $buku->deleteImage();
            $img = $request->file('image');
            $name = rand(2000, 9999) . $img->getClientOriginalName();
            $img->move('images/buku/', $name);
            $buku->image = $name;
        }

        $buku->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoClose(2000);
        return redirect()->route('buku.index');
    }


    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        Alert::success('Success', 'Data Berhasil Di Hapus')->autoClose(2000);
        return redirect()->route('buku.index');
    }
}
