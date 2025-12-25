<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::orderBy('id', 'desc')->get();
        return view('admin.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.album.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        // buat slug dasar
        $slug = Str::slug($request->name);

        // cek slug unik
        $originalSlug = $slug;
        $count = 1;

        while (Album::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('album_covers', 'public');
        }

        album::create([
            'name' => $request->name,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'cover' => $coverPath,
            'title' => $request->title,
            'is_active' => true
        ]);

        return redirect()->route('admin.album.index')
            ->with('success', 'Album berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(album $album)
    {
        return view('admin.album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'title' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        // update cover jika ada
        if ($request->hasFile('cover')) {
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $album->cover = $request->file('cover')->store('album_covers', 'public');
        }

        $album->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'title' => $request->title,
            'is_active' => $request->is_active, // 🔥 ini kuncinya
        ]);

        return redirect()->route('admin.album.index')
            ->with('success', 'Album berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(album $album)
    {
        if ($album->cover) {
            Storage::disk('public')->delete($album->cover);
        }
        $album->delete();
        return back()->with('success', 'Album berhasil dihapus');
    }
}
