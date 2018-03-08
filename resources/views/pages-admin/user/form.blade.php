@extends('layouts.master-admin')

@section('title')
    <title>Form Pengguna - Ensiklomedia</title>
    <link rel="stylesheet" href="{{ asset('assets/css/datepicker.css')}}" />
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-users"></i> Form {{$id==-1 ? 'Tambah' : 'Edit'}} Pengguna</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">&nbsp;</div>
                            <div class="col-md-4">
                                <div class="pull-right">
                                    <a href="{{url('user')}}" class="btn btn-danger">
                                        <i class="fa fa-angle-double-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="add-user" action="{{$id==-1 ? URL::to('user') : URL::to('user/'.$id) }}" method="POST" enctype="multipart/form-data">
                            @if ($id!=-1)
								{{ method_field('PATCH') }}
							@endif
                            <div class="row" style="margin-top:10px;" id="upload">
                                <div class="col-md-6" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" placeholder="Nama" name="profile__name" value="{{$id!=-1 ? $det->name : ''}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tempat Lahir</label>
                                                <input type="text" class="form-control" placeholder="Tempat Lahir" name="profile__place_of_birth" value="{{$id!=-1 ? $det->place_of_birth : ''}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tanggal Lahir</label>
                                                <div class="form-group">
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input type="text" class="form-control" placeholder="Tanggal Lahir" name="profile__date_of_birth" value="{{$id!=-1 ? date('d/m/Y',strtotime($det->date_of_birth)) : ''}}">
                                                        <span class="input-group-addon btn btn-primary">
                                                            <span class="fa fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="users__email" placeholder="Email" id="email" value="{{$id!=-1 ? $det->email : ''}}">
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
                                                        <option value="L" {{$det->gender=='L' ? 'selected="selected"' : ''}}>Laki-laki</option>
                                                        <option value="P" {{$det->gender=='P' ? 'selected="selected"' : ''}}>Perempuan</option>
                                                    @else
                                                        <option value="L">Laki-laki</option>
                                                        <option value="P">Perempuan</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Authorization Level</label>
                                                <select name="users__authorization_level" class="form-control" data-placeholder="Authorization Level">
                                                    <option value=""></option>
                                                    @foreach ($level as $k => $v)
                                                        @if ($id!=-1)
                                                            @if ($det->authorization_level==$k)
                                                                <option value="{{$det->authorization_level}}" selected="selected">{{$v}}</option>    
                                                            @else
                                                                <option value="{{$k}}">{{$v}}</option>
                                                            @endif
                                                        @else
                                                            <option value="{{$k}}">{{$v}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Alamat</label>
                                                <textarea class="form-control" rows="4"  placeholder="Alamat" name="profile__address">{{$id!=-1 ? $det->address : ''}}</textarea>
                                            </div>
                                            
                                           
                                        </div>
                                    </div><!-- // row -->
                                    <div class="col-md-6" >
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Profesi</label>
                                                <input type="text" class="form-control" placeholder="Profesi" name="profile__profession" value="{{$id!=-1 ? $det->profession : ''}}">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Nama Channel Ensiklomedia</label>
                                                <input type="text" class="form-control" placeholder="Nama Channel Ensiklomedia" name="profile__channel_name" value="{{$id!=-1 ? $det->channel_name : ''}}">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Nomor Telp/HP</label>
                                                <input type="text" class="form-control" placeholder="Nomor Telp/HP" name="profile__phone_number" value="{{$id!=-1 ? $det->phone_number : ''}}">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Institusi</label>
                                                <input type="text" class="form-control" placeholder="Institusi" name="profile__institute" value="{{$id!=-1 ? $det->institute : ''}}">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Pendidikan Terakhir</label>
                                                <input type="text" class="form-control" placeholder="Pendidikan Terakhir" name="profile__educational_level" value="{{$id!=-1 ? $det->educational_level : ''}}">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Pilih Foto</label>
                                                <input id="foto" type="file" class="foto" name="foto">
                                            </div>
                                             <div class="col-md-6">&nbsp;</div>
                                                <div class="col-md-6">
                                                    <button type="submit" id="" class="btn btn-dm pull-right">{{$id!=-1 ? 'Edit' : 'Simpan'}}</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


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
    </script>
@endsection