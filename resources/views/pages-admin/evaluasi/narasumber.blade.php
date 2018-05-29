<table class="table table-bordered table-hover table-striped" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-left">Peserta</th>
            <th class="text-center">Narasumber</th>
            <th class="text-center" style="width:80px;">#</th>
        </tr>             
    </thead>
    <tbody>
    @php
        $no=0;
    @endphp
    @foreach ($d_eval as $ii => $vv)
        <tr>
            <td class="text-center">{{++$no}}</td>
            <td class="text-left">{{isset($user[$ii]) ? $user[$ii]->profile->name : ''}}<br>
                <a href="#" style="font-style:italic;color:blue;">{{isset($user[$ii]) ? $user[$ii]->email : ''}}</a>
            </td>
            <td class="text-left">
                @foreach ($vv as $kv => $val)
                    {{isset($user[$kv]) ? $user[$kv]->profile->name : $kv}}<br>
                @endforeach
            </td>
            <td class="text-center">
                {{-- <a href="#" class="btn btn-xs btn-primary" target="_blank" data-toggle="tooltip" title="Lihat Saung"><i class="fa fa-search"></i></a> --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<style>
    table th,table td
    {
        color : black !important;
    }
</style>