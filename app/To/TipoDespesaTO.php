<?php

namespace App\To;

use App\Utils\Utils;

/**
 * Class TipoDespesaTO
 *
 * @author Gabrielllns
 * @package App\To
 */
class TipoDespesaTO
{

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $co_tipo_despesa;

    /**
     * @var string
     */
    public $ds_despesa;

    /**
     * Fabrica de instância de 'TipoDespesaTO'.
     *
     * @param array $data
     * @param boolean $formatValue
     * @return \App\To\TipoDespesaTO
     */
    public static function newInstance($data = null, $formatValue = false)
    {
        $tipoDespesaTO = new TipoDespesaTO();

        if ($data != null) {
            if ($formatValue) {
                $data = $tipoDespesaTO->formatValue($data);
            }

            $id = Utils::getValue('id', $data);
            if (!empty($id)) {
                $tipoDespesaTO->setId($id);
            }

            $tipoDespesaTO->setDsDespesa(Utils::getValue('ds_despesa', $data));
            $tipoDespesaTO->setCoTipoDespesa(Utils::getValue('co_tipo_despesa', $data));
        }

        return $tipoDespesaTO;
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

        $valorFormatado['ds_despesa'] = $data['descTipoDespesa'];
        $valorFormatado['co_tipo_despesa'] = $data['codTipoDespesa'];

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
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getCoTipoDespesa()
    {
        return $this->co_tipo_despesa;
    }

    /**
     * @param integer $co_tipo_despesa
     */
    public function setCoTipoDespesa($co_tipo_despesa)
    {
        $this->co_tipo_despesa = $co_tipo_despesa;
    }

    /**
     * @return string
     */
    public function getDsDespesa()
    {
        return $this->ds_despesa;
    }

    /**
     * @param string $ds_despesa
     */
    public function setDsDespesa($ds_despesa)
    {
        $this->ds_despesa = $ds_despesa;
    }

}
