<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaController;

Route::group(['middleware' => ['auth']], function () {
     Route::resource('cuentas', CuentaController::class );
     Route::get('cuentas/{id}/importar', [CuentaController::class, 'importarIndex'])->name('cuentas.importar');
     Route::post('cuentas/import', [CuentaController::class, 'importData'])->name('cuentas.import');
     Route::get('cuentas/{id}/estadisticas', [CuentaController::class, 'estadisticas'])->name('cuentas.estadisticas');
     Route::post('/estadisticas/reporte', [CuentaController::class, 'reporteador'])->name('cuentas.reporte');
     Route::get('/estadisticas_barraTotal/{idcuenta}/{tabla}', [CuentaController::class, 'barraTotal'])->name('cuentas.barraTotal');
     Route::get('/estadisticas_procesados/{idcuenta}/{tabla}', [CuentaController::class, 'procesados'])->name('cuentas.procesados');
     Route::get('/estadisticas_answered/{idcuenta}/{tabla}', [CuentaController::class, 'answered'])->name('cuentas.answered');
     Route::get('/cuentas/{idcuenta}/barrida', [CuentaController::class, 'barrida'])->name('cuentas.barrida');
     Route::post('/cuentas/barrida', [CuentaController::class, 'barridaUpdate'])->name('cuentas.barridaUpdate');


});