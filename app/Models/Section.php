<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;
    protected $hidden = array('created_at','updated_at');

    public function adresses()
    {
        return $this->hasMany(Adresse::class);
    }
}
