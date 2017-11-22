<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasques extends Model//tasques  son les  que crea el treballador a partir de TasquesReferent
{
    protected $table = 'tasques';

    protected $fillable = [
        'datainici',
        'datafi',
        'horainici',
        'horafi',
        'id_estattasca',
        'descripcio',
        'id_pacient',
        'tipoVisita',
        'plantilla',
        'id_plantilla',
        'repeticio',
        'repeticioDia',
        'repeticioSemana',
        'repeticioMes',
        'diesDeLaSemana',
        'diaDelMesOSemana',
        'finalitza'
    ];

    /**
     *
     */
    public function pacient()
    {
        return $this->belongsTo(Pacients::class, 'id_pacient');
    }

    /**
     *
     */
    public function estatstasca()
    {
        return $this->belongsTo(EstatsTasca::class, 'id_estattasca');
    }

    /**
     *
     */
    public function subtasques()
    {
        return $this->hasMany(Subtasques::class);
    }

    /**
     *
     */
    public function treballadors()
    {
        return $this->belongsToMany(Treballadors::class, 'subtasques', 'id_tasca', 'id_treballador');
    }

    /**
     *
     */
    public function docVisitamedica()
    {
        return $this->hasOne(Doc_visitamedica::class, 'id_tasca');
    }

    /**
     *
     */
    public function docUrgenciaMedica()
    {
        return $this->hasOne(Doc_urgenciamedica::class, 'id_tasca');
    }

    /**
     *
     */
    public function docHospitalitzacio()
    {
        return $this->hasOne(Doc_hospitalitzacio::class, 'id_tasca');
    }

    /**
     *
     */
    public function solicitud()
    {
        return $this->belongsTo(SolicitudsTasques::class, 'id_solicitud');
    }

    /**
     *
     */
    public function parent()
    {
        return $this->belongsTo(Tasques::class, 'id_plantilla');
    }

    /**
     *
     */
    public function children()
    {
        return $this->hasMany(Tasques::class, 'id_plantilla');
    }
}
