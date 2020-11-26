<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Map extends Model
{
    use HasFactory, SoftDeletes;
    protected $hidden = array('properties.quartier_id', 'created_at','updated_at');

    public function quartier()
    {
        return $this->hasOne(Quartier::class, '_id', 'properties.quartier_id');
    }
}
