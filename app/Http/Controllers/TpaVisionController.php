<?php

namespace App\Http\Controllers;

use App\Models\TpaVision;
use Illuminate\Http\Request;

class TpaVisionController extends Controller
{
    public function index()
    {
        $visions = TpaVision::latest()->get();
        return view('admin.tpa.visions.index', compact('visions'));
    }

    public function create()
    {
        return view('admin.tpa.visions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vision' => 'required|string',
            'missions' => 'required|array|min:1',
            'missions.*' => 'string'
        ]);

        TpaVision::create([
            'vision' => $request->vision,
            'missions' => $request->missions,
        ]);

        return redirect()->route('admin.tpa.visions.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    public function edit(TpaVision $vision)
    {
        return view('admin.tpa.visions.edit', compact('vision'));
    }

    public function update(Request $request, TpaVision $vision)
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

    public function destroy(TpaVision $vision)
    {
        $vision->delete();
        return redirect()->route('admin.tpa.visions.index')->with('success', 'Data berhasil dihapus.');
    }
}
