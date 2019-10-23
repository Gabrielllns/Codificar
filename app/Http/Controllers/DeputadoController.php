<?php

namespace App\Http\Controllers;

use App\Business\DeputadoBO;

/**
 * Class DeputadoController
 *
 * @package App\Http\Controllers
 * @author Gabrielllns
 */
class DeputadoController extends Controller
{

    /**
     * @var DeputadoBO
     */
    private $deputadoBO;

    /**
     * DeputadoController constructor.
     *
     * @param DeputadoBO $deputadoBO
     */
    public function __construct(DeputadoBO $deputadoBO)
    {
        $this->deputadoBO = $deputadoBO;
    }

    /**
     * Recupera e atualiza a lista de 'Deputados' ativos do serviço na base de dados.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getListaDeputadosAtivos()
    {
        $deputadosAtivos = $this->deputadoBO->getListaDeputadosAtivos();
        return response()->json($deputadosAtivos);
    }

    /**
     * Recupera as instâncias de 'Deputado' cadastradas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDeputados()
    {
        $deputados = $this->deputadoBO->getDeputados();
        return response()->json($deputados);
    }

}
