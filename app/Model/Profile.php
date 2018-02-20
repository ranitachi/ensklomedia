<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'profile';

    protected $dates = ['deleted_at'];
    
    protected $fillable =  [
        'user_id','name','channel_name','website','bio',
        'gender','profession','province','district','address',
        'phone_number','institute','educational_level','educational_level_detail','place_of_birth',
        'date_of_birth','deleted_at','created_at','updated_at'
    ];
}
