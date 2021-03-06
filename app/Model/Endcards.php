<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endcards extends Model
{
    use SoftDeletes;
    protected $table = "endcards";

    protected $fillable = ['video_id','title','link','deactivated_at','deleted_at','created_at','updated_at'];
}
