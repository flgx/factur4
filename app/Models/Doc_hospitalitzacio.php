<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc_hospitalitzacio extends Model
{
    protected $table = 'doc_hospitalitzacio';

    protected $fillable = [
        'usuari',
        'id_tasca',
        'centreresident',
        'centreatencio',
        'especialitat',
        'monitor',
        'metge',
        'data',
        'hora',
        'evolucio',
        'diagnosticmedic',
        'dieta',
        'higiene',
        'estatanimic',
        'demandesrealitzades',
        'necessitatsdetectades',
        'altadomiciliariaradio',
        'observacionsalta',
        'fideservei',
        'transllat',
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
