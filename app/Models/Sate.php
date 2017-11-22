<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sate extends Model
{
  protected $table = 'sate';

  protected  $fillable = [
    'nom',
    'cif',
    'email',
    'CP',
    'poblacio',
    'direccio',
    'provincia',
    'telefon',
    'fax',
    'responsable',
    'telefonResponsable'
    ];
}
