<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc_provesrealitzades extends Model
{
    protected $fillable = [
        'prova',
        'horaprova',
        'resultatprova'
    ];

    /**
     *
     */
    public function tasca()
    {
        return $this->belongsTo(Tasques::class, 'id_tasca');
    }
}
