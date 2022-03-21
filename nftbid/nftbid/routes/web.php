<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dash\ProductosController;
use App\Http\Controllers\Dash\CategoriesController;
use App\Http\Controllers\Front\IndexController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[IndexController::class,'index']);

Route::get('/admin', function () {
    return view('dash.layouts.contentWrapper');
})->name('admin');

Route::get('/admin/productos', [ProductosController::class,'miFuncion']);

Route::post('/admin/productos',[ProductosController::class,'insertar']);

Route::get('/admin/categorias', [CategoriesController::class,'index']);

Route::post('/admin/categorias', [CategoriesController::class,'store']);

Route::get('/contacto', function(){
    echo "hola";
});

Route::get('/productos',function(){
    $color = "#fa0011";
    $usuario = "doroteo";
    $num = rand(1,50);
    return view('front.productos')
        ->with('colorsote',$color)
        ->with('usuario',$usuario)
        ->with('numero',$num);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
