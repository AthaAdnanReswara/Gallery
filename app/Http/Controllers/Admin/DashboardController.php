<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\album;
use App\Models\photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function login()
    {
        $user = Auth::user();

        if($user->role === 'admin') {
            $TotalAlbum = album::count();
            $TotalPhoto = photo::count();
            $AlbumActive = album::where('is_active', true)->count();
            $PhotoApproved = photo::where('status', 'approved')->count();

            return view('admin.dashboard', compact('user','TotalAlbum','TotalPhoto','AlbumActive','PhotoApproved'));
        }else{
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk membuka halaman ini .');
        }
    }
}
