<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable=[
        'fecha',
        'proveedor_id',
        'referencia',
        'total',
        'subtotal',
        'descripcion'
    ];
    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    public function proveedor() {
        return $this->belongsTo(Proveedor::class, 'proveedores_id');
    }
}
