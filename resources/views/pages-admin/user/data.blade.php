<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Profesi</th>
            <th>Alamat</th>
            <th>Asal Wilayah</th>
            <th>Tugas PIC</th>
            <th>Institusi</th>
            <th>Level</th>
            <th style="width:80px;">Aksi</th>
        </tr>             
    </thead>
    <tbody>
        @php
            $no=($hal+1); 
        @endphp
        @foreach ($user as $k => $v)
            <tr>
                <td class="text-center">{{$no}}</td>
                <td>{{is_null($v->name) ? 'n/a' : $v->name}}</td>
                <td>{{$v->email}}</td>
                <td>{{$v->profession}}</td>
                <td>{{$v->address}}</td>
                <td>{{isset($provinsi[$v->province]) ? $provinsi[$v->province] : 'n/a'}}</td>
                <td>{!!$v->pic==1 ? '<span class="label label-success">Ya</span>' : ''!!}</td>
                <td>{{$v->institute}}</td>
                <td class="text-center"><span class="label label-success">{{leveluser($v->authorization_level)}}</span></td>
                <td class="text-center">
                    <a href="{{url('user',$v->user_id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit text-white"></i></a>
                    <a href="javascript:hapus('{{$v->user_id}}')" class="btn btn-xs btn-danger"><i class="fa fa-trash text-white"></i></a>
                </td>
            </tr>  
        @php
            $no++;
        @endphp      
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="pull-right">
            {{ $user->links() }}
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