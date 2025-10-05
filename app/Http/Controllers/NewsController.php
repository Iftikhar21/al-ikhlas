<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    // list semua berita
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    // halaman form create
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.news.create');
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
            $thumbnailPath = $request->file('thumbnail')->store('news/thumbnails', 'public');
        }

        // Simpan berita
        $news = News::create([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title, '-'),
            'content'   => $content,
            'thumbnail' => $thumbnailPath,
        ]);

        // Simpan foto pendukung
        if ($request->hasFile('support_photos')) {
            foreach ($request->file('support_photos') as $file) {
                $path = $file->store('news/photos', 'public');
                $news->photos()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan');
    }

    // show detail
    public function show(News $news)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.news.show', compact('news'));
    }

    // edit form
    public function edit(News $news)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.news.edit', compact('news'));
    }

    // update data
    public function update(Request $request, News $news)
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
        $thumbnailPath = $news->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('news', 'public');
        }

        // update berita
        $news->update([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title, '-'),
            'content'   => $content,
            'thumbnail' => $thumbnailPath,
        ]);

        // tambah foto pendukung
        if ($request->hasFile('support_photos')) {
            foreach ($request->file('support_photos') as $file) {
                $path = $file->store('news/photos', 'public');
                $news->photos()->create([
                    'path' => $path,
                ]);
            }
        }

        // hapus foto pendukung lama
        if ($request->filled('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = $news->photos()->find($photoId);
                if ($photo) {
                    if (Storage::disk('public')->exists($photo->path)) {
                        Storage::disk('public')->delete($photo->path);
                    }
                    $photo->delete();
                }
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui');
    }

    // hapus
    public function destroy(News $news)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus');
    }
}
