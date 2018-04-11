<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AnswerTest extends Model
{
    use SoftDeletes;
    protected $table = 'answer_tests';
    protected $fillable =  ['question_id','answer','flag','created_at','updated_at','deleted_at'];

    public function test()
    {
        return $this->belongsTo('App\Model\Test', 'question_id');
    }
}
