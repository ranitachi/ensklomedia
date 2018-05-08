<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Test extends Model
{

    use SoftDeletes;
    protected $table = 'tests';
    protected $fillable =  ['question','essay','category','flag','created_at','updated_at','deleted_at'];

}
