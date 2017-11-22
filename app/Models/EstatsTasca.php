<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstatsTasca extends Model
{
    protected $table = 'estatsTasca';


    protected $fillable = [
        'nom'
    ];


    /**
     *
     */
    public function tasques()
    {
        return $this->hasMany(Tasques::class);
    }
}
