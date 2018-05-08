@extends('layouts.master-admin')

@section('title')
    <title>Verifikasi Video - Ensiklomedia</title>
     

@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-video-camera"></i> Data Verifikasi Video</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                &nbsp;
                            </div>
                            <div class="col-md-4">
                                <div class="pull-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="user-search" placeholder="Cari Judul Video">
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
                                    @include('pages-admin.setting.mapping-reviewer.verifikasi-video')
                                </div><!-- // row -->
                            </div>
                        </div>


                        <!-- Loading More Videos -->
                        <div id="loading-more">
                            {{--  <i class="fa fa-refresh faa-spin animated"></i> <span>Loading more</span>  --}}
                        </div>
                        <!-- // Loading More Videos -->

                    </div>
                    
                </div><!-- // row -->
            </div>

		
@endsection
@section('footscript')
    
    <script>
        //videojs(document.getElementById('example_video_1'), {}, function() {
            // This is functionally the same as the previous example.
        //});
        
        
    
        $(document).ready(function(){
           $('#user-search').on('keyup',function(){
            var value=$(this).val();
                $.ajax({
                    type : 'get',
                    url : APP_URL+'/search-video-verifikasi',
                    data:{'search':value},
                    success:function(data){
                        $('div#data').html(data);
                    }
                });
            })
        });
        function hapus(id)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Menghapus Data ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/verifikasi-video-delete/'+id,
                    type : 'DELETE',
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {"_token": "{{ csrf_token() }}"}
                }).done(function(data){
                    var txt = "Data Video Berhasil Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    //loaddata(-1);
                    $('#tombol-ok').click(function(){
                        location.href=APP_URL+'/verifikasi-data-video';
                    })
                }).fail(function(){
                    var txt = " Data Verifikasi Video Gagal Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                });
            });
        }

        $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                //$('#load a').css('color', '#dfecf6');
                //$('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');
                var url = $(this).attr('href');
                getPosts(url);
                window.history.pushState("", "", url);
        });
        function lihat(id)
        {
            $('p#content-body-video').load(APP_URL+'/modal-video/'+id,function(){
                var video = videojs('example_video_1');
                $('#tombol-video').click(function(){
                    video.pause();
                });
            });
            $('#modal_video').modal('show');
        }
        function getPosts(page) {
            $.ajax({
                    url : page
                }).done(function (data) {
                    $('div#data').html(data);
                }).fail(function () {
                    alert('Halaman Data Reviewer Tidak Dapat Di Tampilkan');
            });
        }
        function verifikasi(id,status)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Verifikasi Data ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/ubah-verifikasi/'+id+'/'+status,
                    dataType: 'json',
                    cache: false
                }).done(function(data){
                    if(status==0)
                        var txt = "<h3>Data Video Sudah Di Batalkan</h3>";
                    else if(status==1)
                        var txt = "<h3>Data Video Berhasil Di Verifikasi</h3>";

                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    //loaddata(-1);
                    $('#tombol-ok').click(function(){
                        location.href=APP_URL+'/video-verifikasi';
                    })
                }).fail(function(){
                    var txt = " <h3>Verifikasi Video Gagal</h3>";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                });
            });
        }
    </script>
@endsection
<style>
        .share-in {
            margin-top: 0px !important;
        }

        .custom-size {
            height: 150px;
            width: 100%;
        }

        .thumb {
            height: 150px;
            background: url("{{ asset('assets/img/no-image-02.png') }}");
            background-size: 95% 100%;
            background-position: center;
        }

        .reply {
            cursor: pointer;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        
        .fade-enter, .fade-leave-to {
            opacity: 0;
        }

        div#example_video_1
        {
            width:100% !important;
        }
    </style>