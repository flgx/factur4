<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despeses extends Model
{
  protected $table = 'despeses';

  protected  $fillable = [
      'nom',
    ];
}
