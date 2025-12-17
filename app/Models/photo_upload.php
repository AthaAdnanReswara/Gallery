<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class photo_upload extends Model
{
    protected $fillable = [
        'photo_id',
        'name',
        'email',
        'if_address',
    ];

    public function photo()
    {
        return $this->belongsTo(photo::class);
    }
}
