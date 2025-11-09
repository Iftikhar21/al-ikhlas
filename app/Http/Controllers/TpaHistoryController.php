<?php

namespace App\Http\Controllers;

use App\Models\TpaHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TpaHistoryController extends Controller
{
    public function index()
    {
        $history = TpaHistory::first();
        return view('admin.tpa.history.index', compact('history'));
    }

    public function create()
    {
        if (TpaHistory::exists()) {
            return redirect()->route('admin.tpa.history.index')->with('error', 'Data sudah ada.');
        }

        return view('admin.tpa.history.create');
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
        $imageName = 'tpa_history/' . uniqid() . '.jpg';
        Storage::disk('public')->put($imageName, base64_decode($image));

        TpaHistory::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $content,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.tpa.history.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(TpaHistory $history)
    {
        return view('admin.tpa.history.edit', compact('history'));
    }

    public function update(Request $request, TpaHistory $history)
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
            $imageName = 'tpa_history/' . uniqid() . '.jpg';
            Storage::disk('public')->put($imageName, base64_decode($image));
            $imagePath = $imageName;
        }

        $history->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.tpa.history.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(TpaHistory $history)
    {
        if ($history->image && Storage::disk('public')->exists($history->image)) {
            Storage::disk('public')->delete($history->image);
        }

        $history->delete();
        return redirect()->route('admin.tpa.history.index')->with('success', 'Data berhasil dihapus.');
    }
}
