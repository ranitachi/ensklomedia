<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Video</th>
            <th>Kontributor</th>
            <th>Institusi</th>
            <th>Tanggal Upload</th>
            <th style="width:80px;">Aksi</th>
        </tr>             
    </thead>
    <tbody>
        @if (count($video)==0)
            <tr>
                <th class="text-center" colspan="8"><i>Data Video yang akan Di Mapping Belum Tersedia</i></th>
            </tr>
        @else
            
            @php
                $no=($hal+1); 
            @endphp
            @foreach ($video as $k => $v)
                @php
                    $name=$email=$profession=$address=$authorization_level=$institute='';
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
                @endphp
                <tr>
                    <td class="text-center">{{$no}}</td>
                    <td>{{$v->title}}</td>
                    <td>{{is_null($name) ? 'n/a' : $name}}</td>
                    <td>{{$institute}}</td>
                    <td class="text-center"><span class="label label-success">{{leveluser($authorization_level)}}</span></td>
                    <td class="text-center">
                        <a href="{{url('user',$v->user_id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit text-white"></i></a>
                        <a href="javascript:hapus('{{$v->user_id}}')" class="btn btn-xs btn-danger"><i class="fa fa-trash text-white"></i></a>
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
    }
</style>