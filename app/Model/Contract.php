<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class Contract extends Model
{
    protected $table = 'contract';
    protected $fillable = array(
        'contract_number',
        'client_id',
        'sales_id',
        'files',
        'expired'
    );

    protected $dates = array(
        'created_at',
        'updated_at'
    );
}
