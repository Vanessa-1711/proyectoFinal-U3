<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $table = 'detalles_compra';
    protected $fillable = [
        'compras_id',
        'products_id',
        'stock',
        'precio_compra',
        'subtotal',
        'total'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
    public function proveedor() {
        return $this->belongsTo(Proveedor::class, 'proveedores_id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class,'products_id');
    }
}
