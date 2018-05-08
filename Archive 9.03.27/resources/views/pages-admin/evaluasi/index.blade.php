@extends('layouts.master-admin')

@section('title')
    <title>Kegiatan Fasilitasi - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">

                    <div class="col-md-12">
                        <a href="{{url('kegiatan-fasilitasi/'.$fas->id)}}" class="btn btn-primary btn-md pull-right"><i class="fa fa-chevron-left"></i> &nbsp;&nbsp;Kembali Ke Menu Fasilitasi</a>
                        
                    </div>
                    <div class="col-md-12">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <strong>Sukses!</strong> 
                                {{ Session::get('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        
                        <div class="row">
                            <div class="col-md-12" >
                                <h1 class="new-video-title"> Informasi Kegiatan Fasilitasi</h1>
                            </div>
                        </div>
                        <div class="row" id="">
                            {{-- <div class="col-md-4">Nama Kegiatan</div>
                            <div class="col-md-8">:&nbsp;&nbsp;<b>{{strtoupper($fas->nama_fasilitasi)}}</b></div> --}}
                            <div class="col-md-4">Lokasi Kegiatan</div>
                            <div class="col-md-8">:&nbsp;&nbsp;<b>{{$fas->provinsi->name}}</b></div>
                            <div class="col-md-4">Waktu Kegiatan</div>
                            <div class="col-md-8">:&nbsp;&nbsp;<b>{{date('d-m-Y',strtotime($fas->start_date))}}</b> s.d. <b>{{date('d-m-Y',strtotime($fas->end_date))}}</b></div>
                            
                        </div><!-- // row -->
                        <br>
                        <br>
                        <a href="javascript:loadform('narasumber',{{$idfasil}})" class="btn btn-sm btn-primary" style="margin-bottom:10px;"><i class="fa fa-chevron-circle-right"></i>&nbsp;&nbsp;Evaluasi Narasumber</a><br>
                        <a href="javascript:loadform('penyelenggara',{{$idfasil}})" class="btn btn-sm" style="background-color:darkblue;color:white"><i class="fa fa-chevron-circle-right"></i>&nbsp;&nbsp;Evaluasi Penyelenggaraan</a>
                    </div>
                    <div class="col-md-8">
                        
                    
                   
                        @if (Session::has('hasil'))
                            <div class="col-md-12">
                                <div class="alert alert-success text-left">
                                    <h2 style="margin-top:12px !important;">
                                        {!! Session::get('hasil') !!}
                                    </h2> 
                                </div>
                            </div>
                        
                        @endif
                        <div class="col-md-12">
                            <div id="data"></div>            
                        </div>
                    </div>
                </div><!-- // row -->
            </div>

@endsection
@section('footscript')
    <script>
        $(document).ready(function(){
            loadform('narasumber','{{$idfasil}}');
            var pesan='{!! Session::get("status") !!}';
            if(pesan!='')
            {
                $('#content-body-ok').html('<h2 style="color:black">'+pesan+'</h2>');
                $('#modal_ok').modal('show');
            }
        });
        function loadform(jenis,idfasil)
        {
            $('#data').load(APP_URL+'/evaluasi/'+jenis+'/'+idfasil);
        }
        function endevaluasinarasumber(jenis,idfasil)
        {
            var nama_narasumber=$('#nama_narasumber').val();
            var materi_fasilitasi=$('#materi_fasilitasi').val();
            var jam_ke=$('#jam_ke').val();
            if(nama_narasumber=='')
            {
                var txt = "Nama Narasumber Belum Diisi";
                $.notify(txt,{
                    elementPosition: 'bottom right',
                    globalPosition: 'buttom right',
                    className : 'error',
                    z_index : 1500000
                });    
            }
            else if(materi_fasilitasi=='')
            {
                var txt = "Materi Fasilitasi Belum Di Isi";
                $.notify(txt,{
                    elementPosition: 'bottom right',
                    globalPosition: 'buttom right',
                    className : 'error',
                    z_index : 1500000
                });
            }
            else if(jam_ke=='')
            {
                var txt = "Jam Ke Belum Diisi";
                $.notify(txt,{
                    elementPosition: 'bottom right',
                    globalPosition: 'buttom right',
                    className : 'error',
                    z_index : 1500000
                });
            }
            else
            {
                $('#content-body').html('<h1 style="color:#000">Anda yakin ingin Menyimpan Data Evaluasi Ini ?</h1>');
                $('#modal_default').modal('show');
                $('button#ok').html('<i class="fa fa-check"></i>&nbsp;Ya');
                $('button#ok').one('click',function(){
                    $('#form-evaluasi-narsum').submit();
                });
            }
        }
        function endevaluasipenyelenggara(jenis,idfasil)
        {
            
            $('#content-body').html('<h1 style="color:#000">Anda yakin ingin Menyimpan Data Evaluasi Ini ?</h1>');
            $('#modal_default').modal('show');
            $('button#ok').html('<i class="fa fa-check"></i>&nbsp;Ya');
            $('button#ok').one('click',function(){
                $('#form-evaluasi-penyelenggara').submit();
            });
            
        }
        var currentLocation = window.location;
        
    </script>
@endsection

 <style>
    .chosen-container
    {
        width:100% !important;
    }
    th,td
    {
        font-size:11px !important;
        font-weight:400;
        color:#000;
    }
    span.label
    {
        font-size:11px !important;
    }
</style>