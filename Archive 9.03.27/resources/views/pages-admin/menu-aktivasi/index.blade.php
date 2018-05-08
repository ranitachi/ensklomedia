@extends('layouts.master-admin')

@section('title')
    <title>Aktivasi Menu - Ensiklomedia</title>
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Aktivasi Menu</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div class="row" id="data">
                        @include('pages-admin.menu-aktivasi.data')
                        </div><!-- // row -->


                        <!-- Loading More Videos -->
                        <div id="loading-more">
                            {{--  <i class="fa fa-refresh faa-spin animated"></i> <span>Loading more</span>  --}}
                        </div>
                        <!-- // Loading More Videos -->

                    </div>
                    {{-- <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="new-video-title"><i class="fa fa-files-o"></i> Informasi Kegiatan</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div id="form"></div>
                    </div> --}}

                </div><!-- // row -->
            </div>

		
@endsection
@section('footscript')
    <script>
        $(document).ready(function(){
            //loaddata(-1);
            loadform(-1);
            var pesan='{!! Session::get("status") !!}';
            if(pesan!='')
            {
                $('#content-body-ok').html('<h2 style="color:black">'+pesan+'</h2>');
                $('#modal_ok').modal('show');
            }
        });
        var currentLocation = window.location;
        function changestatus(idfasil,idmenu,st)
        {
            var currentLocation = window.location;
            $.ajax({
                    url: APP_URL+'/menu-aktivasi-change-status/'+idfasil+'/'+idmenu+'/'+st
                }).done(function(data){
                    var txt = "Status Aktivasi Menu Berhasil Di Edit";
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
                    var txt = " Status Aktivasi Menu Gagal Di Edit";
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
        function hapuspeserta(id)
        {
            var tx="<h3 style='color:black !important;'>Apakah Yakin ingin Menghapus Data Peserta ini ?</h3>";
            $('#content-body').html(tx);
            $('#modal_default').modal('show');
             $('button#ok').one('click',function(){
                $.ajax({
                    url: APP_URL+'/hapus-peserta-fasilitasi/'+id,
                    dataType: 'json',
                    cache: false,
                }).done(function(data){
                    var txt = "<h3 style='color:black !important;'>Data Peserta Fasilitasi Berhasil Di Hapus</h3>";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                    var currentLocation = window.location;
                    getPosts(currentLocation);
                }).fail(function(){
                    var txt = " <h3 style='color:black !important;'>Data Peserta Fasilitasi Gagal Di Hapus</h3>";
                    $('#modal_default').modal('hide');
                    $('#content-body-ok').html(txt);
                    $('#modal_ok').modal('show');
                });
            });
        }
        function aktifkanpeserta(id,st)
        {
            var currentLocation = window.location;
            
            $.ajax({
                    url: APP_URL+'/aktivasi-peserta-change-status/'+id+'/'+st
                }).done(function(data){
                    var txt = "Status Peserta Fasilitasi Menu Berhasil Di Edit";
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
                    var txt = " Status Peserta Fasilitasi Menu Gagal Di Edit";
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
                    url: APP_URL+'/menu-aktivasi/'+id,
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
                    var t_url = APP_URL+'/menu-aktivasi';
                    var t_method = 'POST';
                }
                else
                {
                    var t_url = APP_URL+'/menu-aktivasi/'+id;
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
                    loaddata(-1);
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
            $('#data').load(APP_URL+'/menu-aktivasi-data/'+id,function(){

            });
        }
        function loadform(id)
        {
            $('#form').load(APP_URL+'/menu-aktivasi-form/'+id,function(){
                
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
                    alert('Halaman Data Menu Aktivasi Tidak Dapat Di Tampilkan');
            });
        }
        function addpeserta(idfasilitas)
        {
            $('#id_fasilitasi').val(idfasilitas);
            $('#modalConfirm').modal('show');
            $('#ok').click(function(){
                var peserta_id=$('#id_peserta').val();
                if(peserta_id=='')
                {
                    var txt = "Peserta Fasilitasi Belum Dipilih";
                        $.notify(txt,{
                            elementPosition: 'bottom right',
                            globalPosition: 'buttom right',
                            className : 'error',
                            z_index : 1500000
                        });
                }
                else
                {
                    $('#add-peserta').submit();
                }
            });
        }
    </script>
@endsection
<div id="modalConfirm" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Information</h5>
                </div>

                <form action="{{ url('add-peserta-to-fasilitasi/simpan') }}" method="post" id="add-peserta">
                    {{ csrf_field() }}
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="">Silahkan pilih Peserta di bawah ini:</label>
                                <input type="hidden" name="id_fasilitasi" id="id_fasilitasi">
                                <select name="id_peserta[]" id="id_peserta" class="form-control chosen-select" multiple="multiple">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($peserta as $item)
                                        <option value="{{ $item->id }}">{{ (isset($prf[$item->id]) ? $prf[$item->id]->name : '') }} [{{ $item->email }}]</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
                        <button type="button" class="btn btn-success" id="ok"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
<style>
    .table td,
    .table th
    {
        font-size:13px !important;
    }
    .chosen-container
    {
        width:100% !important;
    }
</style>