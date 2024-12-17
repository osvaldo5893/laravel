<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\TelefonoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('/blog', App\Http\Controllers\BlogController::class)->only(['index','store','show','update','destroy']);
Route::resource('usuario', UsuarioController::class);
Route::resource('persona', PersonaController::class);
Route::resource('direccion', DireccionController::class);
Route::resource('telefono', TelefonoController::class);
Route::post('/usuario/verificar', [UsuarioController::class, 'verificarUsuarioYContrasena']);
Route::post('/usuario/cargarExcel', [UsuarioController::class, 'cargarArchivoExcel']);
