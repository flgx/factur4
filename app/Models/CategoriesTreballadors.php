<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesTreballadors extends Model
{
  protected $table = 'categoriesTreballadors';

  protected  $fillable = [
    'nom',
    'salari',
    ];
}
