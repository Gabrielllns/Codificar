<?php

namespace App\To;

/**
 * Class DeputadoTO
 *
 * @author Gabrielllns
 * @package App\To
 */
class DeputadoTO
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $ds_nome;

    /**
     * @var integer
     */
    public $co_deputado;

    /**
     * @var string
     */
    public $ds_partido;

    /**
     * @var string
     */
    public $ds_deputado;

    /**
     * @var \DateTime
     */
    public $created_at;

    /**
     * @var \DateTime
     */
    public $updated_at;

    /**
     * @var RedeSocialDeputadoTO[]
     */
    public $redesSociaisDeputados;

    /**
     * Fabrica de instância de 'DeputadoTO'.
     *
     * @param array $data
     * @return \App\To\DeputadoTO
     */
    public static function newInstance($data = null)
    {
        $deputadoTO = new DeputadoTO();

        if ($data != null) {
            $deputadoTO->setId($data['id']);
            $deputadoTO->setDsNome($data['ds_nome']);
            $deputadoTO->setCreatedAt($data['created_at']);
            $deputadoTO->setDsPartido($data['ds_partido']);
            $deputadoTO->setUpdatedAt($data['updated_at']);
            $deputadoTO->setDsDeputado($data['ds_deputado']);
            $deputadoTO->setCoDeputado($data['co_deputado']);

            $redesSociaisDeputados = $data['redesSociaisDeputados'];
            if (!empty($redesSociaisDeputados)) {
                $deputadoTO->setRedesSociaisDeputados($redesSociaisDeputados);
            }
        }

        return $deputadoTO;
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
     * @return string
     */
    public function getDsNome()
    {
        return $this->ds_nome;
    }

    /**
     * @param string $ds_nome
     */
    public function setDsNome($ds_nome)
    {
        $this->ds_nome = $ds_nome;
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
     * @return string
     */
    public function getDsPartido()
    {
        return $this->ds_partido;
    }

    /**
     * @param string $ds_partido
     */
    public function setDsPartido($ds_partido)
    {
        $this->ds_partido = $ds_partido;
    }

    /**
     * @return string
     */
    public function getDsDeputado()
    {
        return $this->ds_deputado;
    }

    /**
     * @param string $ds_deputado
     */
    public function setDsDeputado($ds_deputado)
    {
        $this->ds_deputado = $ds_deputado;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return RedeSocialDeputadoTO[]
     */
    public function getRedesSociaisDeputados()
    {
        return $this->redesSociaisDeputados;
    }

    /**
     * @param RedeSocialDeputadoTO[] $redesSociaisDeputados
     */
    public function setRedesSociaisDeputados(array $redesSociaisDeputados)
    {
        foreach ($redesSociaisDeputados as $redeSocialDeputado) {
            $redeSocialDeputadoTO = RedeSocialDeputadoTO::newInstance($redeSocialDeputado);
            $this->addRedeSocialDeputadoTO($redeSocialDeputadoTO);
        }
    }

    /**
     * @param RedeSocialDeputadoTO $redeSocialDeputadoTO
     */
    public function addRedeSocialDeputadoTO(RedeSocialDeputadoTO $redeSocialDeputadoTO)
    {
        if (empty($this->redesSociaisDeputados)) {
            $this->redesSociaisDeputados = [];
        }

        array_push($this->redesSociaisDeputados, $redeSocialDeputadoTO);
    }

}
