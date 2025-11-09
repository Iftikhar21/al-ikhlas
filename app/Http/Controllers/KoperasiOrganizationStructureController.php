<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\KoperasiOrganizationStructure;

class KoperasiOrganizationStructureController extends Controller
{
    public function index()
    {
        $structure = KoperasiOrganizationStructure::first();
        return view('admin.koperasi.structure.index', compact('structure'));
    }

    public function create()
    {
        return view('admin.koperasi.structure.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('koperasi/struktur-organisasi', 'public');

        KoperasiOrganizationStructure::create([
            'image' => $path,
        ]);

        return redirect()->route('admin.koperasi.structure.index')->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function edit(KoperasiOrganizationStructure $structure)
    {
        return view('admin.koperasi.structure.edit', compact('structure'));
    }

    public function update(Request $request, KoperasiOrganizationStructure $structure)
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

        return redirect()->route('admin.koperasi.structure.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function destroy(KoperasiOrganizationStructure $structure)
    {
        if ($structure->image) {
            Storage::disk('public')->delete($structure->image);
        }

        $structure->delete();

        return redirect()->route('admin.koperasi.structure.index')->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
