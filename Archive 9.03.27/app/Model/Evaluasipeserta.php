<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Evaluasipeserta extends Model
{
    use SoftDeletes;
    protected $table = 'evaluasipesertas';
    protected $fillable =  ['user_id','penyelenggara_id','narasumber_id','nama_narasumber','materi_fasilitasi','jam_ke','jenis','pilihan','saran','fasilitasi_id','created_at','updated_at','deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
    public function penyelenggara()
    {
        return $this->belongsTo('App\Model\Evaluasipenyelenggara', 'penyelenggara_id');
    }
    public function narasumber()
    {
        return $this->belongsTo('App\Model\Evaluasinarasumber', 'narasumber_id');
    }
    public function fasilitasi()
    {
        return $this->belongsTo('App\Model\KegiatanFasilitasi', 'fasilitasi_id');
    }
}
