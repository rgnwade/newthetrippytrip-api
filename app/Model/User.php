<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Auth;
use DateTime;
use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';
    protected $fillable = array(
        'name',
        'email',
        'password',
        'priority',
        'birthdate',
        'gender',
        'provider',
        'provider_id',
        'activation_token',
        'remember_token',
        'description',
        'phone_number',
        'picture',
        'active',
        'created_by',
        'last_login_at',
        'ip_addr',
        'credit',
        'address',
        'facebook_username',
        'api_token',
        'device_id'
    );
    protected $dontKeepRevisionOf = array(
        'remember_token','last_login_at','active','provider','provider_id','activation_token','api_token'
    );

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = array(
        'last_login_at',
        'created_at',
        'updated_at',
        'bump_at'

    );


    protected $hidden = array(
        'password', 'remember_token','device_id'
    );
}
