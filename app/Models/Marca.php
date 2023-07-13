<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre','descripcion', 'imagen', 'creado_por'];

    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    
}
