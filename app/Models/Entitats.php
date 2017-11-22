<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entitats extends Model
{
  protected $table = 'entitats';

  protected  $fillable = [
      'nom',
      'cif',
      'CP',
      'poblacio',
      'provincia',
      'adresa',
      'telefon',
      'entitatbancaria',
      'iban',
      'bic'
    ];
}
