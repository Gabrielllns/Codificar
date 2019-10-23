<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VerbaIndenizatoriaDeputado
 *
 * @package App\Models
 * @author Gabrielllns
 */
class VerbaIndenizatoriaDeputado extends Model
{

    /**
     * Informs the name of the table.
     *
     * @var string
     */
    protected $table = 'verbas_indenizatorias_deputados';

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
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Recupera a relação entre 'VerbaIndenizatoriaDeputado' e 'Deputado'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deputado()
    {
        return $this->belongsTo(Deputado::class, 'id_deputado');
    }

}
