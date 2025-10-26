<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    /**
     * Tampilkan daftar sejarah (hanya satu data).
     */
    public function index()
    {
        $history = History::first(); // Ambil satu-satunya data
        return view('admin.history.index', compact('history'));
    }

    /**
     * Tampilkan form tambah sejarah.
     */
    public function create()
    {
        // Cegah tambah baru jika sudah ada data
        if (History::exists()) {
            return redirect()->route('admin.history.index')->with('error', 'Data sejarah sudah ada, hapus terlebih dahulu untuk menambah baru.');
        }

        return view('admin.history.create');
    }

    /**
     * Simpan data sejarah baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'paragraphs' => 'required|array|min:1',
            'paragraphs.*' => 'required|string',
            'image_data' => 'required|string',
        ]);

        // Gabungkan paragraf jadi satu string dengan pemisah newline
        $content = implode("\n\n", $request->paragraphs);

        // Simpan gambar base64
        $imageData = $request->image_data;
        $imagePath = null;

        if ($imageData) {
            $image = str_replace('data:image/jpeg;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = 'history/' . uniqid() . '.jpg';
            Storage::disk('public')->put($imageName, base64_decode($image));
            $imagePath = $imageName;
        }

        History::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.history.index')->with('success', 'Sejarah berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit.
     */
    public function edit(History $history)
    {
        return view('admin.history.edit', compact('history'));
    }

    /**
     * Update data sejarah.
     */
    public function update(Request $request, History $history)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'paragraphs' => 'required|array|min:1',
            'paragraphs.*' => 'required|string',
            'image_data' => 'nullable|string', // untuk base64 image
        ]);

        // Gabungkan paragraf menjadi satu string dengan newline (\n\n)
        $content = implode("\n\n", $request->paragraphs);

        // Gambar lama tetap dipakai jika tidak diubah
        $imagePath = $history->image;

        // Jika ada gambar baru (base64)
        if ($request->image_data) {
            // Hapus gambar lama
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $imageData = $request->image_data;
            $image = str_replace('data:image/jpeg;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = 'history/' . uniqid() . '.jpg';
            Storage::disk('public')->put($imageName, base64_decode($image));
            $imagePath = $imageName;
        }

        // Update data
        $history->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.history.index')->with('success', 'Sejarah berhasil diperbarui!');
    }

    /**
     * Hapus data sejarah.
     */
    public function destroy(History $history)
    {
        if ($history->image && Storage::disk('public')->exists($history->image)) {
            Storage::disk('public')->delete($history->image);
        }

        $history->delete();
        return redirect()->route('admin.history.index')->with('success', 'Data sejarah berhasil dihapus.');
    }
}
