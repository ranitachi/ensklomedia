<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Penilaian extends Model
{
    use SoftDeletes;
    protected $table = 'penilaian';
    protected $fillable =  ['instrumen_id','reviewer_id','video_id','nilai','flag','created_at','updated_at','deleted_at'];
    
    public function reviewer()
    {
        return $this->belongsTo('App\Model\Users', 'reviewer_id');
    }
    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }
    public function intrumen()
    {
        return $this->belongsTo('App\Model\Instrumen', 'reviewer_id');
    }
}
