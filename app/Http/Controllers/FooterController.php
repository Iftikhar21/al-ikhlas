<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\FooterSocial;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    private function extractMapSrc($iframe)
    {
        if (preg_match('/src="([^"]+)"/', $iframe, $match)) {
            return $match[1];
        }
        return $iframe;
    }

    public function index()
    {
        $footer = Footer::with('socials')->latest('id')->first();
        // dd(Footer::with('socials')->get()->toArray());
        // dd($footer->toArray());
        return view('admin.footer.index', compact('footer'));
    }

    public function create()
    {
        $existingFooter = Footer::latest('id')->first();
        if ($existingFooter) {
            return redirect()->route('admin.footer.index')
                ->with('info', 'Footer sudah ada. Tidak bisa menambahkan lagi.');
        }

        return view('admin.footer.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'logo' => 'nullable|image',
            'slogan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'map_embed' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if (!empty($data['map_embed'])) {
            $data['map_embed'] = $this->extractMapSrc($data['map_embed']);
        }

        $footer = Footer::create($data);

        // simpan sosial media kalau ada
        if ($request->filled('socials')) {
            foreach ($request->socials as $social) {
                if (!empty($social['platform']) && !empty($social['url'])) {
                    $footer->socials()->create($social);
                }
            }
        }

        return redirect()->route('admin.footer.index')->with('success', 'Footer berhasil ditambahkan');
    }

    public function edit(Footer $footer)
    {
        $footer->load('socials');
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request, Footer $footer)
    {
        $data = $request->validate([
            'logo' => 'nullable|image',
            'slogan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'map_embed' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if (!empty($data['map_embed'])) {
            $data['map_embed'] = $this->extractMapSrc($data['map_embed']);
        }

        $footer->update($data);

        // update sosial media
        $footer->socials()->delete(); // reset dulu
        if ($request->filled('socials')) {
            foreach ($request->socials as $social) {
                if (!empty($social['platform']) && !empty($social['url'])) {
                    $footer->socials()->create($social);
                }
            }
        }

        return redirect()->route('admin.footer.index')->with('success', 'Footer berhasil diperbarui');
    }

    public function destroy(Footer $footer)
    {
        $footer->socials()->delete();
        $footer->delete();
        return redirect()->route('admin.footer.index')->with('success', 'Footer berhasil dihapus');
    }
}