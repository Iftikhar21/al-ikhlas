<?php

namespace App\Http\Controllers;

use App\Models\KoperasiVision;
use Illuminate\Http\Request;

class KoperasiVisionController extends Controller
{
    public function index()
    {
        $visions = KoperasiVision::latest()->get();
        return view('admin.koperasi.visions.index', compact('visions'));
    }

    public function create()
    {
        return view('admin.koperasi.visions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vision' => 'required|string',
            'missions' => 'required|array|min:1',
            'missions.*' => 'string'
        ]);

        KoperasiVision::create([
            'vision' => $request->vision,
            'missions' => $request->missions,
        ]);

        return redirect()->route('admin.koperasi.visions.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    public function edit(KoperasiVision $vision)
    {
        return view('admin.koperasi.visions.edit', compact('vision'));
    }

    public function update(Request $request, KoperasiVision $vision)
    {
        $request->validate([
            'vision' => 'required|string',
            'missions' => 'required|array|min:1',
            'missions.*' => 'string'
        ]);

        $vision->update([
            'vision' => $request->vision,
            'missions' => $request->missions,
        ]);

        return redirect()->route('admin.visions.index')->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    public function destroy(KoperasiVision $vision)
    {
        $vision->delete();
        return redirect()->route('admin.koperasi.visions.index')->with('success', 'Data berhasil dihapus.');
    }
}
