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

    /**
     * Recupera a instância de 'RedesSociaisDeputado' conforme o 'codigo' informado.
     *
     * @param integer $idTipoRedeSocial
     * @param integer $idDeputado
     * @return \App\Models\RedeSocialDeputado
     */
    public function getRedeSocialDeputado($idTipoRedeSocial, $idDeputado)
    {
        return $this->redeSocialDeputado->with(['tipoRedesSociais'])
            ->whereHas('tipoRedesSociais', function ($query) use ($idTipoRedeSocial) {
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
