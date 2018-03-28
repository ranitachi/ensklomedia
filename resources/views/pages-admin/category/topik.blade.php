@extends('layouts.master-admin')

@section('title')
    <title>Topik Materi - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Kategori</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div class="row" id="data">

                        </div><!-- // row -->


                        <!-- Loading More Videos -->
                        <div id="loading-more">
                            {{--  <i class="fa fa-refresh faa-spin animated"></i> <span>Loading more</span>  --}}
                        </div>
                        <!-- // Loading More Videos -->

                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Form Topik Materi</h1>
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
            loaddata(-1);
            
        });
        function hapus(id)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Menghapus Data ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/category/'+id,
                    type : 'DELETE',
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {"_token": "{{ csrf_token() }}"}
                }).done(function(data){
                    var txt = "Data Category Berhasil Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    loaddata(-1);
                }).fail(function(){
                    var txt = " Data Category Gagal Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                });
            });
        }
        function hapustopikmateri(idkat,idmapel,id)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Menghapus Topik Materi ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/topik-materi-delete/'+idkat+'/'+idmapel+'/'+id,
                    dataType: 'json',
                    cache: false
                }).done(function(data){
                    var txt = "Data Topik Materi Berhasil Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    loaddata(-1);
                    $('#form').hide();
                }).fail(function(){
                    var txt = " Data Topik Materi Gagal Di Hapus";
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

                    var t_url = APP_URL+'/topik-materi-proses/'+id;
                    var t_method = 'POST';

                $.ajax({
                    url : t_url,
                    type : t_method,
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: $('#form-category').serialize()
                }).done(function(data){
                    loaddata(-1);
                    //loadform(-1);
                    $('#form').hide();
                    $('#modal_default').modal('hide');
                    if(id==-1)
                    {
                         var ps="<h3 style='color:black !important;'>Data Kategori Berhasil Disimpan</h3>";
                    }
                    else
                    {
                        var ps="<h3 style='color:black !important;'>Data Kategori Berhasil Di Edit</h3>";
                    }
                    $('#content-body-ok').html(ps);
                    $('#modal_ok').modal('show');
                }).fail(function(data){
                    $('#modal_default').modal('hide');
                    var ps="<h3 style='color:black !important;'>Data Kategori Gagal Disimpan</h3>";
                    $('#content-body-ok').html(ps);
                    $('#modal_ok').modal('show');
                });
            });
        }
        function loaddata(id)
        {
            $('#data').load(APP_URL+'/topik-materi-data',function(){

            });
        }
        
        function topikmateri(idcat,idmapel,id)
        {
            $('#form').show();
            $('#form').load(APP_URL+'/topik-materi-form/'+idcat+'/'+idmapel+'/'+id);
        }
    </script>
@endsection