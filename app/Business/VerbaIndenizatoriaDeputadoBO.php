<?php

namespace App\Business;

use App\Models\TipoDespesa;
use App\Repository\VerbaIndenizatoriaDeputadoRepository;
use App\To\VerbaIndenizatoriaDeputadoTO;
use Illuminate\Support\Facades\DB;

/**
 * Class VerbaIndenizatoriaDeputadoBO.
 *
 * @package App\Business
 * @author Gabrielllns
 */
class VerbaIndenizatoriaDeputadoBO extends AbstractBO
{

    /**
     * @var VerbaIndenizatoriaDeputadoRepository
     */
    private $verbaIndenizatoriaDeputadoRepository;

    /**
     * Construtor da classe.
     *
     * @param VerbaIndenizatoriaDeputadoRepository $verbaIndenizatoriaDeputadoRepository
     */
    public function __construct(VerbaIndenizatoriaDeputadoRepository $verbaIndenizatoriaDeputadoRepository)
    {
        $this->verbaIndenizatoriaDeputadoRepository = $verbaIndenizatoriaDeputadoRepository;
    }

    /**
     * Recupera a lista dos cinco 'deputados' que mais solicitaram reembolso para o 'mês' informado.
     *
     * @param string $mes
     * @return \App\Models\VerbaIndenizatoriaDeputado[]
     * @throws \Exception
     */
    public function getCincoMaioresSolicitacoesReembolsoDeputadosPorMes($mes)
    {
        if (intval($mes) < 1 || intval($mes) > 12) {
            throw new \Exception("O mês informado é inválido!");
        }

        return $this->verbaIndenizatoriaDeputadoRepository->getCincoMaioresSolicitacoesReembolsoDeputadosPorMes($mes);
    }

    /**
     * Retorna o array de verbas indenizatórias conforme o 'mês' informado.
     *
     * @param integer $mes
     * @return array
     * @throws \Exception
     */
    public function getListaVerbasIndenizatoriasDeputadosPorMes($mes)
    {
        $verbasIndenizatorias = [];

        if (intval($mes) < 1 || intval($mes) > 12) {
            throw new \Exception("O mês informado é inválido!");
        }

        $deputados = $this->getDeputadoBO()->getDeputados();
        foreach ($deputados as $deputado) {
            $verbasIndenizatoriasDeputadoMes = $this->getDadosAbertosService()->getListaVerbasIndenizatoriasDeputadosPorMes(
                $deputado->co_deputado,
                $mes
            );

            if (count($verbasIndenizatoriasDeputadoMes) > 0) {

                foreach ($verbasIndenizatoriasDeputadoMes as $verbaIndenizatoriaDeputadoMes) {
                    $verbaIndenizatoriaDeputadoTO = VerbaIndenizatoriaDeputadoTO::newInstance(
                        $verbaIndenizatoriaDeputadoMes,
                        true
                    );

                    $verbaIndenizatoriaDeputadoTO->setMesEmissao($mes);
                    $verbaIndenizatoriaDeputadoTO->setIdDeputado($deputado->id);
                    array_push($verbasIndenizatorias, $verbaIndenizatoriaDeputadoTO);
                }
            }
        }

        return $this->persist($verbasIndenizatorias);
    }

    /**
     * Salva a instância de 'VerbaIndenizatoriaDeputado' na base de dados.
     *
     * @param array $verbasIndenizatorias
     * @return array
     * @throws \Exception
     */
    public function persist(array $verbasIndenizatorias)
    {
        $verbasIndenizatoriasDeputados = [];

        try {
            DB::beginTransaction();

            $this->verbaIndenizatoriaDeputadoRepository->delete();

            foreach ($verbasIndenizatorias as $verbaIndenizatoria) {
                $tipoDespesaTO = $verbaIndenizatoria->getTipoDespesaTO();
                $tipoDespesa = $this->getTipoDespesaBO()->getTipoDespesaPorCodigo($tipoDespesaTO->getCoTipoDespesa());

                if (empty($tipoDespesa)) {
                    $tipoDespesa = $this->getTipoDespesaBO()->persist($tipoDespesaTO);
                }

                $verbaIndenizatoriaDeputadoFormatada = $this->formatarArrayVerbaIndenizatoriaDeputado(
                    $verbaIndenizatoria,
                    $tipoDespesa
                );

                $verbaIndenizatoriaDeputado = $this->verbaIndenizatoriaDeputadoRepository->create(
                    $verbaIndenizatoriaDeputadoFormatada
                );

                array_push($verbasIndenizatoriasDeputados, $verbaIndenizatoriaDeputado);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $verbasIndenizatoriasDeputados;
    }

    /**
     * Formata a instância de 'VerbaIndenizatoriaDeputado' para o modelo local.
     *
     * @param VerbaIndenizatoriaDeputadoTO $verbaIndenizatoriaDeputadoTO
     * @param TipoDespesa $tipoDespesa
     * @return array
     */
    private function formatarArrayVerbaIndenizatoriaDeputado(
        VerbaIndenizatoriaDeputadoTO $verbaIndenizatoriaDeputadoTO,
        TipoDespesa $tipoDespesa
    )
    {
        $verbaIndenizatoriaDeputado = [];

        $verbaIndenizatoriaDeputado['id_tipo_despesa'] = $tipoDespesa->id;
        $verbaIndenizatoriaDeputado['id_deputado'] = $verbaIndenizatoriaDeputadoTO->getIdDeputado();
        $verbaIndenizatoriaDeputado['mes_emissao'] = $verbaIndenizatoriaDeputadoTO->getMesEmissao();
        $verbaIndenizatoriaDeputado['valor_reembolsado'] = $verbaIndenizatoriaDeputadoTO->getValorReembolsado();

        return $verbaIndenizatoriaDeputado;
    }

}
