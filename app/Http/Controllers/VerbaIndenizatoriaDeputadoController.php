<?php

namespace App\Http\Controllers;

use App\Business\VerbaIndenizatoriaDeputadoBO;

/**
 * Class VerbaIndenizatoriaDeputadoController
 *
 * @package App\Http\Controllers
 * @author Gabrielllns
 */
class VerbaIndenizatoriaDeputadoController extends Controller
{

    /**
     * @var VerbaIndenizatoriaDeputadoBO
     */
    private $verbaIndenizatoriaDeputadoBO;

    /**
     * VerbaIndenizatoriaDeputadoController constructor.
     *
     * @param VerbaIndenizatoriaDeputadoBO $verbaIndenizatoriaDeputadoBO
     */
    public function __construct(VerbaIndenizatoriaDeputadoBO $verbaIndenizatoriaDeputadoBO)
    {
        $this->verbaIndenizatoriaDeputadoBO = $verbaIndenizatoriaDeputadoBO;
    }

    /**
     * Retorna o array de verbas indenizatórias conforme o 'mês' informado.
     *
     * @param integer $mes
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getListaVerbasIndenizatoriasDeputadosPorMes($mes)
    {
        $verbasIndenizatoriasDeputados = $this->verbaIndenizatoriaDeputadoBO->getListaVerbasIndenizatoriasDeputadosPorMes($mes);
        return response()->json($verbasIndenizatoriasDeputados);
    }

    /**
     * Recupera a lista dos cinco 'deputados' que mais solicitaram reembolso para o 'mês' informado.
     *
     * @param string $mes
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getCincoMaioresSolicitacoesReembolsoDeputadosPorMes($mes)
    {
        $verbasIndenizatoriasDeputados = $this->verbaIndenizatoriaDeputadoBO->getCincoMaioresSolicitacoesReembolsoDeputadosPorMes($mes);
        return response()->json($verbasIndenizatoriasDeputados);
    }

}
