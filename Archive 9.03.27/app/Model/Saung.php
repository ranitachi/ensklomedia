<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Saung extends Model
{
    use SoftDeletes;
    protected $table = 'saungs';
    protected $fillable =  ['saung_name','video_id','fasilitasi_id','created_user_id','reviewer_id','flag','created_at','updated_at','deleted_at'];
    
    public function fasilitasi()
    {
        return $this->belongsTo('App\Model\KegiatanFasilitasi', 'fasilitasi_id');
    }

    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'created_user_id');
    }
    public function reviewer()
    {
        return $this->belongsTo('App\Model\Users', 'reviewer_id');
    }
}
