<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Klien extends Model
{
    protected $table = 'client';
    protected $fillable = array(
        'name',
        'email',
        'phone_number',
        'address',
        'location_id',
        'country_id',
    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );
}
