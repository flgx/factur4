<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestorDocumental extends Model
{
  protected $table = 'gestorDocumental';

  protected  $fillable = [
      'id_uploadby',
      'tipus',//0 treballadors, 1 pacients, 2 referents
      'nom',
      'extensio',
      'id_persona',
      'id_deletedby',
    ];

}
