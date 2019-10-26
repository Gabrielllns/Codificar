<?php

namespace App\Http\Controllers;

use App\Business\RedeSocialDeputadoBO;

/**
 * Class RedeSocialDeputadoController
 *
 * @package App\Http\Controllers
 * @author Gabrielllns
 */
class RedeSocialDeputadoController extends Controller
{

    /**
     * @var RedeSocialDeputadoBO
     */
    private $redeSocialDeputadoBO;

    /**
     * RedeSocialDeputadoController constructor.
     *
     * @param RedeSocialDeputadoBO $redeSocialDeputadoBO
     */
    public function __construct(RedeSocialDeputadoBO $redeSocialDeputadoBO)
    {
        $this->redeSocialDeputadoBO = $redeSocialDeputadoBO;
    }

    /**
     * Retorna a lista das redes sociais mais utilizadas pelos deputados.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getRedesSociaisMaisUsadas()
    {
        $redesSociaisMaisUsadas = $this->redeSocialDeputadoBO->getRedesSociaisMaisUsadas();
        return response()->json($redesSociaisMaisUsadas);
    }

}
