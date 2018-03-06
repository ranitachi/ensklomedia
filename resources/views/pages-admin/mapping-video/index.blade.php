@extends('layouts.master-admin')

@section('title')
    <title>Mapping Admin - Ensiklomedia</title>
    <style>
        th
        {
            text-align:center;
            background:#eee;
            border:1px solid #111;
        }
    </style>
@endsection

@section('content')

    <div id="modalConfirm" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Information</h5>
                </div>

                <form action="{{ route('mapping-to-reviewer.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="">Silahkan pilih reviewer di bawah ini:</label>
                                <input type="hidden" id="vid" name="video_id" value="">
                                <select name="id_reviewer" id="" class="form-control chosen-select">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($reviewers as $item)
                                        <option value="{{ $item->id }}">{{ $item->profile->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-success" id="ok"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>

    <div id="category" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        <strong>Sukses!</strong> 
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6" >
                        <h1 class="new-video-title"><i class="fa fa-users"></i> Mapping Video To Reviewer</h1>
                    </div>
                    <div class="col-md-6" style="padding-top:20px;">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        {{--  <a href="{{url('mapping-admin')}}/-1" class="btn btn-danger">
                            <i class="fa fa-plus-square"></i> Tambah Admin
                        </a>  --}}
                    </div>
                    <div class="col-md-4">
                        <div class="pull-right">
                            <div class="input-group">
                                <input type="text" class="form-control" id="video-search" placeholder="Cari Judul Video">
                                <div class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12" >
                        
                        <div id="data">
                            @include('pages-admin.mapping-video.data')
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="pull-right">
                            {{ $videos->links() }}
                        </div>
                    </div>
                </div>
                <!-- Loading More Videos -->
                

            </div>
            
        </div><!-- // row -->
    </div>		
@endsection

@section('footscript')
    <script>
        $('.simpan').click(function(){
            var a = $(this).data('value')
            $('#vid').attr('value', a)
        })
        $('#video-search').on('keyup',function(){
            var value=$(this).val();
            $.ajax({
                    type : 'get',
                    url : APP_URL+'/search-video-reviewer',
                    data:{'search':value},
                    success:function(data){
                        $('div#data').html(data);
                    }
            });
        });

        $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                //$('#load a').css('color', '#dfecf6');
                //$('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');
                var url = $(this).attr('href');
                getPosts(url);
                window.history.pushState("", "", url);
        });
        function getPosts(page) {
            $.ajax({
                    url : page
                }).done(function (data) {
                    $('div#data').html(data);
                }).fail(function () {
                    alert('Halaman Data Video Tidak Dapat Di Tampilkan');
            });
        }
    </script>
@endsection
<style>
    .chosen-container
    {
        width:100% !important;
    }
    th,td
    {
        font-size:14px !important;
        font-weight:200;
    }
</style>