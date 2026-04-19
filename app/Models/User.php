<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Medicamento;
use App\Models\TomaMedicamento;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'birthdate',
        'emergency_name',
        'emergency_country_code',
        'emergency_phone',
        'emergency_relation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthdate' => 'date',
        ];
    }

    public function testAttempts()
    {
        return $this->hasMany(\App\Models\TestAttempt::class);
    }

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class, 'user_id');
    }

    public function tomasMedicamentos()
    {
        return $this->hasMany(TomaMedicamento::class, 'user_id');
    }

    public function pacientes()
    {
        return $this->belongsToMany(
            User::class,
            'especialista_paciente',
            'especialista_id',
            'paciente_id'
        )->withPivot([
            'estado',
            'codigo_vinculacion',
            'consentimiento_aceptado',
            'consentimiento_aceptado_en',
        ])->withTimestamps();
    }

    public function especialistas()
    {
        return $this->belongsToMany(
            User::class,
            'especialista_paciente',
            'paciente_id',
            'especialista_id'
        )->withPivot([
            'estado',
            'codigo_vinculacion',
            'consentimiento_aceptado',
            'consentimiento_aceptado_en',
        ])->withTimestamps();
    }
}