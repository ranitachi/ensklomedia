<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Latihansaung extends Model
{
    use SoftDeletes;
    protected $table = 'latihansaungs';
    protected $fillable =  ['test_id','saung_id','flag','created_at','updated_at','deleted_at'];
    
    public function test()
    {
        return $this->belongsTo('App\Model\Test', 'test_id');
    }
    public function saung()
    {
        return $this->belongsTo('App\Model\Saung', 'saung_id');
    }
}
