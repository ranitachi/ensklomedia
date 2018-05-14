<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-left">Saung</th>
            <th class="text-center">Status Saung</th>
            <th class="text-center">Guru</th>
            <th class="text-center">Email</th>
            <th class="text-center" style="width:80px;">#</th>
        </tr>             
    </thead>
    <tbody>
    @foreach ($saung as $ii => $vv)
        <tr>
            <td class="text-center">{{++$ii}}</td>
            <td class="text-left">{{$vv->saung_name}}</td>
            <td class="text-left">{!!$vv->flag==1 ? '<span class="label label-success">Aktif</span>' : '<span class="label label-warning">Tidak Aktif</span>'!!}</td>
            <td class="text-left">{{$vv->user->profile->name}}</td>
            <td class="text-left">{{$vv->user->email}}</td>
            <td class="text-center">
                <a href="{{url('buka-saung/'.$vv->video->slug)}}" class="btn btn-xs btn-primary" target="_blank" data-toggle="tooltip" title="Lihat Saung"><i class="fa fa-search"></i></a>
                <a href="javascript:hapussaung('{{$vv->id}}','{{$vv->fasilitasi_id}}')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Hapus Saung"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>