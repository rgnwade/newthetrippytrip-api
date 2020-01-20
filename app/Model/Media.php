<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = array(
        'name',
        'link',
    );

    protected $dates = array(
        'created_at',
        'updated_at'

    );
}
