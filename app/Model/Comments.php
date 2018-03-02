<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = ['video_id','user_id','parent_id','comment'];

    public function video()
    {
        return $this->belongsTo('App\Model\Video', 'video_id');
    }
}
