<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoRedesSociais
 *
 * @package App\Models
 * @author Gabrielllns
 */
class TipoRedesSociais extends Model
{

    /**
     * Informs the name of the table.
     *
     * @var string
     */
    protected $table = 'tipo_redes_sociais';

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
     * Define a relação de 'TipoRedesSociais' e 'RedeSocialDeputado'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function redeSocialDeputado()
    {
        return $this->hasMany(RedeSocialDeputado::class, 'id');
    }

}
