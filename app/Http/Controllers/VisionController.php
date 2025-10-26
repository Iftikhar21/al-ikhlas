<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    public function index()
    {
        $visions = Vision::latest()->get();
        return view('admin.visions.index', compact('visions'));
    }

    public function create()
    {
        return view('admin.visions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vision' => 'required|string',
            'missions' => 'required|array|min:1',
            'missions.*' => 'string'
        ]);

        Vision::create([
            'vision' => $request->vision,
            'missions' => $request->missions,
        ]);

        return redirect()->route('admin.visions.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    public function edit(Vision $vision)
    {
        return view('admin.visions.edit', compact('vision'));
    }

    public function update(Request $request, Vision $vision)
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

    public function destroy(Vision $vision)
    {
        $vision->delete();
        return redirect()->route('admin.visions.index')->with('success', 'Data berhasil dihapus.');
    }
}
