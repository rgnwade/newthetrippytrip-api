<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Subscribe extends Model
{
    protected $table = 'subscribe';
    protected $fillable = array(
        'email',
    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );
}
