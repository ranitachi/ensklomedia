<div class="row">
    <div class="col-md-12">
        @php
            $no=1;
        @endphp
        @foreach ($latihan as $index=>$item)
            <button class="btn btn-xs btn-primary" onclick="lihatsoal('{{$item->test_id}}',{{$idsaung}})">Soal No. {{$no}}</button>
            @php
                $no++;
            @endphp
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="detail"></div>
    </div>
</div>