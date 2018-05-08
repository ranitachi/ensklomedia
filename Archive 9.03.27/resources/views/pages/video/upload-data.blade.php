

@extends('layouts.master')
@section('title')
    <title>Beranda - Ensiklomedia</title>
    <link rel="stylesheet" href="{{ asset('css/dropzone.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css')}}" />
    
@endsection

@section('content')
        <div id="upload">
                <div class="row">
                    <!-- upload -->
                    <div class="col-lg-1-dash col-md-1-dash col-sm-1-dash">&nbsp;</div>
                        <div class="col-lg-10-dash col-md-10-dash col-sm-10-dash">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    @if (session('status'))
                                    <div class="alert alert-info alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong>Info!</strong> <br>
                                        <h2>{{ session('status') }}</h2>
                                    </div>
                                    @endif
                                    <h1 class="page-title col-lg-12"><span data-letters="UV">Upload</span> Video</h1>
                                </div>
                                
                                <div class="col-md-8">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <form action="{{URL::to('/videosave')}}" method="post" class="dropzone" id="my-awesome-dropzone">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" id="id" value="{{$id}}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                            <img src={{asset('assets/demo_img/blog-1.png')}} class="col-md-12 col-lg-12">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-1-dash col-md-1-dash col-sm-1-dash">&nbsp;</div>
                </div><!-- // row -->
            </div><!-- // upload -->
   
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
            dictDefaultMessage: "<i class='fa fa-upload' style='font-size:100px;color:red;'></i><br>Silahkan Pilih Video untuk di Upload (Klik)",
            dictRemoveFile:'Hapus File',
            success: function(file) {
                //alert(file);
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