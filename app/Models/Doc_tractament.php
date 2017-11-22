<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc_tractament extends Model
{
    protected $table = 'doc_tractament';

    protected $fillable = [
        'id_tasca',
        'farmactractament',
        'horatractament',
        'diestractament'
    ];

    /**
     *
     */
    public function tasca()
    {
        return $this->belongsTo(Tasques::class, 'id_tasca');
    }
}
