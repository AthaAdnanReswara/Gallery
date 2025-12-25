<?php

namespace App\Notifications;

use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PhotoPendingNotification extends Notification
{
    use Queueable;

    protected $photo;

    public function __construct($photo)
    {
        $this->photo = $photo;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Foto baru menunggu persetujuan',
            'album'   => $this->photo->album->name,
            'image'   => $this->photo->file,
            'photo_id' => $this->photo->id,
        ];
    }
}
