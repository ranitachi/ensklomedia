@extends('layouts.master-admin')

@section('title')
    <title>Kegiatan Fasilitasi - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
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


                        <!-- Loading More Videos -->
                        <div id="loading-more">
                            {{--  <i class="fa fa-refresh faa-spin animated"></i> <span>Loading more</span>  --}}
                        </div>
                        <!-- // Loading More Videos -->

                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i>  Peserta Fasilitasi</h1>
                            </div>
                           
                        </div>
                        <div id="form">
                            <table class="table table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Peserta</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center" style="width:70px;">Cetak Sertifikat</th>
                                    </tr>             
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($pes as $k=>$item)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td class="text-left">{{$item->user->profile->name}}</td>
                                            <td class="text-center">{{$item->user->email}}</td>
                                            <td class="text-center">
                                                <a href="{{url('cetak/'.$item->user_id.'/'.$item->fasilitasi_id)}}" class="btn btn-xs btn-success" target="_blank">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div><!-- // row -->
            </div>

		
@endsection
@section('footscript')
    <script>
        $(document).ready(function(){
           
        });
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
        font-weight:200;
    }
    span.label
    {
        font-size:11px !important;
    }
</style>