<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PesertaFasilitasi extends Model
{
    use SoftDeletes;
    protected $table = 'peserta_fasilitasis';
    protected $fillable =  ['user_id','fasilitasi_id','flag','created_at','updated_at','deleted_at'];
    
    public function fasilitasi()
    {
        return $this->belongsTo('App\Model\KegiatanFasilitasi', 'fasilitasi_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Users', 'user_id');
    }
}
