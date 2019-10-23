<?php

namespace App\Repository;

use App\Models\TipoRedeSocial;

/**
 * Class TipoRedeSocialRepository.
 *
 * @author Gabrielllns
 * @package App\Repository
 */
class TipoRedeSocialRepository
{

    /**
     * @var TipoRedeSocial
     */
    private $tipoRedeSocial;

    /**
     * Construtor da classe.
     *
     * @param TipoRedeSocial $tipoRedeSocial
     */
    public function __construct(TipoRedeSocial $tipoRedeSocial)
    {
        $this->tipoRedeSocial = $tipoRedeSocial;
    }

    /**
     * Retorna a instância de 'TipoRedeSocial' conforme o 'codigo' informado.
     *
     * @param integer $codigoTipoRedeSocial
     * @return \App\Models\TipoRedeSocial
     */
    public function getTipoRedeSocialPorCodigo($codigoTipoRedeSocial)
    {
        return $this->tipoRedeSocial->where('co_rede_social', '=', $codigoTipoRedeSocial)->first();
    }

    /**
     * Salva uma nova instância de 'TipoRedeSocial'.
     *
     * @param array $tipoRedeSocial
     * @return \App\Models\TipoRedeSocial
     */
    public function create(array $tipoRedeSocial)
    {
        return $this->tipoRedeSocial->create($tipoRedeSocial);
    }

}
