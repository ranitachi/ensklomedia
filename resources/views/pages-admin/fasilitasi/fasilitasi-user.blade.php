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
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i>  Kegiatan Fasilitasi</h1>
                            </div>
                           
                        </div>
                        <div id="form">
                            <table class="table table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width:70px;">Aksi</th>
                                    </tr>             
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                @foreach ($menu as $item)
                                @php
                                    $st_menu=1;
                                    if($item->title=='Form Biodata')
                                    {
                                        if(count($pes_fas)!=0)
                                        {
                                            if($pes_fas->flag==1)
                                            {
                                                $status='<span class="label label-success">Sudah Di Verifikasi</span>';
                                            }
                                            else {
                                                $status='<span class="label label-primary">Belum Di Verifikasi</span>';
                                            }
                                        }
                                        else {
                                            $status='<span class="label label-warning">Belum Terdaftar</span>';
                                        }
                                    }
                                    else if(strpos($item->title,'Test')!==false)
                                    {
                                        if(count($pes_fas)!=0)
                                        {
                                            if($pes_fas->flag==1)
                                            {
                                                $status='<span class="label label-success">Sudah Mengikuti Test</span>';
                                            }
                                            else {
                                                $status='<span class="label label-primary">Belum Mengikuti Tes</span>';
                                            }
                                        }
                                        else {
                                            $status='<span class="label label-warning">Belum Mengikuti Test</span>';
                                        }
                                    }
                                    else {
                                        $status='<span class="label label-warning">Belum Terdaftar</span>';
                                    }

                                    if(isset($menu_pivot[$item->id]))
                                    {
                                        if($menu_pivot[$item->id]->flag!=1)
                                        {
                                            $status='<span class="label label-warning">Menu Belum Diaktifkan Oleh PIC</span>';
                                            $st_menu=0;
                                        }
                                    }
                                    else
                                    {
                                        $st_menu=0;
                                        $status='<span class="label label-warning">Menu Belum Diaktifkan Oleh PIC</span>';
                                    }
                                @endphp
                                    <tr>
                                        <td class="text-center">{{$no}}</td>
                                        <td class="text-left">{{$item->title}}</td>
                                        <td class="text-center">{!! $status !!}</td>
                                        <td class="text-center" style="width:70px;">
                                            @if ($st_menu!=0)
                                                
                                                <a href="{{url($item->route.'/'.$iduser.'/'.$idfasil)}}" class="btn btn-xs btn-primary">
                                                    <i class="fa fa-toggle-right"></i> Klik
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
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
            //loaddata(-1);
            loadform(-1);
            
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