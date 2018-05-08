@extends('layouts.master-admin')

@section('title')
    <title>Profile - Ensiklomedia</title>
    <link rel="stylesheet" href="{{ asset('assets/css/datepicker.css')}}" />
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-users"></i> Data Profile</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-12">
                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        <strong>Sukses!</strong> 
                                        {!! Session::get('status') !!}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9" >
                                <div id="data">
                                    <form id="add-user" action="{{url('edit-profile-save/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                                        
                                        <div class="row" style="margin-top:10px;" id="upload">
                                            <div class="col-md-6" >
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" placeholder="Nama" name="profile__name" value="{{$id!=-1 ? (isset($profile->name) ? $profile->name: '') : ''}}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Tempat Lahir</label>
                                                            <input type="text" class="form-control" placeholder="Tempat Lahir" name="profile__place_of_birth" value="{{$id!=-1 ? (isset($profile->place_of_birth) ? $profile->place_of_birth: '') : ''}}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Tanggal Lahir</label>
                                                            <div class="form-group">
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input type="text" class="form-control" placeholder="Tanggal Lahir" name="profile__date_of_birth" value="{{$id!=-1 ? (isset($profile->date_of_birth) ? date('d/m/Y',strtotime($profile->date_of_birth)) : ''): ''}}">
                                                                    <span class="input-group-addon btn btn-primary">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control" name="users__email" placeholder="Email" id="email" value="{{$id!=-1 ? $user->email : ''}}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Password</label>
                                                            <input type="password" class="form-control" name="users__password" placeholder="password" id="password">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Jenis Kelamin</label>
                                                            <select name="profile__gender" class="form-control" data-placeholder="Jenis Kelamin">
                                                                <option value="0"></option>
                                                                @if ($id!=-1)
                                                                    @if (isset($profile->gender))
                                                                        
                                                                        <option value="L" {{$profile->gender=='L' ? 'selected="selected"' : ''}}>Laki-laki</option>
                                                                        <option value="P" {{$profile->gender=='P' ? 'selected="selected"' : ''}}>Perempuan</option>
                                                                    @else
                                                                        <option value="L">Laki-laki</option>
                                                                        <option value="P">Perempuan</option>
                                                                        
                                                                    @endif
                                                                @else
                                                                    <option value="L">Laki-laki</option>
                                                                    <option value="P">Perempuan</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <label>Alamat</label>
                                                            <textarea class="form-control" rows="4"  placeholder="Alamat" name="profile__address">{{$id!=-1 ? (isset($profile->address) ? $profile->address: '') : ''}}</textarea>
                                                        </div>
                                                        
                                                    
                                                    </div>
                                                </div><!-- // row -->
                                                <div class="col-md-6" >
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Profesi</label>
                                                            <input type="text" class="form-control" placeholder="Profesi" name="profile__profession" value="{{$id!=-1 ? (isset($profile->profession) ? $profile->profession: '') : ''}}">
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <label>Nomor Telp/HP</label>
                                                            <input type="text" class="form-control" placeholder="Nomor Telp/HP" name="profile__phone_number" value="{{$id!=-1 ? (isset($profile->phone_number) ? $profile->phone_number: '') : ''}}">
                                                        </div>
                                                        
                                                       
                                                        <div class="col-md-12">
                                                            <label>Provinsi</label>
                                                            <select name="profile__province" class="form-control" data-placeholder="Provinsi">
                                                                <option value="0"></option>
                                                                @foreach ($province as $item)
                                                                    @if ($id!=-1)
                                                                        @if (isset($profile->province))
                                                                            @if ($profile->province==$item->name)
                                                                                <option value="{{$profile->province}}" selected="selected">{{$profile->province}}</option>    
                                                                            @else
                                                                                <option value="{{$item->name}}">{{$item->name}}</option>    
                                                                            @endif
                                                                        @else
                                                                             <option value="{{$item->name}}">{{$item->name}}</option>   
                                                                        @endif
                                                                        
                                                                    @else
                                                                        <option value="{{$item->name}}">{{$item->name}}</option>    
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- <div class="col-md-12">
                                                            <label>Pilih Foto</label>
                                                            <input id="foto" type="file" class="foto" name="profile__photo">
                                                        </div> --}}
                                                        <div class="col-md-6">&nbsp;</div>
                                                            <div class="col-md-6">
                                                                <button type="submit" id="" class="btn btn-dm pull-right">Simpan</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div><!-- // row -->
                            </div>
                            <div class="col-md-3">

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
    <script src="{{asset('assets/js/moment-min.js')}}"></script>
    <script src="{{asset('assets/js/datepicker-min.js')}}"></script>
    <script>
        $(document).ready(function(){
           $('#datetimepicker1').datetimepicker({
               format : 'DD-MM-YYYY',
           });
        });
        
     
        function loaddata(id)
        {
            $('#data').load(APP_URL+'/user-data',function(){
            });
        }
       
    </script>
@endsection