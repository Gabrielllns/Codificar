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
    private $reseSocialDeputadoBO;

    /**
     * DeputadoController constructor.
     *
     * @param RedeSocialDeputadoBO $reseSocialDeputadoBO
     */
    public function __construct(RedeSocialDeputadoBO $reseSocialDeputadoBO)
    {
        $this->reseSocialDeputadoBO = $reseSocialDeputadoBO;
    }

}
