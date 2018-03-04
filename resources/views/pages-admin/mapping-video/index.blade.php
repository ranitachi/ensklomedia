@extends('layouts.master-admin')

@section('title')
    <title>Mapping Admin - Ensiklomedia</title>
    <style>
        th
        {
            text-align:center;
            background:#eee;
            border:1px solid #111;
        }
    </style>
@endsection

@section('content')

    <div id="modalConfirm" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Information</h5>
                </div>

                <form action="{{ route('mapping-to-reviewer.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="">Silahkan pilih reviewer di bawah ini:</label>
                                <input type="hidden" id="vid" name="video_id" value="">
                                <select name="id_reviewer" id="" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($reviewers as $item)
                                        <option value="{{ $item->id }}">{{ $item->profile->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-success" id="ok"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>

    <div id="category" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        <strong>Sukses!</strong> 
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6" >
                        <h1 class="new-video-title"><i class="fa fa-users"></i> Mapping Video To Reviewer</h1>
                    </div>
                    <div class="col-md-6" style="padding-top:20px;">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        {{--  <a href="{{url('mapping-admin')}}/-1" class="btn btn-danger">
                            <i class="fa fa-plus-square"></i> Tambah Admin
                        </a>  --}}
                    </div>
                    <div class="col-md-4">
                        <div class="pull-right">
                            <div class="input-group">
                                <input type="text" class="form-control" id="user-search" placeholder="Cari Nama dan Email Super User">
                                <div class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12" >
                        <table class="table table-bordered table-hover table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Kontributor</th>
                                    <th>Aktifasi Oleh</th>
                                    <th>Tanggal Aktifasi</th>
                                    <th>Reviewer</th>
                                    <th style="width:80px;">Aksi</th>
                                </tr>             
                            </thead>
                            <tbody>
                                @foreach ($videos as $key => $item)
                                    <tr>
                                        <td>{{ $key = $key+1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ (is_null($item->user->profile->name)) ? 'n/a' : $item->user->profile->name }}</td>
                                        <td>{{ $item->activated->profile->name }}</td>
                                        <td>{{ $item->flag_active }}</td>
                                        <td>
                                            {{ (empty($item->reviewer->profile->name)) ? 'n/a' : $item->reviewer->profile->name }}
                                        </td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-target="#modalConfirm" data-value="{{ $item->id }}" class="btn btn-xs btn-primary simpan"><i class="fa fa-edit text-white"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                <div class="pull-right">
                                    
                                </div>
                            </div>
                        </div>
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
    <script>
        $('.simpan').click(function(){
            var a = $(this).data('value')
            $('#vid').attr('value', a)
        })
    </script>
@endsection