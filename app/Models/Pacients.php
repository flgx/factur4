<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacients extends Model
{
  protected $table = 'pacients';

  protected  $fillable = [
    'nom',
    'cognoms',
    'datanaixement',
    'centreresident',
    'poblacio',
    'cp',
    'provincia',
    'adresa',
    'telefonequipament',
    'tutor',
    'telefoncontacte',
    'entitatbancaria',
    'iban',
    'bic',
    'dadessanitaries',
    'areafisica',
    'areasocial',
    'areacognitiva',
    'horariactivitat',
    'tipusactivitat',
    'itinerari',
    'activitat',
    'mapa'
    ];


    /**
     *
     */
    public function tasques()
    {
        return $this->hasMany(Tasques::class);
    }
}
