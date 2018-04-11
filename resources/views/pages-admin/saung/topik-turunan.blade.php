<ul class="list-topik">
    @foreach ($data as $i)
        <li>
            <div class="row">
                <div class="col-md-9" onclick="penjelasan('{{$i->id}}')">
                    {{$i->topik}}
                </div>
                <div class="col-md-3">
                    <button class="btn btn-xs btn-primary" onclick="tambahtopik('{{$i->video_id}}','{{$i->id}}','{{$i->user_created_id}}')"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                </div>
            </div> 
        </li>
    @endforeach
</ul>