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
                                            <option value="{{$v->id}}">{{$v->category}}</option>
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
                   
                </div><!-- // row -->
            </div><!-- // upload -->
    </div>
@endsection
@section('footscript')
<script src="{{asset('js/dropzone.js')}}"></script>
<script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
<script>
    $(document).ready(function(){
       
    });
</script>

@endsection