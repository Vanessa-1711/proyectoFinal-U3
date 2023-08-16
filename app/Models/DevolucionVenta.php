<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevolucionVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'products_id',
        'venta_id',
        'fecha_devolucion',
        'cantidad_devuelta',
        'user_id',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
    public function producto()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}