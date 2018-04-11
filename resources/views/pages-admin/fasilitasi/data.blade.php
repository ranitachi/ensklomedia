<div class="col-md-12">
<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            {{-- <th class="text-center">Nama Fasilitasi</th> --}}
            <th class="text-center">Wilayah</th>
            <th class="text-center">Tanggal Pelaksanaan</th>
            <th class="text-center">PIC Fasilitasi</th>
            <th class="text-center">Narsum/Reviewer</th>
            <th class="text-center" style="width:90px;">Aktif</th>
            <th class="text-center" style="width:70px;">Aksi</th>
        </tr>             
    </thead>
    <tbody>
@php
    $no=$page+1;
@endphp
        @if (count($instrumen)==0)
            <tr>
                <th colspan="7" class="text-center"><i>Data Kegiatan Fasilitas Belum Tersedia</i></th>
            </tr>
        @else
            
    @foreach ($instrumen as $i => $v)
            <tr>
                <td class="text-center">{{($no)}}</td>
                {{-- <td class="text-left">{{$v->nama_fasilitasi}}</td> --}}
                <td class="text-left">{{isset($v->provinsi->name) ? $v->provinsi->name : ''}}</td>
                <td class="text-center"><b>{{date('d-m-Y', strtotime($v->start_date))}}</b> <br>s.d. <br><b>{{date('d-m-Y', strtotime($v->end_date))}}</b></td>
                <td class="text-left">
                @if (isset($mapping[$v->id]))
                    @if (count($mapping[$v->id])!=0)
                        @foreach ($mapping[$v->id] as $k => $item)
                        <i class="fa fa-close" data-toggle="tooltip" data-placement="right" title="Hapus PIC" style="color:red;cursor:pointer" onclick="hapuspic('{{$item->id}}')"></i>&nbsp;<b>{{$item->user->email}}</b><br>
                        @endforeach
                    @else                    
                        <button class="btn btn-xs btn-info" onclick="pilihpic('{{$v->id}}')">
                            <i class="fa fa-search"></i> Pilih PIC
                        </button>
                    @endif
                @else
                    <button class="btn btn-xs btn-info" onclick="pilihpic('{{$v->id}}')">
                        <i class="fa fa-search"></i> Pilih PIC
                    </button>
                @endif
                </td>
                <td class="text-left">
                    @if (isset($narsum[$v->id]))
                        @if (count($narsum[$v->id])!=0)
                            @foreach ($narsum[$v->id] as $k => $item)
                                @if (isset($item->narsum1->email))
                                    <i class="fa fa-close" data-toggle="tooltip" data-placement="right" title="Hapus PIC" style="color:red;cursor:pointer" onclick="hapusnarsum('{{$item->id}}',1)"></i>&nbsp;<b>{{$item->narsum1->email}}</b><br>
                                @endif

                                @if (isset($item->narsum2->email))
                                    <i class="fa fa-close" data-toggle="tooltip" data-placement="right" title="Hapus PIC" style="color:red;cursor:pointer" onclick="hapusnarsum('{{$item->id}}',2)"></i>&nbsp;<b>{{$item->narsum2->email}}</b><br>
                                @endif

                                @if (is_null($item->narsum_1_id) && is_null($item->narsum_2_id))
                                    <button class="btn btn-xs btn-info" onclick="pilihnarsum('{{$v->id}}')">
                                        <i class="fa fa-search"></i> Pilih Narsum
                                    </button>
                                @endif
                            @endforeach
                        @else                    
                            <button class="btn btn-xs btn-info" onclick="pilihnarsum('{{$v->id}}')">
                                <i class="fa fa-search"></i> Pilih Narsum
                            </button>
                        @endif
                    @else
                        <button class="btn btn-xs btn-info" onclick="pilihnarsum('{{$v->id}}')">
                            <i class="fa fa-search"></i> Pilih Narsum
                        </button>
                    @endif
                    
                </td>
                <td class="text-center">
                    {!!($v->flag==1 ? '<span class="label label-success">Aktif</span>' : '<span class="label label-danger">Non Aktif</span>')!!}
                    
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
@endif

</tbody>
</table>
<div style="text-align:center">{{$instrumen->links()}}</div>
</div>