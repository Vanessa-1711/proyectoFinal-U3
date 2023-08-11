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
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteImagenController;

use App\Http\Controllers\DevolucionesVentasController;

use App\Http\Controllers\PuntoVentaController;
use App\Http\Controllers\GestionComprasController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CotizacionController;

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



//Rutas de catgorias
Route::get('/categorias',[CategoriasController::class,'index'])->name('categorias');
Route::get('/formCategorias',[CategoriasController::class,'create'])->name('formCategorias');
Route::post('/formCategorias',[CategoriasController::class,'store']);
Route::get('/categorias/{categoria}/edit', [CategoriasController::class, 'edit'])->name('categorias.editarCategoria');
Route::put('/categorias/{categoria}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{categoria}', [CategoriasController::class, 'delete'])->name('categorias.delete');
Route::post('/categorias/imagen', [CategoriasController::class,'Imagenstore'])->name("imagenesCategorias.store");






// Rutas para Productos

// Muestra la lista de productos
Route::get('/products', [ProductController::class, 'index'])->name('tablaProductos');
// Muestra el formulario para crear un nuevo producto
Route::get('/products/create', [ProductController::class, 'create'])->name('crearProducto');
// Guarda un nuevo producto
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//Ruta para cargar imagenes
Route::post('/products/imagen', [ProductController::class,'Imagenstore'])->name("imagenesProduc.store");
// Muestra un producto específico
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');
// Muestra el formulario para editar un producto
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Actualiza un producto específico
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
// Elimina un producto específico
Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/products/subcategorias/{categoria_id}', [ProductController::class, 'getSubcategorias'])->name('getSubcategorias');



//RUTAS PRA SUBCATEGORIA
Route::get('/subcategorias', [SubcategoriaController::class, 'index'])->name('subcategorias');
Route::get('/subcategorias/create', [SubcategoriaController::class, 'create'])->name('subcategorias.create');
Route::post('/subcategorias', [SubcategoriaController::class, 'store'])->name('subcategorias.store');
Route::get('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'show'])->name('subcategorias.show');
Route::get('/subcategorias/{subcategoria}/edit', [SubcategoriaController::class, 'edit'])->name('subcategorias.edit');
Route::put('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'update'])->name('subcategoria.update');
Route::delete('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'delete'])->name('subcategorias.destroy');
Route::post('/subcategorias/imagen', [SubcategoriaController::class,'Imagenstore'])->name("imagenesSubcategoria.store");




Route::post('/marcas/imagen', [MarcaController::class,'Imagenstore'])->name("imagenesMarca.store");

Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas');
Route::get('/marcas/create', [MarcaController::class, 'create'])->name('marcas.create');
Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');
Route::get('/marcas/{marca}', [MarcaController::class, 'show'])->name('marcas.show');
Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');
Route::delete('/marcas/{marca}', [MarcaController::class, 'delete'])->name('marcas.delete');


//clientes:


Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::post('/clientes/imagen', [ClienteController::class,'Imagenstore'])->name("imagenesClientes.store");
Route::get('/getStates', [ClienteController::class,'getStatesByCountry'])->name("getStates");

//proveedores
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores');
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
Route::post('/proveedor/imagen', [ProveedorController::class,'Imagenstore'])->name("imagenProveedor.store");


//Usuarios
Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario', [UsuarioController::class, 'store'])->name('usuario.store');
Route::get('/usuario/{usuario}', [UsuarioController::class, 'show'])->name('usuario.show');
Route::get('/usuario/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route::post('/usuario/imagen', [UsuarioController::class,'Imagenstore'])->name("imagenUsuario.store");

//devoluciones de ventas

Route::get('/devoluciones', [DevolucionesVentasController::class, 'index'])->name('devoluciones');
Route::get('/devoluciones/create', [DevolucionesVentasController::class, 'create'])->name('devoluciones.create');
Route::post('/devoluciones', [DevolucionesVentasController::class, 'store'])->name('devoluciones.store');
Route::get('/devoluciones/{devolucion}', [DevolucionesVentasController::class, 'show'])->name('devoluciones.show');
Route::get('/devoluciones/{devolucion}/edit', [DevolucionesVentasController::class, 'edit'])->name('devoluciones.edit');
Route::put('/devoluciones/{devolucion}', [DevolucionesVentasController::class, 'update'])->name('devoluciones.update');
Route::delete('/devoluciones/{devolucion}', [DevolucionesVentasController::class, 'destroy'])->name('devoluciones.destroy');
Route::post('/devoluciones/imagen', [DevolucionesVentasController::class, 'imagenStore'])->name('devoluciones.imagen.store');

//Punto venta 
Route::get('/puntoVenta', [PuntoVentaController::class, 'index'])->name('puntoVenta');


//Ventas
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas');


Route::get('/compras', [GestionComprasController::class, 'index'])->name('compras.index');
Route::get('/compras/crear', [GestionComprasController::class, 'create'])->name('compras.create');
Route::post('/compras', [GestionComprasController::class, 'store'])->name('compras.store');
Route::get('/compras/getProducto/{id_producto}',[GestionComprasController::class,'getProduct'])->name('compras.getProducto');
Route::get('/compras/{comprasId}', [GestionComprasController::class, 'show'])->name('compras.show');


//gestor compras 

Route::get('/ventas/detalles', [VentasController::class, 'detallesTienda'])->name('ventas.show');


//cotizaciones


// Listado de cotizaciones
Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizaciones.index');

// Mostrar formulario para crear una nueva cotización
Route::get('/cotizaciones/crear', [CotizacionController::class, 'create'])->name('cotizaciones.create');

// Almacenar una nueva cotización
Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');

// Mostrar formulario para editar una cotización existente
Route::get('/cotizaciones/{id}/editar', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');

// Actualizar una cotización existente
Route::put('/cotizaciones/{id}', [CotizacionController::class, 'update'])->name('cotizaciones.update');

// Eliminar una cotización
Route::delete('/cotizaciones/{id}', [CotizacionController::class, 'destroy'])->name('cotizaciones.destroy');
