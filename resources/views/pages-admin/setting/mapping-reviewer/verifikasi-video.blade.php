<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Video</th>
            <th>Kontributor</th>
            <th>Institusi</th>
            <th>Tanggal Upload</th>
            <th>Status</th>
            <th style="width:120px;">Aksi</th>
            <th>Verifikasi</th>
        </tr>             
    </thead>
    <tbody>
        @if (count($video)==0)
            <tr>
                <th class="text-center" colspan="8"><i>Data Video yang akan Di Verifikasi Belum Tersedia</i></th>
            </tr>
        @else
            
            @php
                $no=($hal+1); 
            @endphp
            @foreach ($video as $k => $v)
                @php
                    $name=$email=$profession=$address=$institute=$authorization_level='-';
                    if(isset($user[$v->user_id]))
                    {
                        $us=$user[$v->user_id];
                        $name=(is_null($us->name) ? 'n/a' : $us->name);
                        $email=(is_null($us->email) ? 'n/a' : $us->email);
                        $profession=(is_null($us->profession) ? 'n/a' : $us->profession);
                        $address=(is_null($us->address) ? 'n/a' : $us->address);
                        $institute=(is_null($us->institute) ? 'n/a' : $us->institute);
                        $authorization_level=(is_null($us->authorization_level) ? 'n/a' : $us->authorization_level);
                    }
                    if(is_null($v->active_by))
                    {
                        $status='<span class="label label-primary">Menunggu Verifikasi Ring 1</span>';
                    }
                    else if($v->approved_by==0 || is_null($v->approved_by))
                    {
                        $status='<span class="label label-info">Menunggu Kajian Reviewer</span>';
                    }
                    else
                    {
                        $status='<span class="label label-success"><i class="fa fa-check"></i>&nbsp;Sudah Tayang</span>';
                    }
                @endphp
                <tr>
                    <td class="text-center">{{$no}}</td>
                    <td>{{is_null($v->title) ? 'n/a' : $v->title}}</td>
                    <td>{{$name}}</td>
                    <td>{{$institute}}</td>
                    <td class="text-center">{{date('d-m-Y H:i:s',strtotime($v->created_at))}}</td>
                    <td class="text-center">{!!$status!!}</td>
                    <td class="text-center">
                        <a href="javascript:lihat('{{$v->id}}')" class="btn btn-xs btn-info" data-toggle="tooltip" title="Lihat Video"><i class="fa fa-eye text-white"></i></a>
                        <a href="{{url('user',$v->user_id)}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit Video"><i class="fa fa-edit text-white"></i></a>
                        <a href="javascript:hapus('{{$v->user_id}}')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Hapus Video"><i class="fa fa-trash text-white"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="javascript:verifikasi('{{$v->id}}',1)" class="btn btn-xs btn-success" data-toggle="tooltip" title="Verifikasi Video"><i class="fa fa-check text-white"></i></a>
                        <a href="javascript:verifikasi('{{$v->id}}',0)" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Hapus Verifikasi Video"><i class="fa fa-close text-white"></i></a>
                    </td>
                </tr>  
            @php
                $no++;
            @endphp      
            @endforeach
        @endif

    </tbody>
</table>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="pull-right">
            {{ $video->links() }}
        </div>
    </div>
</div>
<style>
    th
    {
        text-align:center;
        background:#eee;
        border:1px solid #111;
        font-size:13px;
    }
    td
    {
        font-size:13px;
        padding:10px !important;
    }
</style>