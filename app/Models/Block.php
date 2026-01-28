<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'block_by',
        'block_user',
        'remarks',
    ];
    public function blocker()
    {
        return $this->belongsTo(User::class, 'block_by');
    }

    public function blocked()
    {
        return $this->belongsTo(User::class, 'block_user');
    }
}
