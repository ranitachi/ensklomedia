<ul class="list-topik">
    @foreach ($data as $i)
        <li>
            <div class="row">
                <div class="col-md-9">
                    @if (isset($peserta_ttg[$i->id]))
                        <a href="#" data-toggle="tooltip" title="Topik Ini Sudah Di Ikuti Oleh Siswa Lain" style="color:red;">{{$i->topik}}</a>
                    @else
                        {{$i->topik}}
                    @endif
                </div>
                <div class="col-md-3">
                    @if (Auth::user()->id == $i->saung->created_user_id || Auth::user()->id == $i->saung->fasilitasi_id || Auth::user()->id == $i->saung->reviewer_id)
                        <button class="btn btn-xs btn-primary" onclick="addtopiktantangan('{{$i->saung_id}}','{{$i->id}}','{{$i->user_created_id}}')"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-xs btn-danger" onclick="hapustantangan('{{$i->saung_id}}','{{$i->id}}','{{$i->user_created_id}}')"><i class="fa fa-trash"></i></button>
                    @else
                        @if (!isset($peserta_ttg[$i->id]))
                            <button class="btn btn-xs btn-danger" data-toggle="tooltip" title="Ikut Tantangan" onclick="ikuttantangan('{{$i->saung_id}}','{{$i->video_id}}','{{$i->id}}')"><i class="fa fa-check-square-o"></i></button>
                        @endif
                    @endif
                </div>
            </div> 
        </li>
    @endforeach
</ul>