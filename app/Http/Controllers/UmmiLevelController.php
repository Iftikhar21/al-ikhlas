<?php

namespace App\Http\Controllers;

use App\Models\UmmiLevel;
use Illuminate\Http\Request;

class UmmiLevelController extends Controller
{
    public function index()
    {
        $levels = UmmiLevel::latest()->get();
        return view('admin.ummi-levels.index', compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        UmmiLevel::create($request->only('name', 'description'));
        return redirect()->back()->with('success', 'Level Ummi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $level = UmmiLevel::findOrFail($id);
        $level->update($request->only('name', 'description'));

        return redirect()->back()->with('success', 'Level Ummi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $level = UmmiLevel::findOrFail($id);
        $level->delete();

        return redirect()->back()->with('success', 'Level Ummi berhasil dihapus.');
    }
}
