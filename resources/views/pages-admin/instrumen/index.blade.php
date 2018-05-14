@extends('layouts.master-admin')

@section('title')
    <title>Instrumen Penilaian - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Instrumen Penilaian</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div class="row" id="data">
                        @include('pages-admin.instrumen.data')
                        </div><!-- // row -->


                        <!-- Loading More Videos -->
                        <div id="loading-more">
                            {{--  <i class="fa fa-refresh faa-spin animated"></i> <span>Loading more</span>  --}}
                        </div>
                        <!-- // Loading More Videos -->

                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Form Instrumen</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div id="form"></div>
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
        function changestatus(id,st)
        {
            var currentLocation = window.location;
            $.ajax({
                    url: APP_URL+'/instrumen-change-status/'+id+'/'+st,
                    dataType: 'json',
                    cache: false,
                }).done(function(data){
                    var txt = "Status Instrumen Berhasil Di Edit";
                    // $('#modal_default').modal('hide');
                    // $('#content-body-ok').html(txt);
                    // $('#modal_ok').modal('show');
                    $.notify(txt,{
                        elementPosition: 'bottom right',
                        globalPosition: 'buttom right',
                        className : 'info'
                    });
                    getPosts(currentLocation);
                }).fail(function(){
                    var txt = " Status Instrumen Gagal Di Edit";
                    // $('#modal_default').modal('hide');
                    // $('#content-body-ok').html(txt);
                    // $('#modal_ok').modal('show');
                    $.notify(txt, {
                        elementPosition: 'bottom right',
                        className : 'error',
                        globalPosition: 'buttom right',
                    });
            });
        }
        function hapus(id)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Menghapus Data ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/instrumen/'+id,
                    type : 'DELETE',
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {"_token": "{{ csrf_token() }}"}
                }).done(function(data){
                    var txt = "Data Instrumen Berhasil Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    loaddata(-1);
                }).fail(function(){
                    var txt = " Data Instrumen Gagal Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                });
            });
        }

        function simpan(id)
        {
            var tx="<h3 style='color:black !important;'>Apakah Data Yang Diinput Sudah Benar?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
            //$('button#ok').click(function(){
            $('button#ok').one('click',function(){
                if(id==-1)
                {
                    var t_url = APP_URL+'/instrumen';
                    var t_method = 'POST';
                }
                else
                {
                    var t_url = APP_URL+'/instrumen/'+id;
                    var t_method = 'PATCH';
                }
                //$('#form-category').submit();
                $.ajax({
                    url : t_url,
                    type : t_method,
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: $('#form-category').serialize()
                }).done(function(data){
                   
                    loadform(-1);
                    $('#modal_default').modal('hide');
                    if(id==-1)
                    {
                         var ps="<h3 style='color:black !important;'>Data Instrumen Berhasil Disimpan</h3>";
                    }
                    else
                    {
                        var ps="<h3 style='color:black !important;'>Data Instrumen Berhasil Di Edit</h3>";
                    }
                    $('#content-body-ok').html(ps);
                    $('#modal_ok').modal('show');
                    var currentLocation = window.location;
                    getPosts(currentLocation);

                }).fail(function(data){
                    $('#modal_default').modal('hide');
                    var ps="<h3 style='color:black !important;'>Data Instrumen Gagal Disimpan</h3>";
                    $('#content-body-ok').html(ps);
                    $('#modal_ok').modal('show');
                });
            });
        }
        function baru()
        {
            loadform(-1);
        }
        
        function loaddata(id)
        {
            $('#data').load(APP_URL+'/instrumen-data/'+id,function(){

            });
        }
        function loadform(id)
        {
            $('#form').load(APP_URL+'/instrumen-form/'+id,function(){
                
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
        function getPosts(page) {
            $.ajax({
                    url : page
                }).done(function (data) {
                    $('div#data').html(data);
                }).fail(function () {
                    alert('Halaman Data Instrumen Tidak Dapat Di Tampilkan');
            });
        }
    </script>
@endsection