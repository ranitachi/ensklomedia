<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endcards extends Model
{
    use SoftDeletes;

    protected $table = "endcards";
    protected $dates = "deleted_at";
    protected $fillable = ['video_id','title','link','deactivated_at'];
}
