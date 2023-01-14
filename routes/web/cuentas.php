<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaController;

Route::group(['middleware' => ['auth']], function () {
     Route::resource('cuentas', CuentaController::class );
     Route::get('cuentas/{id}/importar', [CuentaController::class, 'importarIndex'])->name('cuentas.importar');
     Route::post('cuentas/import', [CuentaController::class, 'importData'])->name('cuentas.import');
});