<?php

namespace App\Models\Services\Intradel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use App\Models\Adresse;

class Zone extends Model
{
    protected $collection = 'services_intradel_zones';
    use HasFactory, SoftDeletes;
    protected $hidden = array('created_at','updated_at');

    public function adresses()
    {
        return $this->hasMany(Adresse::class, 'services.intradel.zone_id', '_id');
    }
}
