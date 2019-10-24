<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDespesa
 *
 * @package App\Models
 * @author Gabrielllns
 */
class TipoDespesa extends Model
{

    /**
     * Informs the name of the table.
     *
     * @var string
     */
    protected $table = 'tipo_despesa';

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
        'co_tipo_despesa',
        'ds_despesa'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define a relação de 'TipoDespesa' e 'VerbaIndenizatoriaDeputado'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verbaIndenizatoriaDeputado()
    {
        return $this->hasMany(VerbaIndenizatoriaDeputado::class, 'id');
    }

}
