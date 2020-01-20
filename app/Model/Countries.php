<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Countries extends Model
{
    protected $table = 'countries';
    protected $fillable = array(
        'name',
        'currency_code',
        'phone',
        'languages',
    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );
}
