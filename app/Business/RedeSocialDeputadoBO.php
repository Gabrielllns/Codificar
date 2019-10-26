<?php

namespace App\Business;

use App\Models\RedeSocialDeputado;
use App\Repository\RedeSocialDeputadoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

/**
 * Class RedeSocialDeputadoBO.
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
     * Construtor da classe.
     *
     * @param RedeSocialDeputadoRepository $redeSocialDeputadoRepository
     */
    public function __construct(RedeSocialDeputadoRepository $redeSocialDeputadoRepository)
    {
        $this->redeSocialDeputadoRepository = $redeSocialDeputadoRepository;
    }

    /**
     * Retorna a lista das redes sociais mais utilizadas pelos deputados.
     *
     * @return \App\Models\RedeSocialDeputado[]
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getRedesSociaisMaisUsadas()
    {
        $this->validarInformacoes();

        return $this->redeSocialDeputadoRepository->getRedesSociaisMaisUsadas();
    }

    /**
     * Salva a instância de 'RedeSocialDeputado' na base de dados.
     *
     * @param integer $idDeputado
     * @param array $redesSociais
     * @return array
     * @throws \Exception
     */
    public function persist($idDeputado, array $redesSociais)
    {
        $redesSociaisDeputados = [];

        try {
            DB::beginTransaction();

            foreach ($redesSociais as $redeSocial) {
                $redeSocialFormatada = $this->formatarArrayRedeSocialDeputado($redeSocial, $idDeputado);

                $redeSocialDeputadoCadastrada = $this->getRedeSocialDeputado(
                    $redeSocialFormatada['co_rede_social'],
                    $idDeputado
                );

                if (!empty($redeSocialDeputadoCadastrada)) {
                    $redeSocialDeputado = $this->update($redeSocialFormatada, $redeSocialDeputadoCadastrada);
                } else {
                    $redeSocialDeputado = $this->redeSocialDeputadoRepository->create($redeSocialFormatada);
                }

                array_push($redesSociaisDeputados, $redeSocialDeputado);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $redesSociaisDeputados;
    }

    /**
     * Recupera a instância de 'RedesSociaisDeputado' conforme o 'ids' de 'TipoRedeSocial' e 'Deputado' informados.
     *
     * @param integer $idTipoRedeSocial
     * @param integer $idDeputado
     * @return \App\Models\RedeSocialDeputado
     */
    public function getRedeSocialDeputado($idTipoRedeSocial, $idDeputado)
    {
        return $this->redeSocialDeputadoRepository->getRedeSocialDeputado($idTipoRedeSocial, $idDeputado);
    }

    /**
     * Recupera a instância de 'RedesSociaisDeputado' conforme o 'id' informado.
     *
     * @param integer $idRedeSocialDeputado
     * @return \App\Models\RedeSocialDeputado
     */
    public function getRedeSocialDeputadoPorId($idRedeSocialDeputado)
    {
        return $this->redeSocialDeputadoRepository->getRedeSocialDeputadoPorId($idRedeSocialDeputado);
    }

    /**
     * Formata a instância de 'RedesSociaisDeputado' para o modelo local.
     *
     * @param array $redeSocial
     * @param integer $idDeputado
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function formatarArrayRedeSocialDeputado(array $redeSocial, $idDeputado)
    {
        $redesSociaisDeputado = [];

        $redeSocialAUX = $redeSocial['redeSocial'];
        $redesSociaisDeputado['co_rede_social'] = $redeSocialAUX['id'];

        $redeSocialCadastrada = $this->getTipoRedeSocialBO()->getTipoRedeSocialPorCodigo(
            $redesSociaisDeputado['co_rede_social']
        );

        if (empty($redeSocialCadastrada)) {
            $redeSocialCadastrada = $this->getTipoRedeSocialBO()->persist($redeSocialAUX);
        }

        $redesSociaisDeputado['id_deputado'] = $idDeputado;
        $redesSociaisDeputado['ds_url_perfil'] = $redeSocial['url'];
        $redesSociaisDeputado['id_tipo_rede_social'] = $redeSocialCadastrada->id;

        return $redesSociaisDeputado;
    }

    /**
     * Atualiza a instância de 'RedeSocialDeputado' recebida conforme o 'id' informado.
     *
     * @param array $newRedeSocialDeputado
     * @param RedeSocialDeputado $redeSocialDeputadoCadastrada
     * @return \App\Models\RedeSocialDeputado
     * @throws \Exception
     */
    private function update(array $newRedeSocialDeputado, RedeSocialDeputado $redeSocialDeputadoCadastrada)
    {
        try {
            $redeSocialDeputadoCadastrada->ds_url_perfil = $newRedeSocialDeputado['ds_url_perfil'];

            $redeSocialDeputadoCadastrada->save();
        } catch (\Exception $e) {
            throw $e;
        }

        return $this->getRedeSocialDeputadoPorId($redeSocialDeputadoCadastrada->id);
    }

    /**
     * Valida as informações relevantes para as consultas de 'RedeSocialDeputado'.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException|\Exception
     */
    private function validarInformacoes()
    {
        if (!$this->getDeputadoBO()->hasDeputadosCadastrados()) {
            throw new \Exception(Lang::get('messages.MSG_NAO_HA_DEPUTADOS_CADASTRADOS_IMPORTE'));
        }
    }

}
