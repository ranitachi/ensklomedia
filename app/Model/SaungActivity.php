<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SaungActivity extends Model
{
    use SoftDeletes;
    protected $table = 'saung_activities';
    protected $fillable =  ['saung_id','user_id','activity','created_at','updated_at','deleted_at'];
    
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
}
