<?php
function checkExternalFile($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $retCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $retCode;
}
function getDuration($full_video_path)
{
    $getID3 = new \getID3;
    $file = $getID3->analyze($full_video_path);
    $playtime_seconds = $file['playtime_seconds'];
    $duration = date('H:i:s.v', $playtime_seconds);

    return $duration;
}
function translate($string,$from,$to)
{
    $en=array('months','years','dates','ago','minutes','hours','hour','seconds','second','minute');
    $id=array('bulan','tahun','tanggal','lalu','menit','jam','jam','detik','detik','menit');
    $res='';
    $cek=array_search($string, ${$from});
    // if($cek)
    // {
    //     if(isset(${$to}[$cek]))
    //     {
    //         $res=${$to}[$cek];
    //     }        
    // }
    return ${$to}[$cek];
    // return $res;
}
function text_translate($string,$from,$to)
{
    $dt=explode(' ',$string);
    $str='';
    foreach($dt as $k => $v)
    {
        if(is_numeric($v))
            $str.=$v.' ';
        else
            $str.=translate(trim($v),$from,$to).' ';
    }
    return ucwords($str);
}

function leveluser($level)
{
    switch($level)
    {
        case 0 :
            $lv='Super Admin';
            break;
        case 1 :
            $lv='Admin';
            break;
        case 2 :
            $lv='Super User';
            break;
        case 3 :
            $lv='Reviewer';
            break;
        case 4 :
            $lv='Contributor';
            break;
    }
    return $lv;
}
function level()
{
    $lv=array('Super Admin','Admin','Super User','Reviewer','Contributor');
    return $lv;
}
?>