<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'empresa',
        'telefono',
        'correo',
        'fotografia',
        'pais',
        'estado',
        'ciudad',
    ];

    public function country() {
        return $this->belongsTo(Country::class, 'pais', 'id');
    }
    
    public function state() {
        return $this->belongsTo(State::class, 'estado', 'state_id');
    }
}