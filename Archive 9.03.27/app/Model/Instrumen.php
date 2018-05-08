<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Instrumen extends Model
{
    use SoftDeletes;
    protected $table = 'instrumen';
    protected $fillable =  ['category_id','pertanyaan','bobot','flag','created_at','updated_at','deleted_at'];
    
}
