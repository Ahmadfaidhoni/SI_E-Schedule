<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'data-ruangan';
        return view('dashboard.ruangan.data-ruangan', compact('active_menu'), [
            "ruangan" => Ruangan::orderBy('nama_ruangan', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ruangan.add-ruangan', [
            "ruangan" => Ruangan::all()
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
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'gedung' => 'required',
            'lantai' => 'required'
        ]);

        Ruangan::create($validatedData);

        Alert::success('Congrats', 'Ruangan Berhasil dibuat!');

        return redirect('/data-ruangan');
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
    public function edit(Ruangan $ruangan)
    {
        return view('dashboard.ruangan.edit-ruangan', [
            "ruangan" => $ruangan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $validatedData = $request->validate([
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'gedung' => 'required',
            'lantai' => 'required'
        ]);

        Ruangan::where('id', $ruangan->id)->update($validatedData);

        Alert::success('Congrats', 'Ruangan Berhasil diubah!');

        return redirect('/data-ruangan');
        // return redirect('/data-golongan')->with('success', 'Golongan Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        Ruangan::destroy($ruangan->id);

        Alert::success('Congrats', 'Ruangan Berhasil dihapus!');

        return redirect('/data-ruangan');
        // return redirect('/data-golongan')->with('success', 'Golongan Berhasil dihapus.');
    }
}
