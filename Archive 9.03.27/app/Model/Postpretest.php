<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postpretest extends Model
{
    //
    use SoftDeletes;
    protected $table = 'postpretests';
    protected $fillable =  ['question','essay','flag_pretest','flag_posttest','flag','created_at','updated_at','deleted_at'];
    
}
