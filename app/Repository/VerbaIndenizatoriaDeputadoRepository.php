<?php

namespace App\Repository;

use App\Models\VerbaIndenizatoriaDeputado;
use Illuminate\Support\Facades\DB;

/**
 * Class VerbaIndenizatoriaDeputadoRepository.
 *
 * @author Gabrielllns
 * @package App\Repository
 */
class VerbaIndenizatoriaDeputadoRepository
{

    /**
     * @var VerbaIndenizatoriaDeputado
     */
    private $verbaIndenizatoriaDeputado;

    /**
     * Construtor da classe.
     *
     * @param VerbaIndenizatoriaDeputado $verbaIndenizatoriaDeputado
     */
    public function __construct(VerbaIndenizatoriaDeputado $verbaIndenizatoriaDeputado)
    {
        $this->verbaIndenizatoriaDeputado = $verbaIndenizatoriaDeputado;
    }

    /**
     * Recupera a lista dos cinco 'deputados' que mais solicitaram reembolso para o 'mês' informado.
     *
     * @param string $mes
     * @return \App\Models\VerbaIndenizatoriaDeputado[]
     */
    public function getCincoMaioresSolicitacoesReembolsoDeputadosPorMes($mes)
    {
        return $this->verbaIndenizatoriaDeputado->with(['deputado'])
            ->select(DB::raw('COUNT(id_deputado) as totalSolicitacoes, id_deputado'))
            ->where('mes_emissao', '=', $mes)
            ->groupBy('id_deputado')
            ->orderBy('totalSolicitacoes', 'DESC')
            ->limit(5)->get();
    }

    /**
     * Salva uma nova instância de 'VerbaIndenizatoriaDeputado'.
     *
     * @param array $verbaIndenizatoriaDeputado
     * @return \App\Models\VerbaIndenizatoriaDeputado
     */
    public function create(array $verbaIndenizatoriaDeputado)
    {
        return $this->verbaIndenizatoriaDeputado->create($verbaIndenizatoriaDeputado);
    }

    /**
     * Salva as instâncias de 'VerbaIndenizatoriaDeputado' gravadas na base.
     *
     * @return boolean
     * @throws \Exception
     */
    public function delete()
    {
        return $this->verbaIndenizatoriaDeputado->delete();
    }

}
