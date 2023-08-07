<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'descripcion', 
        'imagen', 
        'user_id'
    ];
    // Definición de relaciones entre modelos

    //Una marca puede tener varios productos asociados.
    public function productos()
    {
        return $this->hasMany(Product::class, 'marca_id');
    }

    //Una marca pertenece a un usuario creador.
    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
