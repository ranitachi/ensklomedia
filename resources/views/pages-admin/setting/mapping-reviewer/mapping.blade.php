@extends('layouts.master-admin')

@section('title')
    <title>Mapping Video - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-video-camera"></i> Data Mapping Video</h1>
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
                                    @include('pages-admin.setting.mapping-reviewer.video')
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
    <script type="text/javascript">
        $(document).ready(function(){
           $('#user-search').on('keyup',function(){
            var value=$(this).val();
                $.ajax({
                    type : 'get',
                    url : APP_URL+'/search-video',
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
                    url: APP_URL+'/mapping-video-delete/'+id,
                    type : 'DELETE',
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {"_token": "{{ csrf_token() }}"}
                }).done(function(data){
                    var txt = "Data Reviewer Berhasil Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    //loaddata(-1);
                    $('#tombol-ok').click(function(){
                        location.href=APP_URL+'/mapping-reviewer-video';
                    })
                }).fail(function(){
                    var txt = " Data Mapping Video Gagal Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                });
            });
        }

     
        function mapping(id)
        {
            $('#modal-mapping').modal('show');
        }
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
                    alert('Halaman Data Reviewer Tidak Dapat Di Tampilkan');
            });
        }
    </script>
@endsection