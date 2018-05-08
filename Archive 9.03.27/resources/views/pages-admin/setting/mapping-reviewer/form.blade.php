@extends('layouts.master-admin')

@section('title')
    <title>Form Reviewer - Ensiklomedia</title>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pretify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-duallistbox.css')}}">
@endsection

@section('content')
             <div id="category" style="margin-top:20px;">
            	<div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" >
                                <h1 class="new-video-title"><i class="fa fa-users"></i> Form {{$id==-1 ? 'Tambah' : 'Edit'}} Reviewer</h1>
                            </div>
                            <div class="col-md-6" style="padding-top:20px;">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">&nbsp;</div>
                            <div class="col-md-4">
                                <div class="pull-right">
                                    <a href="{{url('mapping-reviewer')}}" class="btn btn-danger">
                                        <i class="fa fa-angle-double-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="add-admin" action="{{$id==-1 ? URL::to('mapping-reviewer') : URL::to('mapping-reviewer/'.$id) }}" method="POST" enctype="multipart/form-data">
                            @if ($id!=-1)
								{{ method_field('PATCH') }}
                            @endif
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row" style="margin-top:10px;" id="">
                                <div class="col-md-12" >
                                        <select multiple="multiple" size="10" id="duallistbox_demo1" name="nama_reviewer[]">
                                            @foreach ($user as $k => $v)
                                                @if ($v->authorization_level==2)
                                                    <option value="{{$v->user_id.'__'.$v->name}}" selected="selected">[{{$v->email}}] - {{is_null($v->name) ? 'n/a' : $v->name}}</option>
                                                @else
                                                    <option value="{{$v->user_id.'__'.$v->name}}">[{{$v->email}}] - {{is_null($v->name) ? 'n/a' : $v->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-default btn-block">Simpan Mapping Reviewer</button>
                                   
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
    <script src="{{asset('assets/js/pretify.js')}}"></script>
    <script src="{{asset('assets/js/jquery.bootstrap-duallistbox.js')}}"></script>
    <script>
        $(document).ready(function(){
           
        });
        var demo1 = $('select[name="nama_reviewer[]"]').bootstrapDualListbox({
            filterTextClear : 'Tampilkan Semua',
            infoText : 'Semua Data'
        });
        
        $("#add-admin").submit(function() {
            //alert($('#duallistbox_demo1').val());
            var sv=$('#duallistbox_demo1').val();
            if(sv=='')
            {
                alert('Silahkan Pilih Pengguna yang akan dijadikan Reviewer')
                return false;
            }
            else
            {
                return true;
            }
        });
    </script>
@endsection