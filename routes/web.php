<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SVEController;
use App\Models\Postulante;

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

Route::get('/inefrapasa/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('inefrapasa')->group(function () {
    Route::get('/', [SVEController::class, 'index'])->name('sve.index');
    Route::post('/estudiante', [SVEController::class, 'create'])->name('sve.create');


    Route::prefix('/estadistica')->middleware('auth')->group(function () {
        Route::post('/', [SVEController::class, 'store'])->name('sve.storeEstudiantes');
        Route::get('/{component}', [SVEController::class, 'show'])->name('sve.showEstudiantes');
        Route::post('/{component}', [PostulanteController::class, 'store'])->name('sve.storePostulante');

        Route::post('/{component}/storeStudents', [EstudianteController::class, 'store'])->name('sve.storeStudents');
        Route::post('/{component}/deliteStudents/{estudiante}', [EstudianteController::class, 'destroy'])->name('sve.deleteStudents');

        
    });
});


require __DIR__ . '/auth.php';
