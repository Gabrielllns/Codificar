<?php

namespace App\Business;

use App\Repository\RedeSocialDeputadoRepository;
use Illuminate\Support\Facades\DB;
use Validator;

/**
 * Class ReseSocialDeputadoBO.
 *
 * @package App\Business
 * @author Gabrielllns
 */
class RedeSocialDeputadoBO extends AbstractBO
{

    /**
     * @var RedeSocialDeputadoRepository
     */
    private $redeSocialDeputadoRepository;

    /**
     * UserBO constructor.
     *
     * @param RedeSocialDeputadoRepository $redeSocialDeputadoRepository
     */
    public function __construct(RedeSocialDeputadoRepository $redeSocialDeputadoRepository)
    {
        $this->redeSocialDeputadoRepository = $redeSocialDeputadoRepository;
    }

    /**
     * Salva a instância de 'RedeSocialDeputado' na base de dados.
     *
     * @param integer $idDeputado
     * @param array $redesSociais
     * @param boolean $hasAlteracao
     * @return array
     * @throws \Exception
     */
    public function persist($idDeputado, array $redesSociais, $hasAlteracao)
    {
        $deputados = [];

        try {
            DB::beginTransaction();

            $redesSociaisFormatadas = $this->formatarArrayRedesSociaisDeputado($redesSociais, $idDeputado);
            if ($hasAlteracao) {
                $deputado = $this->update($redesSociaisFormatadas);
            } else {
                $deputado = $this->redeSocialDeputadoRepository->create($redesSociaisFormatadas);
            }

            array_push($deputados, $deputado);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $deputados;
    }

    /**
     * Formata a instância de 'RedesSociaisDeputado' para o modelo local.
     *
     * @param array $redesSociais
     * @param integer $idDeputado
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function formatarArrayRedesSociaisDeputado(array $redesSociais, $idDeputado)
    {
        $redesSociaisDeputado = [];

        foreach ($redesSociais as $redeSocial) {
            $redesSociaisDeputado['co_rede_social'] = $redeSocial['id'];

            $redeSocialCadastrada = $this->getTipoRedeSocialBO()->getTipoRedeSocialPorCodigo(
                $redesSociaisDeputado['co_rede_social']
            );

            if (empty($redeSocialCadastrada)) {
                $redeSocialCadastrada = $this->getTipoRedeSocialBO()->persist($redeSocial);
            }

            $redesSociaisDeputado['id_deputado'] = $idDeputado;
            $redesSociaisDeputado['ds_url_perfil'] = $redeSocial['url'];
            $redesSociaisDeputado['id_tipo_rede_social'] = $redeSocialCadastrada->id;
        }

        return $redesSociaisDeputado;
    }

    /**
     * Atualiza a instância de 'Deputado' recebida conforme o 'id' informado.
     *
     * @param array $newDeputado
     * @return \App\Models\Deputado
     * @throws \Exception
     */
    private function update(array $newDeputado)
    {
        $deputado = $this->getDeputadoPorCodigo($newDeputado['co_deputado']);

        try {
            $deputado->ds_nome = $deputado['ds_nome'];
            $deputado->ds_partido = $deputado['ds_partido'];
            $deputado->ds_deputado = $deputado['ds_deputado'];

            $deputado->save();
        } catch (\Exception $e) {
            throw $e;
        }

        return $this->getDeputadoPorCodigo($newDeputado['co_deputado']);
    }

}
