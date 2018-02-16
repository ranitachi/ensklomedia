<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Video extends Model
{
    use SoftDeletes;
    protected $table = 'profile';
    protected $dates = ['deleted_at'];
    protected $fillable =  ['userid','videofile','filetype','title','description','tags','image','turunan1','turunan2','turunan3','turunan4','turunan5','catatan','registrationip','approvedat','approvedby','statusaktif','hit','createdat','slug','category_id','created_at','updated_at'];
}
