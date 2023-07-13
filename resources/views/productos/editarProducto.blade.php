@extends('layouts.app')

@section('titulo')
    Editar Producto
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <h1 class="mb-6 text-2xl">Editar Producto: {{ $product->id }}</h1>

    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')

        <label for="categoria">Categoría:</label>
        <input type="text" id="categoria" name="categoria" value="{{ $product->categoria }}" required>

        <label for="subcategoria_id">Subcategoría ID:</label>
        <input type="text" id="subcategoria_id" name="subcategoria_id" value="{{ $product->subcategoria_id }}" required>

        <label for="precio_compra">Precio de Compra:</label>
        <input type="number" id="precio_compra" name="precio_compra" value="{{ $product->precio_compra }}" required>

        <label for="precio_venta">Precio de Venta:</label>
        <input type="number" id="precio_venta" name="precio_venta" value="{{ $product->precio_venta }}" required>

        <label for="unidades_disponibles">Unidades Disponibles:</label>
        <input type="number" id="unidades_disponibles" name="unidades_disponibles" value="{{ $product->unidades_disponibles }}" required>

        <label for="creado_por">Creado Por:</label>
        <input type="text" id="creado_por" name="creado_por" value="{{ $product->creado_por }}" required>

        <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar Producto</button>
    </form>
</div>
@endsection