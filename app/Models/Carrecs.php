<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrecs extends Model
{
  protected $table = 'carrecs';

  protected  $fillable = [
      'nom',
    ];
}
