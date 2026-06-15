<?php

// Model: FocusSession — menyimpan sesi fokus Pomodoro
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FocusSession extends Model
{
    protected $fillable = ['user_id', 'mode', 'duration', 'completed_at'];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'duration' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
