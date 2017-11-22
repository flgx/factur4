<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegacions extends Model
{
  protected $table = 'delegacions';

  protected  $fillable = [
      'nom',
      'CP',
      'poblacio',
      'provincia',
      'pais',
      'telefon',
      'email',
      'fax',
      'responsable',
    ];
}
