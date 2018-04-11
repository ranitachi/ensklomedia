<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PetaMateri extends Model
{
    use SoftDeletes;
    protected $table = 'peta_materi';
    protected $fillable =  ['category_id','title','desc','flag','created_at','updated_at','deleted_at'];
    
    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }
}
