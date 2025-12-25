<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\album;
use App\Models\photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = photo::with(['album', 'admin', 'upload'])->latest()->paginate(12);

        return view('admin.photo.index', compact('photos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $albums = album::where('is_active', true)->get();
        return view('admin.photo.tambah', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'file' => 'required|image|max:4096',
            'caption' => 'nullable|string'
        ]);

        $path = $request->file('file')->store('photos', 'public');

        Photo::create([
            'album_id' => $request->album_id,
            'file' => $path,
            'caption' => $request->caption,
            'status' => 'approved',      // ADMIN LANGSUNG APPROVED
            'user_id' => auth()->id()    // ADMIN
        ]);

        return redirect()->route('admin.photo.index')->with('success', 'Foto berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $albums = Album::where('is_active', true)->get();
        return view('admin.photo.edit', compact('photo', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'file' => 'nullable|image|max:4096',
            'caption' => 'nullable|string'
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($photo->file);
            $photo->file = $request->file('file')->store('photos', 'public');
        }

        $photo->update([
            'album_id' => $request->album_id,
            'caption' => $request->caption
        ]);

        return redirect()->route('admin.photo.index')->with('success', 'Foto berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->file);
        $photo->delete();

        return redirect()->route('admin.photo.index')->with('success', 'Foto berhasil dihapus');
    }


    //
    public function pending()
    {
        $photos = Photo::where('status', 'pending')->latest()->get();
        return view('admin.photo.pending', compact('photos'));
    }

    public function show(Photo $photo)
    {
        return view('admin.photo.show', compact('photo'));
    }

    public function approve(Photo $photo)
    {
        $photo->update([
            'status' => 'approved'
        ]);

        return redirect()
            ->route('admin.photo.pending')
            ->with('success', 'Foto berhasil disetujui');
    }

    public function reject(Photo $photo)
    {
        $photo->update([
            'status' => 'rejected'
        ]);

        return redirect()
            ->route('admin.photo.pending')
            ->with('success', 'Foto berhasil ditolak');
    }
}
