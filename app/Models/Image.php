<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'image_link',
        'user_id',
        'image_type',
    ];

    /**
     * Get the user that owns this image.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
