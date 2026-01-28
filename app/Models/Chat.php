<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'friend_id',
        'message',
        'status',
        'sent_at',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function friend()
    {
        return $this->belongsTo(Friend::class);
    }
}
