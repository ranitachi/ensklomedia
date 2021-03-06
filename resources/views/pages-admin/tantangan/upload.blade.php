@extends('layouts.master')
@section('title')
    <title>Upload Tantangan - Ensiklomedia</title>
    <link rel="stylesheet" href="{{ asset('css/dropzone.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css')}}" />
    
@endsection

@section('content')
        <div id="upload">
                <div class="row">
                    <!-- upload -->
                    <div class="col-md-12">
                        @if (session('status'))
                        <div class="alert alert-info alert-dismissable top-50">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Info!</strong> <br>
                            <h2>{{ session('status') }}</h2>
                        </div>
                        @endif
                        <h1 class="page-title"><span>Upload</span> Video Tantangan : {{$saung->video->title}}</h1>
                    </div>
                    <!-- // col-md-8 -->
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Video upload</label>
                            <form action="{{URL::to('/videosave')}}" method="post" class="dropzone" id="my-awesome-dropzone">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id" value="{{$id}}">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <form id="upload-video" action="{{URL::to('upload-tantangan/'.$idtantangan.'/'.$idsaung)}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Judul Video</label>
                                        <input type="text" id="title" class="form-control" placeholder="Judul Video" name="title" value="{{$tantangan->topik}}">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label>Kategori</label>
                                        <select name="category_id" id="category_id" class="form-control" data-placeholder="Kategori">
                                            <option value=""></option>
                                            @foreach ($cat as $k => $v)
                                                @if ($v->id==$tantangan->video->category_id)
                                                    <option value="{{$v->id}}" selected="selected">{{$v->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Mata Pelajaran</label>
                                        <select name="mapel_id" id="mapel_id" class="form-control" data-placeholder="Kategori">
                                            <option value="-1"></option>
                                            @if (isset($pm[$tantangan->video->category_id]))
                                                @foreach ($pm[$tantangan->video->category_id] as $k => $v)
                                                    @if ($v->id==$tantangan->video->id_mapel)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->title}}</option>
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->title}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                           
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Tag Video</label>
                                        <input type="text" class="form-control" name="tags" placeholder="Tag Video" id="tags" data-role="tagsinput">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control" rows="4"  id="desc" placeholder="Deskripsi" name="description"></textarea>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <label>Pilih Gambar Cover</label>
                                        <input id="featured_image" type="file" class="file" name="cover">
                                    </div> --}}
                                    <div class="col-md-6">&nbsp;</div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" id="id" value="{{$id}}">
                                        <button type="button" id="contact_submit" class="btn btn-dm pull-right">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        
                    </div>
                   
                </div><!-- // row -->
            </div><!-- // upload -->
   
@endsection
@section('footscript')
<script src="{{asset('js/dropzone.js')}}"></script>
<script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function(){
        $('#contact_submit').hide();
        $('#contact_submit').click(function(){
            var title=$('#title').val();
            var category_id=$('#category_id').val();
            var tags=$('#tags').val();
            var desc=$('#desc').val();
            if(title=='')
            {
                alert('Judul Video Harus Diisi');
            }
            else if(category_id=='')
            {
                alert('Kategori Video Belum Dipilih');
            }
            else if(tags=='')
            {
                alert('Tags Video Harus Diisi');
            }
            else
            {
                $('#upload-video').submit();
            }
            //var tags=$('input#tags').val();
            //alert(tags);
        });
        $(".dropzone").dropzone({
            maxFiles:1,
            //acceptedFiles: ".mp4,.mkv,.avi",
            acceptedFiles: "video/*",
            maxFilesize: 500,
            addRemoveLinks: true,
            timeout: 0,
            dictDefaultMessage: "<i class='fa fa-upload' style='font-size:60px;color:red;'></i><br>Silahkan Pilih Video untuk di Upload (Klik)",
            dictRemoveFile:'Hapus File',
            success: function(file) {
                $('#contact_submit').show();
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