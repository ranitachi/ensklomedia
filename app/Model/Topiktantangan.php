<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Topiktantangan extends Model
{
    use SoftDeletes;
    protected $table = 'topik_tantangan';
    protected $fillable =  ['video_id','saung_id','topik','penjelasan','flag','created_at','updated_at','deleted_at'];
    
    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }

}
