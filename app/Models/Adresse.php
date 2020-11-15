<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Adresse extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = array('quartier_id', 'section_id','updated_at');

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function quartier()
    {
        return $this->belongsTo(Quartier::class);
    }

    public function servicesIntradelZone()
    {
        return $this->belongsTo(Services\Intradel\Zone::class, 'services.intradel.zone_id', '_id');
    }
}
