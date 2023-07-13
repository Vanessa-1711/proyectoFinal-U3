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
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function productos(){
        return $this->hasMany(Product::class,'subcategoria_id');
    }

}
