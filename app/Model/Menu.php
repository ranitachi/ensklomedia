<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Menu extends Model
{
    //user_idwilayah_idstart_dateend_dateflag
    use SoftDeletes;
    protected $table = 'menus';
    protected $fillable =  ['title','desc','id_parent','route','flag','created_at','updated_at','deleted_at'];
    
    public function menu()
    {
        return $this->belongsTo('App\Model\Menu', 'id_parent');
    }
}
