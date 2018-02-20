<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;

    protected $table = 'category';
    
    protected $fillable =  ['code','name','desc','deactivated_at','deleted_at','created_at','updated_at'];
}
