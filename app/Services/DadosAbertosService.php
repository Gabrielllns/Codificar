<?php

namespace App\Services;

use Illuminate\Support\Facades\Lang;

/**
 * Class DadosAbertosService.
 *
 * @package App\Services
 * @author Gabrielllns
 */
class DadosAbertosService
{

    const URL_SERVICE_WS = "http://dadosabertos.almg.gov.br/ws";

    /**
     * Retorna o array de deputados em exercício retornados pelo serviço.
     *
     * @return array
     * @throws \Exception
     */
    public function getDeputadosAtivos()
    {
        $deputados = [];

        try {
            $deputadosAtivos = file_get_contents(
                self::URL_SERVICE_WS . "/deputados/em_exercicio?formato=json"
            );

            if (!empty($deputadosAtivos)) {
                $deputadosAtivos = json_decode($deputadosAtivos, true);
                $deputados = $deputadosAtivos['list'];
            }
        } catch (\Exception $e) {
            throw new \Exception($this->getMensagemExceptionPorCodigo($e->getCode()));
        }

        return $deputados;
    }

    /**
     * Retorna o complemento das informações de um deputado confome o 'id' informado.
     *
     * @param integer $idDeputado
     * @return null|array
     * @throws \Exception
     */
    public function getComplementosDeputado($idDeputado)
    {
        try {
            $complementoDeputado = file_get_contents(
                self::URL_SERVICE_WS . "/deputados/" . $idDeputado . "?formato=json"
            );
        } catch (\Exception $e) {
            throw new \Exception(Lang::get('messages.MSG_RECURSO_NAO_ENCONTRADO_DEPUTADO', ['idDeputado' => $idDeputado]));
        }

        $complementoDeputado = json_decode($complementoDeputado, true);
        return $complementoDeputado['deputado'];
    }

    /**
     * Retorna o array de verbas indenizatórias conforme o 'mês' para o 'co_deputado' do deputado informado.
     *
     * @param integer $coDeputado
     * @param integer $mes
     * @return array
     * @throws \Exception
     */
    public function getListaVerbasIndenizatoriasDeputadosPorMes($coDeputado, $mes)
    {
        $verbasIndenizatorias = [];

        try {
            $verbasIndenizatoriasDeputados = file_get_contents(
                self::URL_SERVICE_WS . "/prestacao_contas/verbas_indenizatorias/deputados/" . $coDeputado . "/2019/" . $mes . "?formato=json"
            );

            if (!empty($verbasIndenizatoriasDeputados)) {
                $verbasIndenizatoriasDeputados = json_decode($verbasIndenizatoriasDeputados, true);
                $verbasIndenizatorias = $verbasIndenizatoriasDeputados['list'];
            }
        } catch (\Exception $e) {
            throw new \Exception(Lang::get('messages.MSG_RECURSO_NAO_ENCONTRADO_DEPUTADO', ['idDeputado' => $coDeputado]));
        }

        return $verbasIndenizatorias;
    }

    /**
     * Retorna a mensagem de erro padronizada conforme o 'código' do erro retornado pelo serviço.
     *
     * @param $codigoErro
     * @return string
     */
    private function getMensagemExceptionPorCodigo($codigoErro)
    {
        $mensagem = null;

        switch ($codigoErro) {

            case '0':
                $mensagem = Lang::get('messages.MSG_HOST_NAO_RECONHECIDO');
                break;
        }

        return $mensagem;
    }

}
