<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Province extends Model
{
    use SoftDeletes;
    protected $table = 'provinces';
    protected $fillable =  ['id','name','created_at','updated_at','deleted_at'];

}
