@extends('layouts.master-admin')

@section('title')
    <title>Kegiatan Fasilitasi - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-7">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <strong>Sukses!</strong> 
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                <strong>Error!</strong> 
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Kegiatan Fasilitasi</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div class="row" id="data">
                            @include('pages-admin.fasilitasi.data')
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
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Form Kegiatan Fasilitasi</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div id="form">
                            <center>
                                <img src="{{asset('assets/img/loader.gif')}}" style="width:200px;">
                            </center>
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
        function changestatus(id,st)
        {
            var currentLocation = window.location;
            $.ajax({
                    url: APP_URL+'/fasilitasi-change-status/'+id+'/'+st,
                    dataType: 'json',
                    cache: false,
                }).done(function(data){
                    var txt = "Status Kegiatan Fasilitasi Berhasil Di Edit";
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
                    var txt = " Status Kegiatan Fasilitasi Gagal Di Edit";
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
                    url: APP_URL+'/fasilitasi/'+id,
                    type : 'DELETE',
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {"_token": "{{ csrf_token() }}"}
                }).done(function(data){
                    var txt = "Data Fasilitasi Berhasil Di Hapus";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    getPosts(window.location.href);
                }).fail(function(){
                    var txt = " Data Fasilitasi Gagal Di Hapus";
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
                    var t_url = APP_URL+'/fasilitasi';
                    var t_method = 'POST';
                }
                else
                {
                    var t_url = APP_URL+'/fasilitasi/'+id;
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
                    getPosts(window.location.href);
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
            $('#data').load(APP_URL+'/fasilitasi-data/'+id,function(){

            });
        }
        function loadform(id)
        {
            $('#form').load(APP_URL+'/fasilitasi-form/'+id,function(){
                $(".chosen-select").chosen();
                $('input#tanggal').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear',
                        format:'DD/MM/YYYY'
                    }
                });

                $('input#tanggal').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                });

                $('input#tanggal').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });
        }
        function pilihnarsum(id)
        {
            $('#narsumidfasilitasi').val(id);
            $('#modalNarsum').modal('show');
            
        }
        function pilihpic(id)
        {
            $('#idfasilitasi').val(id);
            $('#modalConfirm').modal('show');
        }
        function hapuspic(idpic)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Menghapus Data ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/hapus-pic-fasilitasi/'+idpic
                }).done(function(data){
                    var txt = "Data PIC Fasilitasi Berhasil Di Hapus";
                    $.notify(txt,{
                        elementPosition: 'bottom right',
                        globalPosition: 'buttom right',
                        className : 'info'
                    });
                    $('#modal_default').modal('hide');
                    getPosts(window.location.href);
                    loadform(-1);
                }).fail(function(){
                    var txt = " Data PIC Fasilitasi Gagal Di Hapus";
                    $.notify(txt, {
                        elementPosition: 'bottom right',
                        className : 'error',
                        globalPosition: 'buttom right',
                    });
                });
            });
        }
        function hapusnarsum(idnarsum,index)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Menghapus Data ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/hapus-narsum-fasilitasi/'+idnarsum+'/'+index
                }).done(function(data){
                    var txt = "Data Narasumber/Reviewer Fasilitasi Berhasil Di Hapus";
                    $.notify(txt,{
                        elementPosition: 'bottom right',
                        globalPosition: 'buttom right',
                        className : 'info'
                    });
                    $('#modal_default').modal('hide');
                    getPosts(window.location.href);
                    loadform(-1);
                }).fail(function(){
                    var txt = " Data Narasumber/Reviewer Fasilitasi Gagal Di Hapus";
                    $.notify(txt, {
                        elementPosition: 'bottom right',
                        className : 'error',
                        globalPosition: 'buttom right',
                    });
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
        function getPosts(page) {
            $.ajax({
                    url : page
                }).done(function (data) {
                    $('div#data').html(data);
                }).fail(function () {
                    alert('Halaman Data Kegiatan Fasilitasi Tidak Dapat Di Tampilkan');
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
        font-size:12px !important;
        font-weight:200;
    }
</style>