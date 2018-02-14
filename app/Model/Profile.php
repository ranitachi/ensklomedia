<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Profile extends Model
{
    use SoftDeletes;
    protected $table = 'profile';
    protected $dates = ['deleted_at'];
    protected $fillable =  ['name','public_email','gravatar_email','gravatar_id','location','website','bio','timezone','rekomendasi','nama','jk','profesi','provinsi','kabupaten','alamat1','hp','email','instansi','jenjang','alamat','telp','pelatihan_id','tahun_id','tempatlahir','tgllahir','golnip','npwp','s1','s2','s3','slain','namakepsek','hpkepsek','emailkepsek','petugaspusat','flags','created_at','updated_at'];
}
