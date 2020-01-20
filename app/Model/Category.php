<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = array(
        'parent_id',
        'name',
        'slug'
    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );
}
