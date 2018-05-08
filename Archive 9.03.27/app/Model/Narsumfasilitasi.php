<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Narsumfasilitasi extends Model
{
    //user_idwilayah_idstart_dateend_dateflag
    use SoftDeletes;
    protected $table = 'narsumfasilitasis';
    protected $fillable =  ['narsum_1_id','narsum_2_id','wilayah_id','start_date','end_date','flag','created_at','updated_at','deleted_at'];
    
    public function provinsi()
    {
        return $this->belongsTo('App\Model\Province', 'wilayah_id');
    }

    public function narsum1()
    {
        return $this->belongsTo('App\Model\Users', 'narsum_1_id');
    }
    public function narsum2()
    {
        return $this->belongsTo('App\Model\Users', 'narsum_2_id');
    }
}
