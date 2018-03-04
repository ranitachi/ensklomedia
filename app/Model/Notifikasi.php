<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notifikasi extends Model
{
    //video_id
    use SoftDeletes;
    protected $table = 'notifikasi';
    protected $fillable =  ['video_id','title','from','to','seen','flag_active','created_at','updated_at'];
}
