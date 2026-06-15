<?php

// Model: Article — artikel kesehatan mental oleh konselor
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = ['user_id', 'title', 'category', 'content', 'image_path'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
