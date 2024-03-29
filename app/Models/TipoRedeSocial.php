<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoRedeSocial
 *
 * @package App\Models
 * @author Gabrielllns
 */
class TipoRedeSocial extends Model
{

    /**
     * Informs the name of the table.
     *
     * @var string
     */
    protected $table = 'tipo_rede_social';

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
        'co_rede_social',
        'ds_nome'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define a relação de 'TipoRedeSocial' e 'RedeSocialDeputado'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function redeSocialDeputado()
    {
        return $this->hasMany(RedeSocialDeputado::class, 'id');
    }

}
