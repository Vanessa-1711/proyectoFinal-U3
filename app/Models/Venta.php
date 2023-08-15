<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $fillable=[
        'referencia',
        'fecha',
        'total',
        'subtotal',
        'iva',
        'pagocon',
        'cambio',
        'cliente_id'
    ];
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function detalleVenta()
    {
        return $this->hasMany(detalleVenta::class);
    }
}
