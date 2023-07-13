@extends('layouts.app')

@section('titulo')
    Ver Producto
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <h1 class="mb-6 text-2xl">Producto: {{ $product->id }}</h1>
    <p>Categoría: {{ $product->categoria }}</p>
    <p>Subcategoría ID: {{ $product->subcategoria_id }}</p>
    <p>Precio de Compra: {{ $product->precio_compra }}</p>
    <p>Precio de Venta: {{ $product->precio_venta }}</p>
    <p>Unidades Disponibles: {{ $product->unidades_disponibles }}</p>
    <p>Creado Por: {{ $product->creado_por }}</p>
    <a href="{{ route('products.edit', $product->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar Producto</a>
</div>
@endsection