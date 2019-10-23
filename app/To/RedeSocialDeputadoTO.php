<?php


namespace App\To;

/**
 * Class RedeSocialDeputadoTO
 *
 * @author Gabrielllns
 * @package App\To
 */
class RedeSocialDeputadoTO
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
    public $id_tipo_rede_social;

    /**
     * @var string
     */
    public $ds_url_perfil;

    /**
     * Fabrica de instância de 'RedeSocialDeputadoTO'.
     *
     * @param array $data
     * @return \App\To\RedeSocialDeputadoTO
     */
    public static function newInstance($data = null)
    {
        $redeSocialDeputadoTO = new RedeSocialDeputadoTO();

        if ($data != null) {
            $redeSocialDeputadoTO->setId($data['id']);
            $redeSocialDeputadoTO->setIdDeputado($data['id_deputado']);
            $redeSocialDeputadoTO->setDsUrlPerfil($data['ds_url_perfil']);
            $redeSocialDeputadoTO->setIdTipoRedeSocial($data['id_tipo_rede_social']);
        }

        return $redeSocialDeputadoTO;
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
     * @return integer
     */
    public function getIdTipoRedeSocial()
    {
        return $this->id_tipo_rede_social;
    }

    /**
     * @param integer $id_tipo_rede_social
     */
    public function setIdTipoRedeSocial($id_tipo_rede_social)
    {
        $this->id_tipo_rede_social = $id_tipo_rede_social;
    }

    /**
     * @return string
     */
    public function getDsUrlPerfil()
    {
        return $this->ds_url_perfil;
    }

    /**
     * @param string $ds_url_perfil
     */
    public function setDsUrlPerfil($ds_url_perfil)
    {
        $this->ds_url_perfil = $ds_url_perfil;
    }

}
