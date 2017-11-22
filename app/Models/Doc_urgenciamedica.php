<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc_urgenciamedica extends Model
{
    protected $table = 'doc_urgenciamedica';

    protected $fillable = [
        'usuari',
        'centreresident',
        'centreatencio',
        'especialitat',
        'monitor',
        'metge',
        'data',
        'hora',
        'motiu',
        'horaadmisio',
        'constants',
        'estatgeneral',
        'diagnostic',
        'evolucio',
        'altadomiciliariaradio',
        'observacionsalta',
        'properavisita',
        'horaproperavisita',
        'especialitatproperavisita',
        'horaingreshospitalitzacio',
        'ubicaciohospitalitzacio',
        'observacionshospitalitzacio',
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
