<div class="col-md-12">
<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th rowspan="2" class="text-center">No</th>
            {{-- <th rowspan="2" class="text-center">Pertanyaan</th> --}}
            <th rowspan="2" class="text-center">Lokasi</th>
            <th rowspan="2" class="text-center">Waktu Pelaksaaan</th>
            <th colspan="{{ count($menu) }}" class="text-center">Menu</th>
            <th rowspan="2" class="text-center">Peserta</th>
            <th rowspan="2" class="text-center">Tambah Peserta</th>
            
        </tr>             
        <tr>
            @foreach ($menu as $i => $v)
            <th class="text-center">{!!str_replace('dan','<br>dan',$v->title)!!}</th>
            @endforeach
        </tr>             
    </thead>
    <tbody>
@php
    $no=$page+1;
    $iduser=Auth::user()->id;
@endphp
        
 @foreach ($kegiatan as $i => $v)
    
    @if(isset($map[$iduser][$v->wilayah_id][$v->id]))
    
        <tr>
            <td class="text-center">{{($no)}}</td>
            {{-- <td class="text-left">{{($v->nama_fasilitasi)}}</td> --}}
            <td class="text-left">{{($v->provinsi->name)}}</td>
            <td class="text-center">
                <b>{{date('d-m-Y', strtotime($v->start_date))}}</b><br>s.d.<br>
                <b>{{date('d-m-Y', strtotime($v->end_date))}}</b>
            </td>
            @foreach ($menu as $ii => $vv)
            @if ($vv->route=='cetak-sertifikat')
                <td class="text-center">
                    <a class="btn btn-xs btn-primary" href="{{url($vv->route)}}/{{$v->id}}"><i class="fa fa-print"></i> {{$vv->title}}</a>
                </td>
            @else
                <td class="text-center" style="width:100px;">
                    @if (isset($menupivot[$vv->id][$v->id]))  
                        @php
                            $det=$menupivot[$vv->id][$v->id];
                        @endphp                  
                        {!!($det->flag==1 ? '<span class="label label-success">Aktif</span>' : '<span class="label label-danger">Non Aktif</span>')!!}    
                        @if ($det->flag==1)
                            <span class="label label-danger" style="cursor:pointer" onclick="changestatus('{{$v->id}}','{{$det->menu_id}}','0')" data-toggle="tooltip" title="Non Aktifkan" data-placement="top"><i class="fa fa-times"></i></span>
                        @else
                            <span class="label label-primary" style="cursor:pointer" onclick="changestatus('{{$v->id}}','{{$det->menu_id}}','1')" data-toggle="tooltip" title="Aktifkan" data-placement="top"><i class="fa fa-check"></i></span>
                        @endif
                    @else
                    <span class="label label-danger">Non Aktif</span>
                        <span class="label label-primary" style="cursor:pointer" onclick="changestatus('{{$v->id}}','{{$vv->id}}','1')" data-toggle="tooltip" title="Aktifkan" data-placement="top"><i class="fa fa-check"></i></span>
                    @endif
                </td>
            @endif
            @endforeach
           <td>

            @if (!isset($psrt[$v->id]))
                 <i>Peserta Belum Ada</i>
            @else
                @if (count($psrt[$v->id])==0)
                    <i>Peserta Belum Ada</i>
                
                @else
                    @foreach ($psrt[$v->id] as $item)
                        <div class="row" style="margin-bottom:10px;">
                            @if ($item->flag==0)
                                <div class="col-md-2 text-right" style="padding-right:1px;">
                                    <i class="fa fa-check" style="color:green;cursor:pointer" data-toggle="tooltip" title="Aktifkan Peserta" onclick="aktifkanpeserta('{{$item->idpf}}','1')"></i>
                                    <i class="fa fa-trash" style="color:red;cursor:pointer" data-toggle="tooltip" title="Hapus Peserta" onclick="hapuspeserta('{{$item->idpf}}')"></i>
                                </div>
                                <div class="col-md-9 text-left" style="padding-left:5px;color:red" data-toggle="tooltip" title="Peserta Belum Aktif"><b>{{$item->name=='n/a'||$item->name=='' ? $item->user->email : $item->name}}</b></div>
                            @else
                                <div class="col-md-2 text-right" style="padding-right:1px;"><i class="fa fa-close" style="color:purple;cursor:pointer" data-toggle="tooltip" title="Non Aktifkan Peserta" onclick="aktifkanpeserta('{{$item->idpf}}','0')"></i>
                                 <i class="fa fa-trash" style="color:red;cursor:pointer" data-toggle="tooltip" title="Hapus Peserta" onclick="hapuspeserta('{{$item->idpf}}')"></i>
                                </div>    
                                <div class="col-md-9 text-left" style="padding-left:5px;color:green"><b><span class="label label-success" style="font-size:12px;">{{$item->name=='n/a'||$item->name=='' ? $item->user->email : $item->name}}</span></b></div>
                            @endif
                        </div>
                    @endforeach
                @endif
            @endif
                    
           </td>
           <td>
               <div class="row">
                        <div class="col-md-10" style="color:green"><b><span class="label label-primary" style="font-size:12px;cursor:pointer;" onclick="addpeserta('{{$v->id}}')"><i class="fa fa-plus-square" style="cursor:pointer" data-toggle="tooltip" title="Tambah Peserta Fasilitasi" ></i> Tambah Peserta Fasilitasi</span></b></div>
                    </div>
           </td>
        </tr>
        @php
            $no++;
        @endphp
    @endif
@endforeach
</tbody>
</table>
</div>