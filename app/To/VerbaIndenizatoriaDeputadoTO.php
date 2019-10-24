<?php

namespace App\To;

use App\Utils\Utils;

/**
 * Class VerbaIndenizatoriaDeputadoTO
 *
 * @author Gabrielllns
 * @package App\To
 */
class VerbaIndenizatoriaDeputadoTO
{

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $id_deputado;

    /**
     * @var integer
     */
    public $co_deputado;

    /**
     * @var string
     */
    public $mes_emissao;

    /**
     * @var double
     */
    public $valor_reembolsado;

    /**
     * @var TipoDespesaTO
     */
    public $tipoDespesaTO;

    /**
     * Fabrica de instância de 'VerbaIndenizatoriaDeputadoTO'.
     *
     * @param array $data
     * @param boolean $formatValue
     * @return \App\To\VerbaIndenizatoriaDeputadoTO
     */
    public static function newInstance($data = null, $formatValue = false)
    {
        $verbaIndenizatoriaDeputadoTO = new VerbaIndenizatoriaDeputadoTO();

        if ($data != null) {
            if ($formatValue) {
                $data = $verbaIndenizatoriaDeputadoTO->formatValue($data);
            }

            $id = Utils::getValue('id', $data);
            if (!empty($id)) {
                $verbaIndenizatoriaDeputadoTO->setId($id);
            }

            $verbaIndenizatoriaDeputadoTO->setCoDeputado(Utils::getValue('co_deputado', $data));
            $verbaIndenizatoriaDeputadoTO->setMesEmissao(Utils::getValue('mes_emissao', $data));
            $verbaIndenizatoriaDeputadoTO->setValorReembolsado(Utils::getValue('valor_reembolsado', $data));

            $tipoDespesaTO = TipoDespesaTO::newInstance($data);
            if (!empty($tipoDespesaTO->getCoTipoDespesa())) {
                $verbaIndenizatoriaDeputadoTO->setTipoDespesaTO($tipoDespesaTO);
            }
        }

        return $verbaIndenizatoriaDeputadoTO;
    }

    /**
     * Formata os valores do serviço para os formatos padões da aplicação.
     *
     * @param array $data
     * @return array
     */
    public function formatValue(array $data)
    {
        $valorFormatado = [];

        $valorFormatado['co_deputado'] = $data['idDeputado'];
        $valorFormatado['valor_reembolsado'] = $data['valor'];
        $valorFormatado['ds_despesa'] = $data['descTipoDespesa'];
        $valorFormatado['co_tipo_despesa'] = $data['codTipoDespesa'];

        if (!empty($data['tipoDespesaTO'])) {
            $valorFormatado['tipo_despesa'] = $data['tipoDespesaTO'];
        }

        return $valorFormatado;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getCoDeputado()
    {
        return $this->co_deputado;
    }

    /**
     * @param integer $co_deputado
     */
    public function setCoDeputado($co_deputado)
    {
        $this->co_deputado = $co_deputado;
    }

    /**
     * @return integer
     */
    public function getIdDeputado()
    {
        return $this->id_deputado;
    }

    /**
     * @param integer $id_deputado
     */
    public function setIdDeputado($id_deputado)
    {
        $this->id_deputado = $id_deputado;
    }

    /**
     * @return string
     */
    public function getMesEmissao()
    {
        return $this->mes_emissao;
    }

    /**
     * @param string $mes_emissao
     */
    public function setMesEmissao($mes_emissao)
    {
        $this->mes_emissao = $mes_emissao;
    }

    /**
     * @return float
     */
    public function getValorReembolsado()
    {
        return $this->valor_reembolsado;
    }

    /**
     * @param float $valor_reembolsado
     */
    public function setValorReembolsado($valor_reembolsado)
    {
        $this->valor_reembolsado = $valor_reembolsado;
    }

    /**
     * @return TipoDespesaTO
     */
    public function getTipoDespesaTO()
    {
        return $this->tipoDespesaTO;
    }

    /**
     * @param TipoDespesaTO $tipoDespesaTO
     */
    public function setTipoDespesaTO(TipoDespesaTO $tipoDespesaTO)
    {
        $this->tipoDespesaTO = $tipoDespesaTO;
    }

}
