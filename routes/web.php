<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');//Esta ruta lleva directamente al login
});

//Route::get('/empleado', function () {
   // return view('empleado.index');
//});

//Route::get('/empleado/create',[EmpleadoController::class,'create']); dos formas dem accesar al los controladores


Route::resource('empleado',EmpleadoController::class)->middleware('auth'); // Forma de acceder a todos los metodos del controlador

Auth::routes(['register'=>false,'reset'=>false]);// Esconde laruta de registro y de recuperar password



//Auth::routes(); Esta Linea muestra todos las rutas que hay en el sistema

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'],function (){


    Route::get('/home', [EmpleadoController::class, 'index'])->name('home');



});
