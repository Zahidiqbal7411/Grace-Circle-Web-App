<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'request_from',
        'request_to',
        'accept',
        'report_status',
        'block',
        'user_block',
    ];
    public function requestFrom()
    {
        return $this->belongsTo(User::class, 'request_from');
    }

    // The user who received the friend request
    public function requestTo()
    {
        return $this->belongsTo(User::class, 'request_to');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
