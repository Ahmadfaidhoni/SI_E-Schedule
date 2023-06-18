<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.golongan.data-golongan', [
            "golongan" => Golongan::orderBy('jenis_golongan', 'ASC')->orderBy('ruang', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.golongan.add-golongan', [
            "golongan" => Golongan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pangkat' => 'required',
            'jenis_golongan' => 'required',
            'ruang' => 'required'
        ]);

        Golongan::create($validatedData);

        Alert::success('Congrats', 'Golongan Berhasil dibuat!');

        return redirect('/data-golongan');
        // return redirect('/data-golongan')->with('success', 'Golongan Berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Golongan $golongan)
    {
        return view('dashboard.golongan.edit-golongan', [
            "golongan" => $golongan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Golongan $golongan)
    {
        $validatedData = $request->validate([
            'nama_pangkat' => 'required',
            'jenis_golongan' => '',
            'ruang' => ''
        ]);

        Golongan::where('id', $golongan->id)->update($validatedData);

        Alert::success('Congrats', 'Golongan Berhasil diubah!');

        return redirect('/data-golongan');
        // return redirect('/data-golongan')->with('success', 'Golongan Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Golongan $golongan)
    {
        Golongan::destroy($golongan->id);
        
        Alert::success('Congrats', 'Golongan Berhasil dihapus!');

        return redirect('/data-golongan');
        // return redirect('/data-golongan')->with('success', 'Golongan Berhasil dihapus.');
    }
}