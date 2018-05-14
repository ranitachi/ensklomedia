<form method="POST" action="{{url('evaluasi-simpan/'.$jenis.'/'.$idfasil)}}" class="form-horizontal" id="form-evaluasi-narsum">
    <legend>Form Evaluasi Narasumber</legend>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="control-label col-md-2">Nama Narasumber</label>
        <div class="col-sm-6">    
            {{-- <input type="text" class="form-control" name="nama_narasumber" placeholder="Nama Narasumber" id="nama_narasumber"> --}}
            <select name="nama_narasumber" id="nama_narasumber" class="form-control" data-placeholder="Nama Narasumber" style="margin-bottom:5px">
            @foreach ($d_narsum as $kid=>$im)
                <option value="{{$kid}}__{{ucwords($im)}}">{{ucwords($im)}}</option>
            @endforeach
                
            </select>
        </div>
        
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Materi Fasilitasi</label>
        <div class="col-sm-6">
            <input type="text" class="form-control " name="materi_fasilitasi" placeholder="Materi Fasilitasi" id="materi_fasilitasi">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Jam Ke</label>
        <div class="col-sm-6">
            <input type="text" class="form-control " name="jam_ke" placeholder="Jam Ke" id="jam_ke">
        </div>
    </div>
    <legend style="margin-top:10px;">Petunjuk Pengisian	: Mohon diisi dengan memilih pilihan pada kolom yang tersedia</legend>
    <table class="table table-bordered table-hover table-striped" width="100%">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Butir-butir Penilaian</th>
                <th class="text-center">60-70</th>
                <th class="text-center">71-80</th>
                <th class="text-center">81-90</th>
                <th class="text-center">91-100</th>
            </tr>             
        </thead>
        <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($item as $k=>$v)
                    @php
                        $a=$b=$c=$d='';
                        if(isset($evl[$v->id]))
                        {
                            if($evl[$v->id]->pilihan=='60-70')
                            {
                                $a='checked="checked"';
                            }
                            else if($evl[$v->id]->pilihan=='71-80')
                            {
                                $b='checked="checked"';
                            }
                            else if($evl[$v->id]->pilihan=='81-90')
                            {
                                $c='checked="checked"';
                            }
                            else if($evl[$v->id]->pilihan=='91-100')
                            {
                                $d='checked="checked"';
                            }
                        }
                        else 
                        {
                            $a=$b=$c=$d='';
                            // echo 'aa';
                        }
                    @endphp
                    <tr>
                        <td class="text-center">{{$no}}</td>
                        <td class="text-left">{{$v->butir_penilaian}}</td>
                        <td class="text-center">
                            <input type="radio" name="butir[{{$v->id}}]" value="60-70" {{$a}}>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="butir[{{$v->id}}]" value="71-80" {{$b}}>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="butir[{{$v->id}}]" value="81-90" {{$c}}>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="butir[{{$v->id}}]" value="91-100" {{$d}}>
                        </td>
                    </tr>
                @php
                    $no++;
                @endphp
                @endforeach
                
            
        </tbody>
    </table>
    @if (count($evl)==0)
        <button class="btn btn-md btn-success pull-right" type="button" onclick="endevaluasinarasumber('{{ucwords($jenis)}}','{{$idfasil}}')"><i class="fa fa-save"></i> &nbsp;&nbsp;Simpan Evaluasi</button>
    @endif
</form>