@extends('layouts.master')
@section('title')
    <title>Beranda - Ensiklomedia</title>
    <link rel="stylesheet" href="{{ asset('css/dropzone.css')}}" />
    
@endsection

@section('content')
    <div id="all-output" class="col-md-10">
        <div id="upload">
                <div class="row">
                    <!-- upload -->

                    <div class="col-md-12">
                        <h1 class="page-title"><span>Upload</span> Video</h1>
                    </div>
                    <div class="col-md-6">
						<form>
                        	<div class="row">
                            	<div class="col-md-12">
                                	<label>Judul Video</label>
                                    <input type="text" class="form-control" placeholder="Judul Video">
                                </div>
                                <div class="col-md-12">
                                    <label>Tag Video</label>
                                    <input type="text" class="form-control" placeholder="Tag Video">
                                </div>
                            	<div class="col-md-12">
                                	<label>Kategori</label>
                                    <select name="category" class="form-control" data-placeholder="Kategori">
                                        <option value=""></option>
                                        @foreach ($cat as $k => $v)
                                            <option value="{{$v->id}}">{{$v->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            	<div class="col-md-12">
                                	<label>Deskripsi</label>
                                    <textarea class="form-control" rows="4"  placeholder="Deskripsi"></textarea>
                                </div>
                            	<div class="col-md-12">
                                	<label>Pilih Gambar Cover</label>
                                    <input id="featured_image" type="file" class="file">
                                </div>
                            	<div class="col-md-6">
                                    <button type="button" id="contact_submit" class="btn btn-dm">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- // col-md-8 -->
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Video upload</label>
                            <form action="/" method="post" class="dropzone" id="my-awesome-dropzone"></form>
                        </div>
                    </div>

                   
                </div><!-- // row -->
            </div><!-- // upload -->
    </div>
@endsection
@section('footscript')
<script src="{{asset('js/dropzone.js')}}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function(){
        $(".dropzone").dropzone({
            maxFiles:1,
            addRemoveLinks: true,
            dictDefaultMessage: "<i class='fa fa-upload' style='font-size:60px;color:red;'></i><br>Silahkan Pilih Video untuk di Upload (Klik)",
            dictRemoveFile:'Hapus File',
            success: function(file) {
                var name = file.name; 
                //alert(name)
            },
            removedfile: function(file) {
                var name = file.name; 
                
                $.ajax({
                    type: 'POST',
                    url: 'upload.php',
                    data: {name: name,request: 2},
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
@endsection