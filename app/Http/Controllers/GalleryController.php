<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\photo;
use App\Models\photo_upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PhotoPendingNotification;
use App\Models\User;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('public.index');
    }

    public function show($slug)
    {
        $albums = Album::where('is_active', true)->get();

        $album = Album::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $photos = Photo::where('album_id', $album->id)
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('public.album', compact('albums', 'photos', 'album'));
    }

    //tambah photo
    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'photo'    => 'required|image|max:2048',
            'caption'  => 'nullable|string',
            'name'     => 'nullable|string',
            'email'    => 'nullable|email',
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        $photo = Photo::create([
            'album_id' => $request->album_id,
            'file'     => $path,
            'caption'  => $request->caption,
            'status'   => 'pending',
            'user_id'  => null,
        ]);

        photo_upload::create([
            'photo_id'  => $photo->id,
            'name'      => $request->name,
            'email'     => $request->email,
            'ip_address' => $request->ip(),
        ]);

        // 🔔 KIRIM NOTIFIKASI KE ADMIN
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new PhotoPendingNotification($photo));
        return back()->with('success', 'Foto berhasil diupload, menunggu persetujuan admin.');
    }

    //about
    public function about()
    {
        return view('public.about');
    }
}
