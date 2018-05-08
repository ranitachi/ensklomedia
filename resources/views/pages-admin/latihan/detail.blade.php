{{-- <h2>Pertanyaan :</h2>
<p>
    {!!$question!!}
</p>

<hr> --}}
<hr>
<div class="row">
    <div class="col-md-12">
        <button class="pull-right btn btn-xs btn-danger" onclick="hapuslatihan({{$idsaung}},{{$id}})">
                <i class="fa fa-trash"></i>&nbsp;Hapus Latihan
        </button>&nbsp;&nbsp;
        <button class="pull-right btn btn-xs btn-success" onclick="latihanform({{$idsaung}},{{$id}})">
            <i class="fa fa-edit"></i>&nbsp;Edit Latihan
        </button>&nbsp;&nbsp;
    </div>
</div>
<ul class="nav nav-tabs" style="margin-top:20px;">
    <li class="active"><a data-toggle="tab" href="#pertanyaann">Pertanyaan</a></li>
@foreach ($test as $item)
    @if ($item->flag==1)
        <li><a data-toggle="tab" href="#benar">Jawaban Benar</a></li>
    @else
        <li><a data-toggle="tab" href="#menu{{$item->id}}">Jawaban Lain</a></li>
    @endif
@endforeach
 
</ul>
<div class="tab-content" style="border:1px solid #ccc;border-top:0px;padding:10px;">
    <div id="pertanyaann" class="tab-pane fade in active">
        {!!$question!!}
    </div>
@foreach ($test as $item)
    @if ($item->flag==1)
        <div id="benar" class="tab-pane fade">
            {!!$item->answer!!}
        </div>
    @else
        <div id="menu{{$item->id}}" class="tab-pane fade">
            {!!$item->answer!!}
        </div>
    @endif
@endforeach
  
</div>
<style>
    .nav>li>a
    {
        padding: 5px 10px !important;
    }
</style>