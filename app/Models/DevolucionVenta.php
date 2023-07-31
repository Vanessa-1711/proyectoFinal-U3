<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevolucionVenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_producto',
        'fecha_devolucion',
        'cliente',
        'estatus',
        'total_pagado',
        'adeudo',
        'estatus_pago',
        'imagen'
    ];
}