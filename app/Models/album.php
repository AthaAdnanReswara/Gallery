<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    protected $fillable = [
        'name',
        'deskripsi',
        'cover',
        'is_active'
    ];

    public function photo()
    {
        return $this->hasMany(photo::class);
    }
}
