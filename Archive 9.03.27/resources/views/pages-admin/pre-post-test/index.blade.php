@extends('layouts.master-admin')

@section('title')
    <title>Kegiatan Fasilitasi - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">

                    <div class="col-md-12">
                        <a href="{{url('kegiatan-fasilitasi/'.$fas->id)}}" class="btn btn-primary btn-md pull-right">Kembali Ke Menu Fasilitasi</a>
                        
                    </div>
                    <div class="col-md-12">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <strong>Sukses!</strong> 
                                {{ Session::get('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-5">
                        
                        <div class="row">
                            <div class="col-md-12" >
                                <h1 class="new-video-title"> Informasi Kegiatan Fasilitasi</h1>
                            </div>
                        </div>
                        <div class="row" id="data">
                            {{-- <div class="col-md-4">Nama Kegiatan</div>
                            <div class="col-md-8">:&nbsp;&nbsp;<b>{{strtoupper($fas->nama_fasilitasi)}}</b></div> --}}
                            <div class="col-md-4">Lokasi Kegiatan</div>
                            <div class="col-md-8">:&nbsp;&nbsp;<b>{{$fas->provinsi->name}}</b></div>
                            <div class="col-md-4">Waktu Kegiatan</div>
                            <div class="col-md-8">:&nbsp;&nbsp;<b>{{date('d-m-Y',strtotime($fas->start_date))}}</b> s.d. <b>{{date('d-m-Y',strtotime($fas->end_date))}}</b></div>
                            
                        </div><!-- // row -->


                    </div>
                    <div class="col-md-5">
                        <h4>Jumlah Pertanyaan</h4>
                        No : 
                        @foreach ($soal as $i => $v)
                        @php
                            $no=++$i;
                        @endphp
                            @if (isset($jwb[$v->id]))
                                <a class="btn btn-xs btn-danger" id="soal_{{$no}}" href="javascript:loadsoal('{{$jenis}}','{{$idfasil}}',{{$v->id}},{{$no}})">{{$no}}</a>
                            @else
                                <a class="btn btn-xs btn-primary" id="soal_{{$no}}" href="javascript:loadsoal('{{$jenis}}','{{$idfasil}}',{{$v->id}},{{$no}})">{{$no}}</a>
                            @endif
                        @endforeach
                    </div>
                   
                    @if (Session::has('hasil'))
                        <div class="col-md-12">
                            <div class="alert alert-success text-center">
                                <h2 style="margin-top:12px !important;">
                                    {!! Session::get('hasil') !!}
                                </h2> 
                            </div>
                        </div>
                    @else
                         @if (count($ceknilai)!=0)
                            <div class="col-md-12">
                                <div class="alert alert-success text-center">
                                    <h2 style="margin-top:12px !important;">
                                        Anda Telah Menyelesaikan {{ucwords($jenis)}} Test dengan <br><b style="font-size:15px;"><u>Nilai : {{$ceknilai->nilai}}</u></b>
                                    </h2> 
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i>  {{ucwords($jenis)}} Test</h1>
                            </div>
                           
                        </div>
                        <div id="soal"></div>
                        <div class="row">
                            <div class="col-md-12">
                            @if (count($ceknilai)==0)
                                <button class="btn btn-md btn-success pull-right" onclick="endtest('{{ucwords($jenis)}}','{{$idfasil}}')">End Test</button>
                            @endif
                            </div>
                        </div>
                    </div>

                </div><!-- // row -->
            </div>

@endsection
@section('footscript')
    <script>
        $(document).ready(function(){
            loadsoal('{{$jenis}}','{{$idfasil}}','{{$soal[0]->id}}','1');
            
            var pesan='{!! Session::get("status") !!}';
            if(pesan!='')
            {
                $('#content-body-ok').html('<h2 style="color:black">'+pesan+'</h2>');
                $('#modal_ok').modal('show');
            }
        });
        function loadsoal(jenis,idfasil,idsoal,no)
        {
            $('#soal').load(APP_URL+'/soal-detail/'+jenis+'/'+idfasil+'/'+idsoal+'/'+no);
        }
        function jawabsoal(jenis,idsoal,no,idjawaban,idfasil)
        {
            
            $.ajax({
                url : APP_URL + '/jawab-soal/'+idsoal+'/'+idjawaban+'/'+idfasil+'/'+jenis,
                dataType:'json',
                success:function(a){
                    if(a==1)
                        $('#soal_'+no).css({'background-color':'red','border':'1px solid brown'});
                }
            });
            //alert(no);
        }
        function endtest(jenis,idfasil)
        {
            $('#content-body').html('<h1 style="color:#000">Anda yakin ingin Mengakhiri '+jenis+' Test ini ?</h1>');
            $('#modal_default').modal('show');
            $('button#ok').html('<i class="fa fa-check"></i>&nbsp;Ya');
            $('button#ok').one('click',function(){
                
                location.href=APP_URL+'/end-test/'+jenis+'/'+idfasil;
                
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
        font-size:12px !important;
        font-weight:400;
        color:#000;
    }
    span.label
    {
        font-size:11px !important;
    }
</style>