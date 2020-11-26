<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Quartier extends Model
{
    use HasFactory, SoftDeletes;
    protected $hidden = array('created_at','updated_at');

    public function adresses()
    {
        return $this->hasMany(Adresse::class);
    }

    public function map()
    {
        return $this->hasOne(Map::class, 'properties.quartier_id', '_id');
    }
}
