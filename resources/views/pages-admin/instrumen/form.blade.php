<form class="form-horizontal" id="form-category" style="border:1px solid #aaa;padding:10px;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	@if ($id!=-1)
		{{ method_field('PATCH') }}
	@endif
    <div class="row">
        
        <div class="col-md-12">
            <label>Pertanyaan</label>
                 <textarea class="form-control" rows="4"  placeholder="Pertanyaan" name="pertanyaan">{{($id!=-1 ? $det->pertanyaan : '')}}</textarea>
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