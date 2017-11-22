<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc_visitamedica extends Model
{
    protected $table = 'doc_visitamedica';

    protected $fillable = [
        'usuari',
        'centreresident',
        'centreatencio',
        'especialitat',
        'monitor',
        'metge',
        'data',
        'hora',
        'motiuvisita',
        'evoluciovisita',
        'diagnostic',
        'recomanacions',
        'farmactractament',
        'horatractament',
        'diestractament',
        'properavisita',
        'horaproperavisita',
        'especialitatproperavisita',
        'observacions',
    ];

    /**
     *
     */
    public function pacient()
    {
        return $this->belongsTo(Pacients::class, 'usuari');
    }

    /**
     *
     */
    public function tasca()
    {
        return $this->belongsTo(Tasques::class, 'id_tasca');
    }
}
