<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
<<<<<<< HEAD

    protected $table = 'video';

    protected $fillable =  [
        'user_id','category_id','title','desc','video_path','image_path',
        'tags','hit','slug','approved_by','approved_at','deactivated_at',
        'deleted_at','created_at','updated_at'
    ];
=======
    protected $table = 'video';
    protected $dates = ['deleted_at'];
    protected $fillable =  ['id','userid','videofile','filetype','title','description','tags','image','turunan1','turunan2','turunan3','turunan4','turunan5','catatan','registrationip','approvedat','approvedby','statusaktif','hit','createdat','slug','category_id','created_at','updated_at'];
>>>>>>> 71e9ee2797aa471b7710c107c242d88533944045
}
