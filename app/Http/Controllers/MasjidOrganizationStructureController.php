<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MasjidOrganizationStructure;

class MasjidOrganizationStructureController extends Controller
{
    public function index()
    {
        $structure = MasjidOrganizationStructure::first();
        return view('admin.masjid.structure.index', compact('structure'));
    }

    public function create()
    {
        return view('admin.masjid.structure.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('masjid/struktur-organisasi', 'public');

        MasjidOrganizationStructure::create([
            'image' => $path,
        ]);

        return redirect()->route('admin.masjid.structure.index')->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function edit(MasjidOrganizationStructure $structure)
    {
        return view('admin.masjid.structure.edit', compact('structure'));
    }

    public function update(Request $request, MasjidOrganizationStructure $structure)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            if ($structure->image) {
                Storage::disk('public')->delete($structure->image);
            }
            $data['image'] = $request->file('image')->store('masjid/struktur-organisasi', 'public');
        }

        $structure->update($data);

        return redirect()->route('admin.masjid.structure.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function destroy(MasjidOrganizationStructure $structure)
    {
        if ($structure->image) {
            Storage::disk('public')->delete($structure->image);
        }

        $structure->delete();

        return redirect()->route('admin.masjid.structure.index')->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
