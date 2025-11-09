<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $programs = Programs::latest()->paginate(10);
        return view('admin.tpa.programs.index', compact('programs'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.tpa.programs.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'thumbnail'   => 'nullable|image|max:10240',
            'status'      => 'required|in:draft,published',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('programs', 'public');
        }

        Programs::create($data);

        return redirect()->route('admin.tpa.programs.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Programs $program)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.tpa.programs.show', compact('program'));
    }

    public function edit(Programs $program)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.tpa.programs.edit', compact('program'));
    }

    public function update(Request $request, Programs $program)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'thumbnail'   => 'nullable|image|max:10240',
            'status'      => 'required|in:draft,published',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            if ($program->thumbnail) {
                Storage::disk('public')->delete($program->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('programs', 'public');
        }

        $program->update($data);

        return redirect()->route('admin.tpa.programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Programs $program)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if ($program->thumbnail) {
            Storage::disk('public')->delete($program->thumbnail);
        }

        $program->delete();
        return redirect()->route('admin.tpa.programs.index')->with('success', 'Program berhasil dihapus.');
    }
}
