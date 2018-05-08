<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Chat extends Model
{
    use SoftDeletes;
    protected $table = 'chat';
    protected $fillable =  ['user_id','chat','saung_id','created_at','updated_at','deleted_at'];
    
    
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_created_id');
    }
}
