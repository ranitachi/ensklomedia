<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body onLoad="window.print()">
		<div style="padding:300px 50px 0px 50px;" class="body">
			<center>
				Nomor : ___________________
				<br>
				<br>
				<br>
				Diberikan Kepada :

				<h1>{{$peserta->user->profile->name}}</h1>
				<h1>{{$peserta->user->profile->nama_unit_kerja}}</h1>
				<br>
				Telah berperan aktif sebagai :
				<h1>Peserta</h1>
			</center>
			<p style="text-align:justify">
				@php
					list($thn1,$bln1,$tgl1)=explode('-',$peserta->fasilitasi->start_date);
					list($thn2,$bln2,$tgl2)=explode('-',$peserta->fasilitasi->end_date);
					
				@endphp
				Dalam Kegiatan <B><i>Fasilitasi Guru Terampil dalam Memanfaatkan TIK Berbasis Radio,
Televisi, dan Film untuk Pendidikan Tahun {{date('Y')}}</i></B> yang dilaksanakan oleh Pusat Teknologi
Informasi dan Komunikasi Pendidikan dan Kebudayaan (PUSTEKKOM) Kementerian
Pendidikan dan Kebudayaan pada tanggal {{$tgl1.' '.getBulan($bln1)}} s.d. {{$tgl2.' '.getBulan($bln2)}} {{$thn1}}, {{ucwords(strtolower($peserta->fasilitasi->provinsi->name))}}.
			</p>
		
			<div style="float:left;width:50%">
			&nbsp;	
			</div>
			<div style="float:right;width:50%">
			<p>Jakarta, <br>
			Kepala Pusat Teknologi Informasi dan<br>
			Komunikasi Pendidikan dan Kebudayaan
			<br>
			<br>
			<br>
			<br>
			<br>
			<b><u>Gogot Suharwoto, Ph.D.</u></b><br>
			NIP 197102111993 011002	</p>
			</div>
		</div>
	</body>
</html>
<style type="text/css" media="print">
  @page { 
  	size: A4; 
  }
  @media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
  .body
  {
      height: 297mm;
  }
  /* ... the rest of the rules ... */
}
</style>
<style type="text/css">
*
{
	line-height: 20px;
	font-size : 15px;
}
table td div
{
    font-size : 15px !important;
}
table td
{
    padding:1px !important;
    margin:1px !important;
}
.tabel th,
.tabel td
{
	vertical-align: top;
	padding:3px;
}
.tabel th
{
	background: #ddd;
	vertical-align: middle !important;
}

h1,h2,h4,h5
{
	padding: 5px !important;
	margin: 5px !important;
}
h1{
	font-weight: 500;
	font-size:24px;
}
h6,h3
{
	padding: 1px !important;
	margin: 1px !important;
}
div
{
	font-size: 12px !important;
	padding-top:0px;
	padding-bottom:0px;
	margin-top:-1px !important;
	margin-bottom:0px;
}
ol li 
{
	margin-top:3px !important;
	margin-bottom:0px !important;
}
</style>