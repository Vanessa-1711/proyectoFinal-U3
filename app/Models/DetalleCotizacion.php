<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    use HasFactory;
   
    protected $table = 'detalles_cotizacion';
    protected $fillable = [
        'cotizaciones_id',
        'products_id',
        'sale',
        'precio_venta',
        'subtotal',
        'total'
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class,'products_id');
    }
}

