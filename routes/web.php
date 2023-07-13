<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\MarcaImagenController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ImagenController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
// Ruta para vista registro de usuarios
Route::get('/crear', [RegisterController::class,'index'])->name('register');
// Ruta para enviar datos al servidor
Route::post('/crear', [RegisterController::class,'store']);

// Ruta de logout
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

//Rutas para el login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store']);

//Rutas para la vista del dashboard
Route::get('/dashboard',[PostController::class,'index'])->name('dashboard');

Route::get('/categorias',[CategoriasController::class,'index'])->name('categorias');
Route::get('/formCategorias',[CategoriasController::class,'create'])->name('formCategorias');

Route::post('/formCategorias',[CategoriasController::class,'store']);

Route::get('/categorias/{categoria}/edit', [CategoriasController::class, 'edit'])->name('categorias.editarCategoria');
Route::put('/categorias/{categoria}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{categoria}', [CategoriasController::class, 'delete'])->name('categorias.delete');





// Rutas para Productos

// Muestra la lista de productos
Route::get('/products', [ProductController::class, 'index'])->name('tablaProductos');

// Muestra el formulario para crear un nuevo producto
Route::get('/products/create', [ProductController::class, 'create'])->name('crearProducto');


// Guarda un nuevo producto
Route::post('/products', [ProductController::class, 'store'])->name('products.store');




// Muestra un producto específico
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Muestra el formulario para editar un producto
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Actualiza un producto específico
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// Elimina un producto específico
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


//RUTAS PRA SUBCATEGORIA



Route::get('/subcategorias', [SubcategoriaController::class, 'index'])->name('subcategorias');
Route::get('/subcategorias/create', [SubcategoriaController::class, 'create'])->name('subcategorias.create');
Route::post('/subcategorias', [SubcategoriaController::class, 'store'])->name('subcategorias.store');
Route::get('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'show'])->name('subcategorias.show');
Route::get('/subcategorias/{subcategoria}/edit', [SubcategoriaController::class, 'edit'])->name('subcategorias.edit');
Route::put('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'update'])->name('subcategoria.update');
Route::delete('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'delete'])->name('subcategorias.destroy');


//iamgen



Route::post('/marcas/imagenes', [MarcaImagenController::class, 'store']);
//Ruta para cargar imagenes
Route::post('/imagenes', [ImagenController::class,'store'])->name("imagenes.store");


Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas');
Route::get('/marcas/create', [MarcaController::class, 'create'])->name('marcas.create');
Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');
Route::get('/marcas/{marca}', [MarcaController::class, 'show'])->name('marcas.show');
Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');
Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');

//vneta

Route::get('/ventas', [VentaController::class, 'index'])->name('ventas');

