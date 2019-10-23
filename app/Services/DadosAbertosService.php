<?php

namespace App\Services;

/**
 * Class DadosAbertosService.
 *
 * @package App\Services
 * @author Gabrielllns
 */
class DadosAbertosService
{

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
            $deputadosAtivos = file_get_contents("http://dadosabertos.almg.gov.br/ws/deputados/em_exercicio?formato=json");

            if (!empty($deputadosAtivos)) {
                $deputadosAtivos = json_decode($deputadosAtivos, true);
                $deputados = $deputadosAtivos['list'];
            }
        } catch (\Exception $e) {
            throw new \Exception("Recurso não encontrado!");
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
            $complementoDeputado = file_get_contents("http://dadosabertos.almg.gov.br/ws/deputados/" . $idDeputado . "?formato=json");
        } catch (\Exception $e) {
            throw new \Exception("Recurso não encontrado para " . $idDeputado . "!");
        }

        return json_decode($complementoDeputado, true);
    }

}
