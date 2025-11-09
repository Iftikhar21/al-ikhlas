<?php

namespace App\Http\Controllers;

use App\Models\KoperasiActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KoperasiActivityController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $activities = KoperasiActivity::latest()->paginate(10);
        return view('admin.koperasi.activity.index', compact('activities'));
    }

    // halaman form create
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.koperasi.activity.create');
    }

    // simpan data
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'title'            => 'required|string|max:255',
            'paragraphs'       => 'required|array|min:1',
            'paragraphs.*'     => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'support_photos'   => 'nullable|array',
            'support_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        // Gabungkan semua paragraf jadi satu
        $content = implode("\n\n", $request->paragraphs ?? []);

        // Simpan thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('koperasi/activities/thumbnails', 'public');
        }

        // Simpan kegiatan
        $activities = KoperasiActivity::create([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title, '-'),
            'content'   => $content,
            'thumbnail' => $thumbnailPath,
        ]);

        // Simpan foto pendukung
        if ($request->hasFile('support_photos')) {
            foreach ($request->file('support_photos') as $file) {
                $path = $file->store('koperasi/activities/photos', 'public');
                $activities->koperasi_activity_photos()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.koperasi.activity.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    // show detail
    public function show(KoperasiActivity $activity)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.koperasi.activity.show', compact('activity'));
    }

    // edit form
    public function edit(KoperasiActivity $activity)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.koperasi.activity.edit', compact('activity'));
    }

    // update data
    public function update(Request $request, KoperasiActivity $activity)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'title'           => 'required|string|max:255',
            'paragraphs'      => 'required|array|min:1',
            'paragraphs.*'    => 'nullable|string',
            'thumbnail'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'support_photos'  => 'nullable|array',
            'support_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'delete_photos'   => 'nullable|array',
        ]);

        // gabungkan paragraf jadi 1 string
        $paragraphs = array_filter($request->paragraphs ?? [], fn($p) => !empty(trim($p)));
        $content = implode("\n\n", $paragraphs);

        // handle thumbnail
        $thumbnailPath = $activity->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($activity->thumbnail && Storage::disk('public')->exists($activity->thumbnail)) {
                Storage::disk('public')->delete($activity->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('koperasi/activities/thumbnails', 'public');
        }

        // update kegiatan
        $activity->update([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title, '-'),
            'content'   => $content,
            'thumbnail' => $thumbnailPath,
        ]);

        // tambah foto pendukung
        if ($request->hasFile('support_photos')) {
            foreach ($request->file('support_photos') as $file) {
                $path = $file->store('koperasi/activities/photos', 'public');
                $activity->koperasi_activity_photos()->create([
                    'path' => $path,
                ]);
            }
        }

        // hapus foto pendukung lama
        if ($request->filled('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = $activity->koperasi_activity_photos()->find($photoId);
                if ($photo) {
                    if (Storage::disk('public')->exists($photo->path)) {
                        Storage::disk('public')->delete($photo->path);
                    }
                    $photo->delete();
                }
            }
        }

        return redirect()->route('admin.koperasi.activity.index')->with('success', 'Kegiatan berhasil diperbarui');
    }

    // hapus
    public function destroy(KoperasiActivity $activity)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $activity->delete();
        return redirect()->route('admin.koperasi.activity.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}
