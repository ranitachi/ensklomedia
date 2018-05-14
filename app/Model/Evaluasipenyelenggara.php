<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Evaluasipenyelenggara extends Model
{
    use SoftDeletes;
    protected $table = 'evaluasipenyelenggaras';
    protected $fillable =  ['indikator','id_parent','pilihan','flag','created_at','updated_at','deleted_at'];
    
}
