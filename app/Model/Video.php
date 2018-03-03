<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $table = 'video';

    protected $fillable =  [
        'user_id','category_id','title','desc','video_path','image_path',
        'tags','hit','slug','approved_by','approved_at','deactivated_at',
        'deleted_at','created_at','updated_at'
    ];

    public function scopeByCategory($query, $id)
    {
        return $query->where('category_id', $id);
    }
    public function scopeByUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
}
