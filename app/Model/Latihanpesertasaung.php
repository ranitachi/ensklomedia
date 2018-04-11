<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Latihanpesertasaung extends Model
{
    use SoftDeletes;
    protected $table = 'latihan_peserta_saung';
    protected $fillable =  ['latihan_id','user_id','test_id','answer_id','saung_id','status','nilai','flag','created_at','updated_at','deleted_at'];
    
    public function latihan()
    {
        return $this->belongsTo('App\Model\Latihansaung', 'test_id');
    }
    public function test()
    {
        return $this->belongsTo('App\Model\Test', 'test_id');
    }
    public function answer()
    {
        return $this->belongsTo('App\Model\Answer', 'answer_id');
    }
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
}
