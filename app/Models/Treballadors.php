<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treballadors extends Model
{
    protected $table = 'treballadors';

    protected $fillable = [
        'nom',
        'cognoms',
        'dni',
        'datanaixement',
        'delegacio_id',
        'poblacio',
        'cp',
        'provincia',
        'adresa',
        'telefon',
        'email',
        'entitatbancaria',
        'iban',
        'bic',
        'preuhora',
        'preukm',
        'duradacontracte',
        'jornada',
        'categoria_id',
        'estatactual',//si te alguna faena ara mateix  o se li pot asignar  una
        'tipus',//fixe o temporal
        'titulacioprofesional',
    ];

    /**
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
