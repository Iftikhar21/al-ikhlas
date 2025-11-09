<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the teachers.
     */
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Filter by name
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by phone number
        if ($request->has('phone') && $request->phone != '') {
            $query->where('phone_number', 'like', '%' . $request->phone . '%');
        }

        // Get paginated results (10 per page)
        $teachers = $query->paginate(10);

        return view('admin.tpa.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        return view('admin.tpa.teachers.create');
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request)
    {
        // 1️⃣ Validasi dulu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'last_education' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2️⃣ Simpan foto setelah validasi
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('teachers', 'public');
        }

        Teacher::create($validated);

        return redirect()->route('admin.tpa.teachers.index')
            ->with('success', 'Guru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified teacher.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.tpa.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        // 1️⃣ Validasi dulu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'last_education' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2️⃣ Jika ada file baru, hapus lama & simpan baru
        if ($request->hasFile('foto')) {
            if ($teacher->foto && Storage::disk('public')->exists($teacher->foto)) {
                Storage::disk('public')->delete($teacher->foto);
            }
            $validated['foto'] = $request->file('foto')->store('teachers', 'public');
        }

        $teacher->update($validated);

        return redirect()->route('admin.tpa.teachers.index')
            ->with('success', 'Guru berhasil diperbarui.');
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.tpa.teachers.index')
            ->with('success', 'Guru berhasil dihapus.');
    }
}