<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerbit = Penerbit::latest()->paginate(5);
        return view('admin.penerbit.index', compact('penerbit'));
    }

    public function create()
    {
        return view('admin.penerbit.create');
    }

    public function store(Request $request)
    {
        //validate form
       $validator = Validator::make($request->all(), [
            'nama_penerbit' => 'required|unique:penerbits,nama_penerbit',
        ]);

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all());
            Alert::error('Gagal', 'Gagal: ' . $errorMessages)->autoClose(2000);
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $penerbit = new Penerbit();
        $penerbit->nama_penerbit = $request->nama_penerbit;
        $penerbit->save();

        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(2000);
        return redirect()->route('penerbit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('penerbit.show', compact('penerbit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penerbit = penerbit::findOrFail($id);
        return view('admin.penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_penerbit' => 'required|min:1|max:1000',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->nama_penerbit = $request->nama_penerbit;

        $penerbit->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoclose(1500);
        return redirect()->route('penerbit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();
        return redirect()->route('penerbit.index');
    }
}
