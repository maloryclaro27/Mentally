<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TomaMedicamento extends Model
{
    use HasFactory;

    protected $table = 'tomas_medicamentos';

    protected $fillable = [
        'medicamento_id',
        'user_id',
        'fecha_toma',
        'tomado_en',
        'estado',
    ];

    protected $casts = [
        'fecha_toma' => 'date',
        'tomado_en' => 'datetime',
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}