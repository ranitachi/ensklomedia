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
function split_title($text)
{
    $splitstring1 = substr($text, 0, floor(strlen($text) / 2));
    $splitstring2 = substr($text, floor(strlen($text) / 2));

    if (substr($splitstring1, 0, -1) != ' ' AND substr($splitstring2, 0, 1) != ' ')
    {
        $middle = strlen($splitstring1) + strpos($splitstring2, ' ') + 1;
    }
    else
    {
        $middle = strrpos(substr($text, 0, floor(strlen($text) / 2)), ' ') + 1;    
    }

    $string1 = substr($text, 0, $middle);  // "The Quick : Brown Fox Jumped "
    $string2 = substr($text, $middle);
    return $string1.' '.$string2;
}
function cekfile($file)
{
    $file_headers = @get_headers($file);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $exists = false;
    }
    else {
        $exists = true;
    }
    return $exists;
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
        case 5 :
            $lv='PIC Fasilitasi';
            break;
    }
    return $lv;
}
function level()
{
    $lv=array('Super Admin','Admin','Super User','Reviewer','Contributor','PIC Fasilitasi');
    return $lv;
}
function rating($star)
{
    $s1=$star;
    $s2=5-$star;
    $s='';
    if($star>0)
    {

        for($i=1;$i<=$s1;$i++)
        {
            $s.='<span class="fa fa-star checked"></span>';
        }
        for($j=1;$j<=$s2;$j++)
        {
            $s.='<span class="fa fa-star"></span>';
        }
    }
    return $s;
}
?>