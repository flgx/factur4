<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorsaTreball extends Model
{
  protected $table = 'borsaTreball';

  protected  $fillable = [
    'id',
    'id_formulario',
    'nombre',
    'fecha_nacimiento'
    ];


   
}
