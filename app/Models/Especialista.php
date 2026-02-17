<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Especialista extends Model
{
    use HasFactory;

    protected $table = 'especialistas';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'psychiatry_license_number',
        'medical_school',
        'phone',
        'city',
        'specialties',
        'is_verified',
    ];

    protected $casts = [
        'specialties' => 'array',   // para que JSON se maneje como array
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
