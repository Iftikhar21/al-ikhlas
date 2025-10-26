<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationStructure;
use Illuminate\Support\Facades\Storage;

class OrganizationStructureController extends Controller
{
    public function index()
    {
        $structure = OrganizationStructure::first();
        return view('admin.structure.index', compact('structure'));
    }

    public function create()
    {
        return view('admin.structure.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('struktur-organisasi', 'public');

        OrganizationStructure::create([
            'image' => $path,
        ]);

        return redirect()->route('admin.structure.index')->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function edit(OrganizationStructure $structure)
    {
        return view('admin.structure.edit', compact('structure'));
    }

    public function update(Request $request, OrganizationStructure $structure)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            if ($structure->image) {
                Storage::disk('public')->delete($structure->image);
            }
            $data['image'] = $request->file('image')->store('struktur-organisasi', 'public');
        }

        $structure->update($data);

        return redirect()->route('admin.structure.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function destroy(OrganizationStructure $structure)
    {
        if ($structure->image) {
            Storage::disk('public')->delete($structure->image);
        }

        $structure->delete();

        return redirect()->route('admin.structure.index')->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
