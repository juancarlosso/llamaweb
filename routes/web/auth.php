<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| RUTAS PARA EL ACCESO AL SISTEMA Y RECUPERAR CONTRASEÑA
|--------------------------------------------------------------------------
*/
Route::get('login', [CustomAuthController::class, 'showLogin'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('recover-password', [CustomAuthController::class, 'recoverPassword'])->name('recover-password');
Route::get('change-password/{id}/{token}',[CustomAuthController::class, 'changePassword'])->name('change-password');
Route::post('change-password-update', [CustomAuthController::class, 'changePasswordUpdate'])->name('change-password-update');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

