<div class="col-md-12">
<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Mata Pelajaran</th>
        </tr>             
    </thead>
    <tbody>
 @foreach ($category as $i => $v)
        <tr>
            <td class="text-center">{{(++$i)}}</td>
            <td class="text-left"><b>{{($v->name)}}</b></td>
            <td class="text-left">
                <div class="row">
                    <div class="col-md-9">
                    @if (isset($petamateri[$v->id]))
                        @foreach ($petamateri[$v->id] as $item)
                            <div class="row">
                                <div class="col-md-2 col-sm-1 col-xs-1" style="text-align:right;color:red;"><i class="fa fa-plus-circle" onclick="topikmateri('{{$v->id}}','{{$item->id}}','-1')" style="cursor:pointer"></i></div>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <a href="#">
                                        <b>{{$item->title}}</b>
                                    </a>
                                    @if (isset($topik[$item->id]))
                                        <ul style="margin-left:20px;list-style:none;margin-top:5px;" class="ul-m">
                                            @foreach ($topik[$item->id] as $itm)
                                                <li>
                                                    <i class="fa fa-edit" onclick="topikmateri('{{$v->id}}','{{$item->id}}',{{$itm->id}})" style="cursor:pointer;color:blue;"></i> 
                                                    <i class="fa fa-trash" onclick="hapustopikmateri('{{$v->id}}','{{$item->id}}',{{$itm->id}})" style="cursor:pointer;color:red;"></i> 
                                                    {{$itm->title}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                        @endforeach
                    @else
                        <i>Mata Pelajaran Masih Kosong</i>
                    @endif    
                    </div>
                    
                </div>
            </td>
            
        </tr>
    {{--  <div class="col-md-6">
        <div class="chanel-item" style="border:1px solid #ddd;">
            <div class="row">
                <div class="col-md-3">
                    <div class="chanel-thumb">
                        <a href="#"><img src="{{asset('assets/img/category-icon-24234.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="chanel-info" style="margin-top:-5px;">
                        <span class="subscribers">436,414 subscribers</span>
                        <a class="title" href="#">{{$v->name}}</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <a href="javascript:hapus('{{$v->id}}')" style="text-transform:capitalize !important;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="pull-right">
                        <a href="javascript:loadform('{{$v->id}}')" style="text-transform:capitalize !important;" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                        <a href="#" style="text-transform:capitalize !important;" class="btn btn-xs btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
@endforeach
</tbody>
</table>
</div>