<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = album::latest()->paginate(10);
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
            'cover' => 'nullable|image|max:2048'
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
        ]);

        if ($request->hasFile('cover')) {
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $album->cover = $request->file('cover')->store('album_covers', 'public');
        }
        $album->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'is_active' => true
        ]);
        return redirect()->route('admin.album.index')->with('success', 'Album berhasil diperbarui');
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
