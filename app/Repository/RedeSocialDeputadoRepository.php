<?php

namespace App\Repository;

use App\Models\RedeSocialDeputado;

/**
 * Class RedeSocialDeputadoRepository.
 *
 * @author Gabrielllns
 * @package App\Repository
 */
class RedeSocialDeputadoRepository
{

    /**
     * @var RedeSocialDeputado
     */
    private $redeSocialDeputado;

    /**
     * Construtor da classe.
     *
     * @param RedeSocialDeputado $redeSocialDeputado
     */
    public function __construct(RedeSocialDeputado $redeSocialDeputado)
    {
        $this->redeSocialDeputado = $redeSocialDeputado;
    }

    /**
     * Salva uma nova instância de 'RedeSocialDeputado'.
     *
     * @param array $redeSocialDeputado
     * @return \App\Models\RedeSocialDeputado
     */
    public function create(array $redeSocialDeputado)
    {
        return $this->redeSocialDeputado->create($redeSocialDeputado);
    }

}
