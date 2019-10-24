<?php

namespace App\Business;

use App\Services\DadosAbertosService;

/**
 * Class AbstractBO.
 *
 * @package App\Business
 * @author Gabrielllns
 */
class AbstractBO
{

    /**
     * Retorna uma instância de 'DeputadoBO'.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getDeputadoBO()
    {
        return app()->make(DeputadoBO::class);
    }

    /**
     * Retorna uma instância de 'ReseSocialDeputadoBO'.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getRedeSocialDeputadoBO()
    {
        return app()->make(RedeSocialDeputadoBO::class);
    }

    /**
     * Retorna uma instância de 'TipoRedeSocialBO'.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getTipoRedeSocialBO()
    {
        return app()->make(TipoRedeSocialBO::class);
    }

    /**
     * Retorna uma instância de 'VerbaIndenizatoriaDeputadoBO'.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getVerbaIndenizatoriaDeputadoBO()
    {
        return app()->make(VerbaIndenizatoriaDeputadoBO::class);
    }

    /**
     * Retorna uma instância de 'TipoDespesaBO'.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getTipoDespesaBO()
    {
        return app()->make(TipoDespesaBO::class);
    }

    /**
     * Retorna uma instância de 'DadosAbertosService'.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getDadosAbertosService()
    {
        return app()->make(DadosAbertosService::class);
    }

}
