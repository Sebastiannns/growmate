<?php

// Model: MoodLog — merepresentasikan catatan mood harian user
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoodLog extends Model
{
    protected $fillable = ['user_id', 'mood', 'note', 'date'];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
