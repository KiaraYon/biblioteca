<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\DetallePermisoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\MateriumController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/email-send', function () {
    Mail::to('hutzon4011@gmail.com')->send(new GenericMail);
    return 'Mensaje enviado';
});

Route::get('/send-notification', [App\Http\Controllers\WhatsAppController::class, 'sendNotification']);

// Ruta para probar permisos
Route::get('/test-permissions', [TestController::class, 'checkPermissions']);

// Rutas protegidas con middleware de permisos
Route::group(['middleware' => ['auth']], function () {
    Route::resource('permisos', PermisoController::class)->middleware('permission:ver-permisos');
    Route::resource('libros', LibroController::class)->middleware('permission:ver-libros');
    Route::resource('detalle-permisos', DetallePermisoController::class)->middleware('permission:ver-detalle-permisos');
    Route::resource('prestamos', PrestamoController::class)->middleware('permission:ver-prestamos');
    Route::resource('estudiantes', EstudianteController::class)->middleware('permission:ver-estudiantes');
    Route::resource('configuraciones', ConfiguracionController::class)->middleware('permission:ver-configuraciones');
    Route::resource('editoriales', EditorialController::class)->middleware('permission:ver-editoriales');
    Route::resource('materia', MateriumController::class)->middleware('permission:ver-materias');
    Route::resource('autors', AutorController::class)->middleware('permission:ver-autores');

    Route::get('/get-estudiante-codigo/{id}', [App\Http\Controllers\EstudianteController::class, 'getCodigo']);
    Route::patch('/prestamos/{prestamo}/inactivar', [PrestamoController::class, 'inactivar'])->name('prestamos.inactivar');
    Route::get('/prestamos/{prestamo}/pdf', [PrestamoController::class, 'generatePdf'])->name('prestamos.pdf');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
