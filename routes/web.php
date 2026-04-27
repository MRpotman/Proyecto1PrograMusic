<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\SelloDiscograficoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\ItemListaDeseosController;
use App\Http\Controllers\ItemCarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoComprasController;
use App\Http\Controllers\ListaDeseosController;

Route::get('/', function () {
    return view('home.index');
});

Route::view('/about-us', 'aboutus.index')->name('about');

Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::resource('usuarios', UsuarioController::class);
Route::resource('artistas', ArtistaController::class);
Route::resource('sellos', SelloDiscograficoController::class);
Route::resource('generos', GeneroController::class);
Route::resource('tipos', TipoProductoController::class);
Route::resource('productos', ProductoController::class);

Route::resource('lista-deseos-items', ItemListaDeseosController::class);
Route::resource('lista-deseos', ListaDeseosController::class);
Route::resource('carrito-items', ItemCarritoController::class);
Route::resource('carrito-compras', CarritoComprasController::class);


Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/carrito/add', [ItemCarritoController::class, 'addToCart'])->name('carrito.add');

Route::get('/carrito', [CarritoComprasController::class, 'miCarrito'])->name('carrito.show');

Route::get('/checkout', [CarritoComprasController::class, 'checkout'])->name('checkout');
Route::post('/checkout/confirmar', [CarritoComprasController::class, 'confirmar'])->name('checkout.confirmar');

Route::get('/wishlist',     [ListaDeseosController::class,     'miLista'])->name('wishlist.show');
Route::post('/wishlist/add',[ItemListaDeseosController::class, 'addToWishlist'])->name('wishlist.add');