<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        
        'referencia',
        'cliente_id',
        'estatus',
        'total',
        'subtotal',
        'descripcion',
        'fecha'
    ];


    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }


    public function detalles()
    {
        return $this->hasMany(DetalleCotizacion::class);
    }
}

