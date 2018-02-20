<form class="form-horizontal" id="form-category" style="border:1px solid #aaa;padding:10px;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	@if ($id!=-1)
		{{ method_field('PATCH') }}
	@endif
    <div class="row">
        <div class="col-md-12">
            <label>Kode</label>
            <input type="text" class="form-control" placeholder="Kode" name="code" value="{{($id!=-1 ? $det->code : '')}}">
        </div>
        <div class="col-md-12">
            <label>Judul Kategori</label>
                    <input type="text" class="form-control" placeholder="Judul Kategori" name="name" value="{{($id!=-1 ? $det->category : '')}}">
        </div>
        <div class="col-md-12">
            <label>Deskripsi</label>
                 <textarea class="form-control" rows="4"  placeholder="Deskripsi" name="desc">{{($id!=-1 ? $det->desc : '')}}</textarea>
        </div>

            <div class="col-md-9">&nbsp;</div>
            <div class="col-md-3" style="padding-top:10px;">
                 <button type="button" class="btn btn-sm btn-primary pull-right" onclick="simpan({{$id}})"><i class="fa fa-save"></i>&nbsp;Simpan</i></button>
             </div>
         </div>
     </form>