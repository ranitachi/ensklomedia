<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Users extends Model
{
    use SoftDeletes;
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    protected $fillable =  ['name','email','unconfirmed_email','username','password_hash','password','auth_key','registration_ip','confirmed_at','blocked_at','flags','last_login_at','hakakses','status','created_at','updated_at'];
}
