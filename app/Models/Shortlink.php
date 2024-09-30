<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shortlink extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_url',
        'slug',
        'click_count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
