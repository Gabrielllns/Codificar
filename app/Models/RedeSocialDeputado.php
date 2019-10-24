<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RedeSocialDeputado
 *
 * @package App\Models
 * @author Gabrielllns
 */
class RedeSocialDeputado extends Model
{

    /**
     * Informs the name of the table.
     *
     * @var string
     */
    protected $table = 'redes_sociais_deputados';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_deputado',
        'id_tipo_rede_social',
        'ds_url_perfil'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Recupera a relação entre 'RedeSocialDeputado' e 'Deputado'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deputado()
    {
        return $this->belongsTo(Deputado::class, 'id_deputado');
    }

    /**
     * Recupera a relação entre 'RedeSocialDeputado' e 'TipoRedeSocial'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoRedeSocial()
    {
        return $this->belongsTo(TipoRedeSocial::class, 'id_tipo_rede_social');
    }

}
