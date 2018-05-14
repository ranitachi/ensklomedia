<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pesertatantangan extends Model
{
    use SoftDeletes;
    protected $table = 'peserta_tantangan';
    protected $fillable =  ['video_id','user_id','saung_id','tantangan_id','judul','penjelasan','flag','created_at','updated_at','deleted_at'];
    
    public function tantangan()
    {
        return $this->belongsTo('App\Model\Topiktantangan', 'tantangan_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }
}
