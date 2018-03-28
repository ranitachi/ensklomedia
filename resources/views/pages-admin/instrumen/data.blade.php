<div class="col-md-12">
<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Pertanyaan</th>
            <th class="text-center">Aktif</th>
            <th class="text-center" style="width:80px;">Aksi</th>
        </tr>             
    </thead>
    <tbody>
@php
    $no=$page+1;
@endphp
 @foreach ($instrumen as $i => $v)
        <tr>
            <td class="text-center">{{($no)}}</td>
            <td class="text-left">{{($v->pertanyaan)}}</td>
            <td class="text-center">
                {!!($v->flag==1 ? '<span class="label label-success">Aktif</span>' : '<span class="label label-danger">Non Aktif</span>')!!}
                &nbsp;&nbsp;
                @if ($v->flag==1)
                    <span class="label label-danger" style="cursor:pointer" onclick="changestatus('{{$v->id}}','0')" data-toggle="tooltip" title="Non Aktifkan" data-placement="top"><i class="fa fa-times"></i></span>
                @else
                    <span class="label label-primary" style="cursor:pointer" onclick="changestatus('{{$v->id}}','1')" data-toggle="tooltip" title="Aktifkan" data-placement="top"><i class="fa fa-check"></i></span>
                @endif
            </td>
            <td class="text-center">
                <a href="javascript:loadform('{{$v->id}}')" style="text-transform:capitalize !important;" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                <a href="javascript:hapus('{{$v->id}}')" style="text-transform:capitalize !important;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
@php
    $no++;
@endphp
@endforeach
</tbody>
</table>
<div style="text-align:center">{{$instrumen->links()}}</div>
</div>