<?php

namespace App\Repository;

use App\Models\TipoDespesa;

/**
 * Class TipoDespesaRepository.
 *
 * @author Gabrielllns
 * @package App\Repository
 */
class TipoDespesaRepository
{

    /**
     * @var TipoDespesa
     */
    private $tipoDespesa;

    /**
     * Construtor da classe.
     *
     * @param TipoDespesa $tipoDespesa
     */
    public function __construct(TipoDespesa $tipoDespesa)
    {
        $this->tipoDespesa = $tipoDespesa;
    }

    /**
     * Retorna a instância de 'TipoDespesa' conforme o 'codigo' informado.
     *
     * @param integer $codigoTipoDespesa
     * @return \App\Models\TipoDespesa
     */
    public function getTipoDespesaPorCodigo($codigoTipoDespesa)
    {
        return $this->tipoDespesa->where('co_tipo_despesa', '=', $codigoTipoDespesa)->first();
    }

    /**
     * Salva uma nova instância de 'TipoDespesa'.
     *
     * @param array $tipoDespesa
     * @return \App\Models\TipoDespesa
     */
    public function create(array $tipoDespesa)
    {
        return $this->tipoDespesa->create($tipoDespesa);
    }

}
