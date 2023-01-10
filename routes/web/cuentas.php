<?php
Route::group(['middleware' => ['auth']], function () {
     Route::resource('cuentas', App\Http\Controllers\CuentaController::class );
});