<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Testpesertaset extends Model
{
    use SoftDeletes;
    protected $table = 'testpesertasets';
    protected $fillable =  ['user_id','question_id','answer_id','jawaban','fasilitasi_id','created_at','updated_at','deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
    public function pertanyaan()
    {
        return $this->belongsTo('App\Model\Postpretest', 'question_id');
    }
    public function jawaban()
    {
        return $this->belongsTo('App\Model\Answerpostpretest', 'answer_id');
    }
    public function fasilitasi()
    {
        return $this->belongsTo('App\Model\KegiatanFasilitasi', 'fasilitasi_id');
    }
}
