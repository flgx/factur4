<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referents extends Model
{
    protected $table = 'referents';

    protected $fillable = [
        'nom',
        'cognoms',
        'CP',
        'poblacio',
        'provincia',
        'pais',
        'telefon',
        'email',
        'carrec',
        'empresa',
        'id_entitat',
    ];

    /**
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     *
     */
    public function entitat()
    {
        return $this->belongsTo(Entitats::class, 'id_entitat');
    }
}
