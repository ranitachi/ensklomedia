<form class="form-horizontal" id="form-tantangan">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        {{-- <div class="col-md-12">
            <label>Tantangan</label>
            <select name="tantangan_id" class="form-control" data-placeholder="Tantangan">
                @if (count($topikmateri)==0)
                    <option value="-1">-Data Topik Tantangan Kosong-</option>
                @else
                    <option value="-1">-Pilih Topik-</option>    
                @endif
                @foreach ($topikmateri as $k => $v)
                    <option value="{{$v->id}}__{{$v->title}}">{{$v->title}}</option>
                @endforeach   
            </select>
        </div> --}}
        <div class="col-md-12">
            <label>Topik Tantangan Lain</label>
            <input type="text" class="form-control" id="tantangan"  placeholder="Topik Tantangan Lain" name="tantangan" value="{{$id==-1 ? '' : $data->topik}}">
        </div>
        <div class="col-md-12">
            <label>Keterangan</label>
            <textarea class="form-control" rows="4"  placeholder="Keterangan" name="keterangan">{{$id==-1 ? '' : $data->penjelasan}}</textarea>
        </div>
    </div>
</form>