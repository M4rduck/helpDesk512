<?php

namespace App\Models\Incidence;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    protected $table = 'solicitude';
    
    /**
     * Campos que se van a utilizar en la BD.
     *
     * @var array
     */
    protected $fillable = [
        'area_id',
        'title',
        'description',
        'evidence_route',
    ];

    public function area()
    {
        return $this->belongsTo('App\Area', 'id_area', 'id');
    }

    public function incidence()
    {
        return $this->hasMany('App\Models\Incidence\Incidence', 'id_solicitude', 'id');
    }
}
