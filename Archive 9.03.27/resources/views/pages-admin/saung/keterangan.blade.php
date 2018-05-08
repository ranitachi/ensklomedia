@if (count($data)!=0)
    <a class="title" href="#">{{$data->topik}}</a>
    <br>
    {!!$data->penjelasan!!}
@else

    <h2>Topik Turunan Belum Memiliki Penjelasan</h2>
@endif