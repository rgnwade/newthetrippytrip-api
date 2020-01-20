<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Region extends Model
{
    protected $table = 'region';
    protected $fillable = array(
        'location_id',
        'name',
        'slug',
    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );
}
