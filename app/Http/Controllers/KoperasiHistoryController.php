<?php

namespace App\Http\Controllers;

use App\Models\KoperasiHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KoperasiHistoryController extends Controller
{
    public function index()
    {
        $history = KoperasiHistory::first();
        return view('admin.koperasi.history.index', compact('history'));
    }

    public function create()
    {
        if (KoperasiHistory::exists()) {
            return redirect()->route('admin.koperasi.history.index')->with('error', 'Data sudah ada.');
        }

        return view('admin.koperasi.history.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'nullable',
            'paragraphs' => 'required|array|min:1',
            'paragraphs.*' => 'required|string',
            'image_data' => 'required|string',
        ]);

        $content = implode("\n\n", $request->paragraphs);

        $imageData = $request->image_data;
        $image = str_replace('data:image/jpeg;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'koperasi_history/' . uniqid() . '.jpg';
        Storage::disk('public')->put($imageName, base64_decode($image));

        KoperasiHistory::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $content,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.koperasi.history.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(KoperasiHistory $history)
    {
        return view('admin.koperasi.history.edit', compact('history'));
    }

    public function update(Request $request, KoperasiHistory $history)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'nullable',
            'paragraphs' => 'required|array|min:1',
            'paragraphs.*' => 'required|string',
            'image_data' => 'nullable|string',
        ]);

        $content = implode("\n\n", $request->paragraphs);
        $imagePath = $history->image;

        if ($request->image_data) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $imageData = $request->image_data;
            $image = str_replace('data:image/jpeg;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = 'koperasi_history/' . uniqid() . '.jpg';
            Storage::disk('public')->put($imageName, base64_decode($image));
            $imagePath = $imageName;
        }

        $history->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.koperasi.history.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(KoperasiHistory $history)
    {
        if ($history->image && Storage::disk('public')->exists($history->image)) {
            Storage::disk('public')->delete($history->image);
        }

        $history->delete();
        return redirect()->route('admin.koperasi.history.index')->with('success', 'Data berhasil dihapus.');
    }
}
