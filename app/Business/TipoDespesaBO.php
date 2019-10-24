<?php

namespace App\Business;

use App\Repository\TipoDespesaRepository;
use App\To\TipoDespesaTO;
use Illuminate\Support\Facades\DB;

/**
 * Class TipoDespesaBO.
 *
 * @package App\Business
 * @author Gabrielllns
 */
class TipoDespesaBO extends AbstractBO
{

    /**
     * @var TipoDespesaRepository
     */
    private $tipoDespesaRepository;

    /**
     * Construtor da classe.
     *
     * @param TipoDespesaRepository $tipoDespesaRepository
     */
    public function __construct(TipoDespesaRepository $tipoDespesaRepository)
    {
        $this->tipoDespesaRepository = $tipoDespesaRepository;
    }

    /**
     * Retorna a instância de 'TipoDespesa' conforme o 'codigo' informado.
     *
     * @param integer $codigoTipoDespesa
     * @return \App\Models\TipoDespesa
     */
    public function getTipoDespesaPorCodigo($codigoTipoDespesa)
    {
        return $this->tipoDespesaRepository->getTipoDespesaPorCodigo($codigoTipoDespesa);
    }

    /**
     * Salva a instância de 'TipoDespesa' na base de dados.
     *
     * @param TipoDespesaTO $tipoDespesaTO
     * @return \App\Models\TipoDespesa
     * @throws \Exception
     */
    public function persist(TipoDespesaTO $tipoDespesaTO)
    {
        try {
            DB::beginTransaction();

            $tipoDespesaFormatada = $this->formatarArrayTipoDespesa($tipoDespesaTO);

            $tipoDespesa = $this->tipoDespesaRepository->create($tipoDespesaFormatada);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $tipoDespesa;
    }

    /**
     * Formata a instância de 'TipoDespesa' para o modelo local.
     *
     * @param TipoDespesaTO $tipoDespesaTO
     * @return array
     */
    private function formatarArrayTipoDespesa(TipoDespesaTO $tipoDespesaTO)
    {
        $tipoDespesa = [];

        $tipoDespesa['ds_despesa'] = $tipoDespesaTO->getDsDespesa();
        $tipoDespesa['co_tipo_despesa'] = $tipoDespesaTO->getCoTipoDespesa();

        if (!empty($tipoDespesaTO->getId())) {
            $tipoDespesa['id'] = $tipoDespesaTO->getId();
        }

        return $tipoDespesa;
    }

}
