<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class History extends Model
{
    use SoftDeletes;
    protected $table = 'history';
    protected $fillable =  ['user_id','video_id','video_title','category_id','created_at','updated_at'];
}
