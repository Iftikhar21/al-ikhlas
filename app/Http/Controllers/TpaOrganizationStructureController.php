<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TpaOrganizationStructure;

class TpaOrganizationStructureController extends Controller
{
    public function index()
    {
        $structure = TpaOrganizationStructure::first();
        return view('admin.tpa.structure.index', compact('structure'));
    }

    public function create()
    {
        return view('admin.tpa.structure.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('tpa/struktur-organisasi', 'public');

        TpaOrganizationStructure::create([
            'image' => $path,
        ]);

        return redirect()->route('admin.tpa.structure.index')->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function edit(TpaOrganizationStructure $structure)
    {
        return view('admin.tpa.structure.edit', compact('structure'));
    }

    public function update(Request $request, TpaOrganizationStructure $structure)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            if ($structure->image) {
                Storage::disk('public')->delete($structure->image);
            }
            $data['image'] = $request->file('image')->store('koperasi/struktur-organisasi', 'public');
        }

        $structure->update($data);

        return redirect()->route('admin.tpa.structure.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function destroy(TpaOrganizationStructure $structure)
    {
        if ($structure->image) {
            Storage::disk('public')->delete($structure->image);
        }

        $structure->delete();

        return redirect()->route('admin.tpa.structure.index')->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
