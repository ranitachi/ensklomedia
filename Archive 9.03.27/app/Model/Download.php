<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'downloads';
    protected $fillable =  ['video_id','user_id','created_at','updated_at'];

    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
}
