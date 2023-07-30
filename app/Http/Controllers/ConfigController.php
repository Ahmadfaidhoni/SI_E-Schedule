<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $active_menu = 'config';
        $config = Config::get();
        return view('dashboard.config.index', compact('active_menu', 'config'));
    }

    public function update(Request $request)
    {
        try {
            Config::where('id', $request->id)->update([
                'value' => $request->value,
            ]);

            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
