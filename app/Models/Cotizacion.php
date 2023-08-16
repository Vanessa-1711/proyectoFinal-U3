<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'producto_id',
        'referencia',
        'cliente',
        'estatus',
        'total',
        'descripcion',
        'fecha'
    ];


    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente');
    }


    public function detalles()
    {
        return $this->hasMany(DetalleCotizacion::class);
    }
}

