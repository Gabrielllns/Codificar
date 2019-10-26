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

    Route::prefix('redesSociaisDeputados')->group(function () {
        Route::get('/ordenar', 'RedeSocialDeputadoController@getRedesSociaisMaisUsadas');
    });

    Route::prefix('verbasIndenizatoriasDeputados')->group(function () {
        Route::get('/mes/{mes}/carregar', 'VerbaIndenizatoriaDeputadoController@getListaVerbasIndenizatoriasDeputadosPorMes');
        Route::get('/mes/{mes}', 'VerbaIndenizatoriaDeputadoController@getCincoMaioresSolicitacoesReembolsoDeputadosPorMes');
    });
});
