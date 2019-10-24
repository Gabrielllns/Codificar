<?php

/*
|--------------------------------------------------------------------------
| Routes - API
|--------------------------------------------------------------------------
*/
Route::middleware(['api'])->group(function () {

    Route::prefix('deputados')->group(function () {
        Route::get('/carregar', 'DeputadoController@getListaDeputadosAtivos');
        Route::get('/', 'DeputadoController@getDeputados');
    });

    Route::prefix('redeSociaisDeputados')->group(function () {
        Route::get('/ordenar', 'RedeSocialDeputadoController@getRedesSociaisMaisUsadas');
    });
});