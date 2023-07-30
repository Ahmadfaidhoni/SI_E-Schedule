<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'data-kegiatan';
        return view('dashboard.kegiatan.data-kegiatan', compact('active_menu'), [
            "kegiatan" => Kegiatan::orderBy('kode_kegiatan', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_menu = 'data-kegiatan';
        return view('dashboard.kegiatan.add-kegiatan', compact('active_menu'), [
            "kegiatan" => Kegiatan::orderBy('kode_kegiatan', 'ASC')->get()
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
            'kode_kegiatan' => 'required|unique:kegiatans',
            'nama_kegiatan' => 'required',
        ]);

        Kegiatan::create($validatedData);

        Alert::success('Congrats', 'Kegiatan Berhasil dibuat!');

        return redirect('/data-kegiatan');
        // return redirect('/data-kegiatan')->with('success', 'Kegiatan Berhasil dibuat.');
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
    public function edit(Kegiatan $kegiatan)
    {
        $active_menu = 'data-kegiatan';
        return view('dashboard.kegiatan.edit-kegiatan', compact('active_menu'), [
            "kegiatan" => $kegiatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validatedData = $request->validate([
            'kode_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
        ]);

        Kegiatan::where('id', $kegiatan->id)->update($validatedData);

        Alert::success('Congrats', 'Kegiatan Berhasil diubah!');

        return redirect('/data-kegiatan');
        // return redirect('/data-kegiatan')->with('success', 'Kegiatan Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        Kegiatan::destroy($kegiatan->id);

        Alert::success('Congrats', 'Kegiatan Berhasil dihapus!');

        return redirect('/data-kegiatan');
        // return redirect('/data-kegiatan')->with('success', 'Kegiatan Berhasil dihapus.');
    }
}
