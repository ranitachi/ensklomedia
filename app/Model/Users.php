<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable =  [
        'email','password','registration_ip','authentication_key','authorization_level',
        'location','timezone','remember_token','activated_at','deactivated_at',
        'blocked_at','last_login_at','deleted_at','created_at','updated_at'
    ];

    public function profile()
    {
        return $this->hasOne('App\Model\Profile', 'user_id');
    }
}
