<?php

namespace App\Business;

use App\Repository\TipoRedeSocialRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class TipoRedeSocialBO.
 *
 * @package App\Business
 * @author Gabrielllns
 */
class TipoRedeSocialBO extends AbstractBO
{

    /**
     * @var TipoRedeSocialRepository
     */
    private $tipoRedeSocialRepository;

    /**
     * UserBO constructor.
     *
     * @param TipoRedeSocialRepository $tipoRedeSocialRepository
     */
    public function __construct(TipoRedeSocialRepository $tipoRedeSocialRepository)
    {
        $this->tipoRedeSocialRepository = $tipoRedeSocialRepository;
    }

    /**
     * Retorna a instância de 'TipoRedeSocial' conforme o 'codigo' informado.
     *
     * @param integer $codigoTipoRedeSocial
     * @return \App\Models\TipoRedeSocial
     */
    public function getTipoRedeSocialPorCodigo($codigoTipoRedeSocial)
    {
        return $this->tipoRedeSocialRepository->getTipoRedeSocialPorCodigo($codigoTipoRedeSocial);
    }

    /**
     * Salva a instância de 'TipoRedeSocial' na base de dados.
     *
     * @param array $redeSocial
     * @return \App\Models\TipoRedeSocial
     * @throws \Exception
     */
    public function persist(array $redeSocial)
    {
        try {
            DB::beginTransaction();

            $tipoRedeSocialFormatada = $this->formatarArrayTipoRedeSocial($redeSocial);

            $tipoRedeSocial = $this->tipoRedeSocialRepository->create($tipoRedeSocialFormatada);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $tipoRedeSocial;
    }

    /**
     * Formata a instância de 'TipoRedeSocial' para o modelo local.
     *
     * @param array $redeSocial
     * @return array
     */
    private function formatarArrayTipoRedeSocial(array $redeSocial)
    {
        $tipoRedeSocial = [];

        $tipoRedeSocial['ds_nome'] = $redeSocial['nome'];
        $tipoRedeSocial['co_rede_social'] = $redeSocial['id'];

        return $tipoRedeSocial;
    }

}
