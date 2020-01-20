<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = array(
        'parent_category_id',
        'category_id',
        'author_id',
        'client_id',
        'location_id',
        'title',
        'content',
        'thumbnail_pict',
        'video',
        'is_homepage',
        'is_page',
        'description',
        'active',
        'total_visitors'
    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );
}
