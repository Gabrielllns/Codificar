<?php

namespace App\Repository;

use App\Models\Deputado;

/**
 * Class DeputadoRepository.
 *
 * @author Gabrielllns
 * @package App\Repository
 */
class DeputadoRepository
{

    /**
     * @var Deputado
     */
    private $deputado;

    /**
     * Construtor da classe.
     *
     * @param Deputado $deputado
     */
    public function __construct(Deputado $deputado)
    {
        $this->deputado = $deputado;
    }

    /**
     * Recupera a instância de 'Deputado' conforme o 'codigo' informado.
     *
     * @param integer $codigo
     * @return \App\Models\Deputado
     */
    public function getDeputadoPorCodigo($codigo)
    {
        return $this->deputado->where('co_deputado', '=', $codigo)->first();
    }

    /**
     * Recupera a total de 'Deputados' cadastrados na base.
     *
     * @return integer
     */
    public function getTotalDeputadosCadastrados()
    {
        return $this->deputado->select('id')->count();
    }

    /**
     * Recupera as instâncias de 'Deputado' cadastradas.
     *
     * @return \App\Models\Deputado[]
     */
    public function getDeputados()
    {
        return $this->deputado->all();
    }

    /**
     * Salva uma nova instância de 'Deputado'.
     *
     * @param array $deputado
     * @return \App\Models\Deputado
     */
    public function create(array $deputado)
    {
        return $this->deputado->create($deputado);
    }

}
