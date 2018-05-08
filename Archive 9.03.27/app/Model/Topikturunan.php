<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Topikturunan extends Model
{
    use SoftDeletes;
    protected $table = 'topikturunans';
    protected $fillable =  ['video_id','user_created_id','saung_id','topik','penjelasan','flag','created_at','updated_at','deleted_at'];
    
    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_created_id');
    }
}
