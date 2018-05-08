<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Pertanyaan</th>
            <th class="text-center">Jawaban</th>
        </tr>             
    </thead>
    
    <tbody>
        
            <tr>
                <td class="text-center">{{$no}}</td>
                <td class="text-left">{{$soal[0]->test->question}}</td>
                <td class="text-left">
                    @foreach ($soal as $k=>$item)
                        <div class="row" style="margin-bottom:10px;">
                            <div class="col-md-1 text-right">
                                @if (isset($jwb[$item->id]))
                                    <input type="radio" name="jawaban[{{$item->question_id}}]" onclick="jawabsoal('{{$jenis}}','{{$id}}',{{$no}},{{$item->id}},{{$idfasil}})" checked="checked">
                                @else
                                    <input type="radio" name="jawaban[{{$item->question_id}}]" onclick="jawabsoal('{{$jenis}}','{{$id}}',{{$no}},{{$item->id}},{{$idfasil}})">
                                @endif
                            </div>
                            <div class="col-md-11">{{$item->answer}}</div>
                        </div>
                    @endforeach
                </td>
            </tr>
            
        
    </tbody>
</table>