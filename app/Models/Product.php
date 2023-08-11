<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;
use App\Models\Subcategoria;
use App\Models\User;
use App\Models\Marca;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria_id',
        'subcategoria_id',
        'imagen',
        'precio_compra',
        'precio_venta',
        'unidades_disponibles',
        'user_id',
        'marca_id'
    ];

    // Relaciones entre modelos

    /**
     * Un producto pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    /**
     * Un producto pertenece a una subcategoría.
     */
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id');
    }

    /**
     * Un producto pertenece a un usuario creador.
     */
    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Un producto pertenece a una marca.
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
