<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MenuPivot extends Model
{
    //user_idwilayah_idstart_dateend_dateflag
    use SoftDeletes;
    protected $table = 'menu_pivots';
    protected $fillable =  ['menu_id','fasilitasi_id','user_id','flag','level','created_at','updated_at','deleted_at'];
    
    public function menu()
    {
        return $this->belongsTo('App\Model\Menu', 'menu_id');
    }
    
    public function fasilitasi()
    {
        return $this->belongsTo('App\Model\KegiatanFasilitasi', 'fasilitasi_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
}
