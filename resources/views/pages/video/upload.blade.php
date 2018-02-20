@extends('layouts.master')
@section('title')
    <title>Beranda - Ensiklomedia</title>
    <link rel="stylesheet" href="{{ asset('css/dropzone.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css')}}" />
    
@endsection

@section('content')
    <div id="all-output" class="col-md-10">
        <div id="upload">
                <div class="row">
                    <!-- upload -->
                    <div class="col-md-12">
                        @if (session('status'))
                        <div class="alert alert-info alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Info!</strong> <br>
                            <h2>{{ session('status') }}</h2>
                        </div>
                        @endif
                        <h1 class="page-title"><span>Upload</span> Video</h1>
                    </div>
                    <div class="col-md-6">
                        <form id="upload-video" action="{{ URL::to('upload') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<div class="row">
                            	<div class="col-md-12">
                                	<label>Judul Video</label>
                                    <input type="text" class="form-control" placeholder="Judul Video" name="title">
                                </div>
                                <div class="col-md-12">
                                    <label>Tag Video</label>
                                    <input type="text" class="form-control" name="tags" placeholder="Tag Video" id="tags" data-role="tagsinput">
                                </div>
                            	<div class="col-md-12">
                                	<label>Kategori</label>
                                    <select name="category_id" class="form-control" data-placeholder="Kategori">
                                        <option value=""></option>
                                        @foreach ($cat as $k => $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            	<div class="col-md-12">
                                	<label>Deskripsi</label>
                                    <textarea class="form-control" rows="4"  placeholder="Deskripsi" name="description"></textarea>
                                </div>
                            	<div class="col-md-12">
                                	<label>Pilih Gambar Cover</label>
                                    <input id="featured_image" type="file" class="file" name="cover">
                                </div>
                            	<div class="col-md-6">
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                    <button type="button" id="contact_submit" class="btn btn-dm">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- // col-md-8 -->
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Video upload</label>
                            <form action="{{URL::to('/videosave')}}" method="post" class="dropzone" id="my-awesome-dropzone">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id" value="{{$id}}">
                            </form>
                        </div>
                    </div>

                   
                </div><!-- // row -->
            </div><!-- // upload -->
    </div>
@endsection
@section('footscript')
<script src="{{asset('js/dropzone.js')}}"></script>
<script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function(){
        
        $('#contact_submit').click(function(){
            $('#upload-video').submit();
            //var tags=$('input#tags').val();
            //alert(tags);
        });
        $(".dropzone").dropzone({
            maxFiles:1,
            //acceptedFiles: ".mp4,.mkv,.avi",
            acceptedFiles: "video/*",
            addRemoveLinks: true,
            dictDefaultMessage: "<i class='fa fa-upload' style='font-size:60px;color:red;'></i><br>Silahkan Pilih Video untuk di Upload (Klik)",
            dictRemoveFile:'Hapus File',
            success: function(file) {
                /*var name = file.name; 
                $('#file_name').val(name);
                $.ajax({
                    type: 'POST',
                    url: APP_URL+'/videosave',
                    data: {name: name,id:'{{$id}}'},
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    sucess: function(data){
                        console.log('success: ' + data);        
                    }
                });*/
            },
            removedfile: function(file) {
                var name = file.name; 
                
                $.ajax({
                    type: 'POST',
                    url: APP_URL+'/removefile/{{$id}}',
                    data: {name: name},
                    sucess: function(data){
                        console.log('success: ' + data);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });
    });
</script>
<style>
    .bootstrap-tagsinput
    {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #f6f3f3;
        background-image: none;
        border: 1px solid #f6f3f3;
        border-radius: 0px;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }

</style>
@endsection