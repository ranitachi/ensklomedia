<form class="form-horizontal" id="form-category" style="border:1px solid #aaa;padding:10px;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	
    <div class="row">
        <div class="col-md-12">
            <label>Topik</label>
            <input type="text" class="form-control" placeholder="Topik" name="title" value="{{($id!=-1 ? $det->title : '')}}">
        </div>
        <div class="col-md-12">
            <label>Judul Kategori</label>
            <select class="form-control" placeholder="Judul Kategori" name="category_id">
                <option value="">-Nama Kategori-</option>
                @foreach ($cat as $item)
                    @if ($id!=-1)
                        @if ($item->id==$det->category_id)
                            <option value="{{$det->category_id}}" selected="selected">{{$det->category->name}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif        
                    @else
                        <option value="{{$item->id}}" selected="selected">{{$item->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label>Mata Pelajaran</label>
            <select class="form-control" placeholder="Mata Pelajaran" name="mapel_id">
                <option value="">-MataPelajaran-</option>
                @foreach ($petamateri as $item)
                    @if ($id!=-1)
                        @if ($item->id==$det->mapel_id)
                            <option value="{{$det->mapel_id}}" selected="selected">{{$det->mapel->title}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->title}}</option>
                        @endif        
                    @else
                        <option value="{{$item->id}}" selected="selected">{{$item->title}}</option>
                    @endif
                @endforeach
            </select>
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