<?php

namespace App\Http\Controllers;

use App\Models\album;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $albums = album::where('is_active', true)
            ->withCount(['photo' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->get();

        return view('public.index', compact('albums'));
    }

    public function show($slug)
    {
        $album = album::findOrFail($slug);
        $photos = $album->photo()
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('public.show', compact('album', 'photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
