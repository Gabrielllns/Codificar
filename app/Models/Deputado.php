<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Deputado
 *
 * @package App\Models
 * @author Gabrielllns
 */
class Deputado extends Model
{

    /**
     * Informs the name of the table.
     *
     * @var string
     */
    protected $table = 'deputados';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ds_nome',
        'co_deputado',
        'ds_partido',
        'ds_deputado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define a relação de 'Deputado' e 'RedeSocialDeputado'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function redeSocialDeputado()
    {
        return $this->hasMany(RedeSocialDeputado::class, 'id');
    }

    /**
     * Define a relação de 'Deputado' e 'VerbaIndenizatoriaDeputado'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verbaIndenizatoriaDeputado()
    {
        return $this->hasMany(VerbaIndenizatoriaDeputado::class, 'id');
    }

}
