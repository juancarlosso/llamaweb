<?php
Route::group(['middleware' => ['auth']], function () {
     Route::resource('clientes', App\Http\Controllers\ClienteController::class );
});