<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
    protected $fillable = [
        'album_id',
        'file',
        'caption',
        'status'
    ];

    public function album()
    {
        return $this->belongsTo(album::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function upload()
    {
        return $this->hasOne(photo_upload::class);
    }
}
