<?php

// Model: Consultation — sesi konsultasi mahasiswa dengan konselor
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    protected $fillable = [
        'student_id', 'counselor_id', 'topic',
        'description', 'consultation_date', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'consultation_date' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function counselor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }
}
