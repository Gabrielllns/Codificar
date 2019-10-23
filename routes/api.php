<?php

/*
|--------------------------------------------------------------------------
| Routes - API
|--------------------------------------------------------------------------
*/
Route::middleware(['api'])->group(function () {

    Route::prefix('deputados')->group(function () {
        Route::get('/reload', 'DeputadoController@getListaDeputadosAtivos');
        Route::get('/', 'DeputadoController@getDeputados');
    });

});