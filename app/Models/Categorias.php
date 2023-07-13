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
        'user_id'
    ];

    //Se hacen las relaciones entre los modelos
    public function productos(){
        return $this->hasMany(Product::class,'categoria_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subcategorias()
    {
        return $this->belongsTo(Subcategoria::class, 'categoria_id');
    }

}
