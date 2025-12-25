<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    protected $fillable = [
        'name',
        'deskripsi',
        'slug',
        'cover',
        'is_active',
        'title'
    ];

    protected $casts = [
        'is_active' => 'integer',
    ];

    public function photo()
    {
        return $this->hasMany(photo::class);
    }
}
