<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table= 'proveedores';
    protected $fillable = [
        'nombre',
        'codigo',
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