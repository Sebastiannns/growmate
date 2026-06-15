<?php

// Model: Material — materi belajar
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    protected $fillable = ['user_id', 'title', 'category', 'description', 'file_path'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
