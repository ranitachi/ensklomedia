<form class="form-horizontal" id="form-category" style="border:1px solid #aaa;padding:10px;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	@if ($id!=-1)
		{{ method_field('PATCH') }}
	@endif
    <div class="row">
        
        <div class="col-md-12">
            <label>Tanggal Pelaksanaan</label>
            <input type="text" class="form-control" id="tanggal" placeholder="Tanggal Kegiatan" name="start_date" value="{{($id!=-1 ? date('d/m/Y',strtotime($det->start_date)).' - '.date('d/m/Y',strtotime($det->end_date)) : '')}}">
        </div>

        <div class="col-md-12">
            <label>Provinsi</label>
            <select name="wilayah_id" class="form-control" data-placeholder="Provinsi">
            @foreach ($prov as $item)
                @if ($id!=-1)
                    @if ($det->wilayah_id==$item->id)
                        <option value="{{$det->wilayah_id}}" selected="selected">{{$item->name}}</option>
                    @else
                        <option value="{{$item->id}}">{{$item->name}}</option>  
                    @endif
                @else
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endif
            @endforeach
                
            </select>
        </div>
        <div class="col-md-12">
            <label>Lokasi</label>
            <input type="text" class="form-control" placeholder="Lokasi" name="nama_fasilitasi" value="{{($id!=-1 ? $det->nama_fasilitasi : '')}}">
        </div>
        <div class="col-md-12">
            <label>Aktif</label>
            <select name="flag" class="form-control" data-placeholder="Aktif">
                @if ($id==-1)
                    <option value="1">Aktif</option>
                    <option value="0">Non Aktif</option>
                @else
                    <option value="1" {{ $id==1 ? 'selected="selected"' : '' }}>Aktif</option>
                    <option value="0" {{ $id==0 ? 'selected="selected"' : '' }}>Non Aktif</option>
                @endif
                
            </select>
        </div>

            <div class="col-md-6" style="padding-top:10px;">
                <button type="button" class="btn btn-sm btn-success" onclick="baru()"><i class="fa fa-new"></i>&nbsp;Data Baru</i></button>
            </div>
            <div class="col-md-6" style="padding-top:10px;">
                 <button type="button" class="btn btn-sm btn-primary pull-right" onclick="simpan({{$id}})"><i class="fa fa-save"></i>&nbsp;Simpan</i></button>
             </div>
         </div>
     </form>

<div id="modalConfirm" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Information</h5>
                </div>

                <form action="{{ route('mapping-to-fasilitasi.simpan') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idfasilitasi" id="idfasilitasi">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="">Silahkan pilih User di bawah ini:</label>
                               
                                <select name="id_pic[]" id="" class="form-control chosen-select" multiple="multiple">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($user as $item)
                                        @if ($item->authorization_level==2)
                                            <option value="{{ $item->id }}">{{ isset($item->profile->name) ?$item->profile->name : '' }} [{{ $item->email }}]</option>
                                        @endif
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
<div id="modalNarsum" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Information</h5>
                </div>

                <form action="{{ route('narsum-to-fasilitasi.simpan') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="narsumidfasilitasi" id="narsumidfasilitasi">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="">Silahkan pilih 2 Narasumber/Reviewer di bawah ini:</label>
                               
                                <select name="id_narsum[]" id="idnarsum" class="form-control" multiple="multiple">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($user as $item)
                                        @if ($item->authorization_level==3)
                                            <option value="{{ $item->id }}">{{ isset($item->profile->name) ?$item->profile->name : '' }} [{{ $item->email }}]</option>
                                        @endif
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
    <script>
        $('#idnarsum').chosen({max_selected_options: 2});
    </script>