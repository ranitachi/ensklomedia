<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notifikasi extends Model
{
    //video_id
    use SoftDeletes;
    protected $table = 'notifikasi';
    protected $fillable =  ['video_id','saung_id','title','from','to','seen','flag_active','created_at','updated_at'];
    public function dari()
    {
        return $this->belongsTo('App\Model\Users', 'from');
    }
    public function to()
    {
        return $this->belongsTo('App\Model\Users', 'to');
    }
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }
    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }
}
