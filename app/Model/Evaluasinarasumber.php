<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Evaluasinarasumber extends Model
{
    use SoftDeletes;
    protected $table = 'evaluasinarasumbers';
    protected $fillable =  ['jenis','butir_penilaian','flag','created_at','updated_at','deleted_at'];
    
}
