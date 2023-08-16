<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta';
    protected $fillable = [
        'venta_id',
        'products_id',
        'cantidad'
    ];
    public function producto()
    {
        return $this->belongsTo(Product::class,'products_id');
    }
}
