<?php

namespace App\Repository;

use App\Models\RedeSocialDeputado;
use Illuminate\Support\Facades\DB;

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
     * Retorna a lista das redes sociais mais utilizadas pelos deputados.
     *
     * @return \App\Models\RedeSocialDeputado[]
     */
    public function getRedesSociaisMaisUsadas()
    {
        return $this->redeSocialDeputado->with(['tipoRedeSocial'])
            ->select(DB::raw('SUM(id_tipo_rede_social) AS total, id_tipo_rede_social'))
            ->groupBy('id_tipo_rede_social')
            ->orderBy('total', 'DESC')
            ->get();
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

    /**
     * Recupera a instância de 'RedesSociaisDeputado' conforme o 'codigo' informado.
     *
     * @param integer $idTipoRedeSocial
     * @param integer $idDeputado
     * @return \App\Models\RedeSocialDeputado
     */
    public function getRedeSocialDeputado($idTipoRedeSocial, $idDeputado)
    {
        return $this->redeSocialDeputado->with(['tipoRedeSocial'])
            ->whereHas('tipoRedeSocial', function ($query) use ($idTipoRedeSocial) {
                $query->where('co_rede_social', '=', $idTipoRedeSocial);
            })->where('id_deputado', '=', $idDeputado)->first();
    }

    /**
     * Recupera a instância de 'RedesSociaisDeputado' conforme o 'id' informado.
     *
     * @param integer $idRedeSocialDeputado
     * @return \App\Models\RedeSocialDeputado
     */
    public function getRedeSocialDeputadoPorId($idRedeSocialDeputado)
    {
        return $this->redeSocialDeputado->find($idRedeSocialDeputado);
    }

}
