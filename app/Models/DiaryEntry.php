<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiaryEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entry_text',
        'mood',
        'word_count',
        'analysis_opt_in',
    ];

    protected $casts = [
        'analysis_opt_in' => 'boolean',
        'entry_text' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
