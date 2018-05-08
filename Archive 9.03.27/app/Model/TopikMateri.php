<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TopikMateri extends Model
{
    use SoftDeletes;
    protected $table = 'topik_materi';
    protected $fillable =  ['category_id','mapel_id','title','desc','flag','created_at','updated_at','deleted_at'];
    
    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }
    public function mapel()
    {
        return $this->belongsTo('App\Model\PetaMateri', 'mapel_id');
    }
}
