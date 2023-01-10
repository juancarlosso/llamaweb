<?php
Route::group(['middleware' => ['auth']], function () {
     Route::resource('usuarios', App\Http\Controllers\UserController::class );
});