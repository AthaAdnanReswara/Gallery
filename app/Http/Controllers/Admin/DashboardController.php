<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function login()
    {
        $user = Auth::user();

        if($user->role === 'admin') {
            return view('admin.dashboard', compact('user'));
        }else{
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk membuka halaman ini .');
        }
    }
}
