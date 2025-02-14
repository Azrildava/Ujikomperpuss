<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::latest()->paginate(5);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        //validate form
       $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
        ]);

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all());
            Alert::error('Gagal', 'Gagal: ' . $errorMessages)->autoClose(2000);
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(2000);
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = kategori::findOrFail($id);
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|min:1|max:1000',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;

        $kategori->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoclose(1500);
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index');
    }
}
