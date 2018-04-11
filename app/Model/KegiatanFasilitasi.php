<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanFasilitasi extends Model
{
    //user_idwilayah_idstart_dateend_dateflag
    use SoftDeletes;
    protected $table = 'kegiatan_fasilitasis';
    protected $fillable =  ['nama_fasilitasi','fasilitasi_id','wilayah_id','start_date','end_date','flag','created_at','updated_at','deleted_at'];

    public function provinsi()
    {
        return $this->belongsTo('App\Model\Province', 'wilayah_id');
    }
}
