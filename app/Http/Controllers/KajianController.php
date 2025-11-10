<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KajianController extends Controller
{
    public function index()
    {
        $kajians = Kajian::latest()->get();
        return view('admin.masjid.kajian.index', compact('kajians'));
    }

    public function create()
    {
        return view('admin.masjid.kajian.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'materi' => 'required|string',
            'pembicara' => 'required|string|max:255',
            'jenis_kajian' => 'required|string|in:Pekanan,Bulanan',
            'hari' => 'required|string|in:Sabtu,Ahad',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'keterangan' => 'nullable|string',
            'poster_data' => 'nullable|string'
        ]);

        // Set judul otomatis
        $validated['judul'] = $validated['jenis_kajian'] === 'Pekanan'
            ? 'KAJIAN RUTIN PEKANAN'
            : 'KAJIAN RUTIN BULANAN';

        $validated['lokasi'] = 'Masjid Al-Ikhlas';

        // Handle poster base64 seperti biasa
        if ($request->has('poster_data') && $request->poster_data != '') {
            $image_parts = explode(";base64,", $request->poster_data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = 'poster_' . time() . '.' . $image_type;
            $filePath = 'posters/' . $filename;
            Storage::disk('public')->put($filePath, $image_base64);
            $validated['poster'] = $filePath;
        }

        Kajian::create($validated);

        return redirect()->route('admin.masjid.kajian.index')
            ->with('success', 'Kajian berhasil ditambahkan.');
    }


    public function edit(Kajian $kajian)
    {
        return view('admin.masjid.kajian.edit', compact('kajian'));
    }

    public function update(Request $request, Kajian $kajian)
    {
        $validated = $request->validate([
            'materi' => 'required|string',
            'pembicara' => 'required|string|max:255',
            'jenis_kajian' => 'required|string|in:Pekanan,Bulanan',
            'hari' => 'required|string|in:Sabtu,Ahad',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'keterangan' => 'nullable|string',
            'poster_data' => 'nullable|string'
        ]);

        // Set judul otomatis
        $validated['judul'] = $validated['jenis_kajian'] === 'Pekanan'
            ? 'KAJIAN RUTIN PEKANAN'
            : 'KAJIAN RUTIN BULANAN';

        $validated['lokasi'] = 'Masjid Al-Ikhlas';

        // Update poster (jika ada)
        if ($request->has('poster_data') && $request->poster_data != '') {
            if ($kajian->poster) {
                Storage::disk('public')->delete($kajian->poster);
            }
            $image_parts = explode(";base64,", $request->poster_data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = 'poster_' . time() . '.' . $image_type;
            $filePath = 'posters/' . $filename;
            Storage::disk('public')->put($filePath, $image_base64);
            $validated['poster'] = $filePath;
        }

        $kajian->update($validated);

        return redirect()->route('admin.masjid.kajian.index')
            ->with('success', 'Kajian berhasil diperbarui.');
    }

    public function destroy(Kajian $kajian)
    {
        if ($kajian->poster) {
            Storage::disk('public')->delete($kajian->poster);
        }

        $kajian->delete();

        return redirect()->route('admin.masjid.kajian.index')
            ->with('success', 'Kajian berhasil dihapus.');
    }
}
