<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Nilaitespeserta extends Model
{
    use SoftDeletes;
    protected $table = 'nilaitespesertas';
    protected $fillable =  ['user_id','nilai','jenis','fasilitasi_id','created_at','updated_at','deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
    public function fasilitasi()
    {
        return $this->belongsTo('App\Model\KegiatanFasilitasi', 'fasilitasi_id');
    }
}
