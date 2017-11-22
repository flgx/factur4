<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Referents;

class SolicitudsTasques extends Model
{
    protected $table = 'solicitudsTasques';

    protected $fillable = [
        'pacient',
        'centreResident',
        'centreAtencio',
        'tipoVisita',
        'id_estat', // 1 = En espera, 2 = Denegat, 3 = Validat
        'datainici',
        'datafi',
        'horainici',
        'horafi',
        'motiu',
        'observacions',
        'id_referent',
        'id_createdby'
    ];

  /**
   * Scope a query to only include popular users.
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeReferent($query)
  {
      if(!Auth::user()->isAdmin()){
        $ref = Auth::user()->referent;

        return $query->where('id_referent', $ref->id);
      } else {
          return $query;
      }
  }

    /**
     *
     */
    public function solicitudPacient()
    {
        return $this->belongsTo(Pacients::class, 'pacient');
    }

    /**
     *
     */
    public function referent()
    {
        return $this->belongsTo(Referents::class, 'id_referent');
    }

}
