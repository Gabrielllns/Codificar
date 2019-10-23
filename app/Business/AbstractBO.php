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
