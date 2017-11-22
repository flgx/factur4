<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtasques extends Model
{
    protected $table = 'subtasques';

    protected $fillable = [
        'id_tasca',
        'id_treballador',
        'extres',
        'horainici',
        'horafi',
        'comentaris',
    ];

    /**
     *
     */
    public function tasques()
    {
        return $this->belongsTo(Tasques::class);
    }

    /**
     * @return belongsToMany
     */
    public function despeses()
    {
        return $this->belongsToMany(Despeses::class, 'despeses_subtasca', 'id_subtasca', 'id_despesa')->withPivot(['id','preu']);
    }
}
