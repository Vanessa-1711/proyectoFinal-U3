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

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
}