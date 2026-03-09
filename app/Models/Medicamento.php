<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'user_id',
        'nombre',
        'dosis',
        'hora_toma',
        'activo',
    ];

    protected $casts = [
        'hora_toma' => 'datetime:H:i',
        'activo' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tomas()
    {
        return $this->hasMany(TomaMedicamento::class, 'medicamento_id');
    }
}