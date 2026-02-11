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
        'analysis_status',
        'crisis_flag',
        'sentiment_label',
        'sentiment_score',
        'sentiment_meta',
        'analyzed_at',
        'model_version',
    ];

    protected $casts = [
        'analysis_opt_in' => 'boolean',
        'entry_text' => 'encrypted',
        'sentiment_meta' => 'array',
        'crisis_flag' => 'boolean',
        'analyzed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
