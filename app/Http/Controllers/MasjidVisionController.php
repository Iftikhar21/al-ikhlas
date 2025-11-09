<?php

namespace App\Http\Controllers;

use App\Models\MasjidVision;
use Illuminate\Http\Request;

class MasjidVisionController extends Controller
{
    public function index()
    {
        $visions = MasjidVision::latest()->get();
        return view('admin.masjid.visions.index', compact('visions'));
    }

    public function create()
    {
        return view('admin.masjid.visions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vision' => 'required|string',
            'missions' => 'required|array|min:1',
            'missions.*' => 'string'
        ]);

        MasjidVision::create([
            'vision' => $request->vision,
            'missions' => $request->missions,
        ]);

        return redirect()->route('admin.masjid.visions.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    public function edit(MasjidVision $vision)
    {
        return view('admin.masjid.visions.edit', compact('vision'));
    }

    public function update(Request $request, MasjidVision $vision)
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

    public function destroy(MasjidVision $vision)
    {
        $vision->delete();
        return redirect()->route('admin.masjid.visions.index')->with('success', 'Data berhasil dihapus.');
    }
}
