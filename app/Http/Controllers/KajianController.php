<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KajianController extends Controller
{

    /**
     * Display a listing of kajian.
     */
    public function index()
    {
        $kajians = Kajian::latest()->get();
        return view('admin.masjid.kajian.index', compact('kajians'));
    }

    /**
     * Show the form for creating a new kajian.
     */
    public function create()
    {
        return view('admin.masjid.kajian.create');
    }

    /**
     * Store a newly created kajian in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'materi' => 'required|string',
            'pembicara' => 'required|string|max:255',
            'jenis_kajian' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'poster_data' => 'nullable|string' // Tambah validasi untuk base64 image
        ]);

        // Handle base64 image
        if ($request->has('poster_data') && $request->poster_data != '') {
            // Remove data:image/png;base64, from string
            $image_parts = explode(";base64,", $request->poster_data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Generate unique filename
            $filename = 'poster_' . time() . '.' . $image_type;
            $filePath = 'posters/' . $filename;

            // Save file
            Storage::disk('public')->put($filePath, $image_base64);
            $validated['poster'] = $filePath;
        }

        Kajian::create($validated);

        return redirect()->route('admin.masjid.kajian.index')
            ->with('success', 'Kajian berhasil ditambahkan.');
    }

    /**
     * Display the specified kajian.
     */
    public function show(Kajian $kajian)
    {
        return view('admin.masjid.kajian.show', compact('kajian'));
    }

    /**
     * Show the form for editing the specified kajian.
     */
    public function edit(Kajian $kajian)
    {
        return view('admin.masjid.kajian.edit', compact('kajian'));
    }

    /**
     * Update the specified kajian in storage.
     */
    public function update(Request $request, Kajian $kajian)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'materi' => 'required|string',
            'pembicara' => 'required|string|max:255',
            'jenis_kajian' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'poster_data' => 'nullable|string' // Tambah validasi untuk base64 image
        ]);

        // Handle base64 image
        if ($request->has('poster_data') && $request->poster_data != '') {
            // Delete old poster if exists
            if ($kajian->poster) {
                Storage::disk('public')->delete($kajian->poster);
            }

            // Remove data:image/png;base64, from string
            $image_parts = explode(";base64,", $request->poster_data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Generate unique filename
            $filename = 'poster_' . time() . '.' . $image_type;
            $filePath = 'posters/' . $filename;

            // Save file
            Storage::disk('public')->put($filePath, $image_base64);
            $validated['poster'] = $filePath;
        }

        $kajian->update($validated);

        return redirect()->route('admin.masjid.kajian.index')
            ->with('success', 'Kajian berhasil diperbarui.');
    }

    /**
     * Remove the specified kajian from storage.
     */
    public function destroy(Kajian $kajian)
    {
        // Delete poster if exists
        if ($kajian->poster) {
            Storage::disk('public')->delete($kajian->poster);
        }

        $kajian->delete();

        return redirect()->route('admin.masjid.kajian.index')
            ->with('success', 'Kajian berhasil dihapus.');
    }
}
