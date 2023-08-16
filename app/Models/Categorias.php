<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use App\Models\Subcategoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'imagen',
        'eliminado',
        'user_id'
    ];

    // Definición de relaciones entre modelos

    /**
     * Una categoría puede tener varios productos asociados.
     */
    public function productos()
    {
        return $this->hasMany(Product::class, 'categoria_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class, 'categoria_id');
    }

}
