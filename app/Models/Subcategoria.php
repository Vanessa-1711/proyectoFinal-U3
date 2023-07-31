<?php

namespace App\Models;

use App\Models\Categorias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'codigo',
        'descripcion',
        'user_id',
    ];

    // Relaciones entre modelos

    //Una subcategoría pertenece a una categoría.
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    //Una subcategoría pertenece a un usuario creador.
    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Una subcategoría puede tener varios productos.
    public function productos()
    {
        return $this->hasMany(Product::class, 'subcategoria_id');
    }
}
