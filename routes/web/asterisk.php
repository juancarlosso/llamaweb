<?php
Route::group(['middleware' => ['auth']], function () {
     Route::resource('asterisk', App\Http\Controllers\AsteriskController::class );
});