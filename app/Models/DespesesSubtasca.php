<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DespesesSubtasca extends Model
{
    protected $table = 'despeses_subtasca';

    protected $fillable = [
        'id_subtasca',
        'id_despesa',
        'preu',
        'horainici',
        'horafi',
    ];


}
