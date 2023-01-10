<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;

Route::group(['middleware' => ['auth']], function () {
    Route::get('perfil', [PerfilController::class, 'show'])->name('perfil.show');
    Route::put('perfil/{id}/update', [PerfilController::class, 'update'])->name('perfil.update');
});