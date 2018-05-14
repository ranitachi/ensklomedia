<form method="POST" action="{{url('evaluasi-simpan/'.$jenis.'/'.$idfasil)}}" class="form-horizontal" id="form-evaluasi-penyelenggara">
    <legend>Form Evaluasi Penyelenggaraan</legend>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <h4 style="margin-top:10px;">Petunjuk Pengisian	: 
        <ol style="margin-left:20px;">
            <li>Pilihlah salah satu poin  pada kolom  (kondisi nyata yang dirasakan) menurut pendapat bapak/ibu yang paling sesuai.
			<li>Kondisi nyata adalah apa yang dirasakan bapak/ibu terhadap pelayanan dan materi fasilitasi selama kegiatan berlangsung
			<li>Apabila ada saran untuk perbaikan dapat dituliskan pada kolom saran

        </ol>
    </h4>
    <table class="table table-bordered table-hover table-striped" width="100%">
        <thead>
            <tr>
                <th class="text-center" colspan="2">INDIKATOR</th>
                <th class="text-center" colspan="5">KONDISI YANG DISARANKAN</th>
                <th class="text-center">SARAN</th>
            </tr>             
        </thead>
        <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($item[0] as $k=>$v)
                    @php
                        $pilihan=explode('/',$v->pilihan);
                    @endphp
                    <tr>
                        <td class="text-left" style="font-weight:bold;width:30px;font-size:10px;">{{$no}}</td>
                        <td class="text-left" style="font-weight:bold;font-size:10px;">{{$v->indikator}}</td>
                        @if (count($pilihan)>1)
                            @foreach ($pilihan as $ii)                            
                            <td class="text-center" style="font-weight:bold">
                                @php
                                    if (isset($eval[$v->id]))
                                    {
                                        if($eval[$v->id]->pilihan==$ii)
                                        {
                                            $check='checked="checked"';
                                        }
                                        else
                                            $check='';

                                    }    
                                    else
                                    {
                                        $check='';
                                    }
                                @endphp
                                <div style="height:35px;font-size:10px;">{{str_replace('__','/',$ii)}}</div>
                                <input type="radio" name="pilihan[{{$v->id}}]" value="{{$ii}}" {{$check}}>
                            </td>
                            @endforeach
                        @else
                            <td class="text-center" colspan="5"></td>
                        @endif                        
                        <td class="text-center" style="font-size:10px;font-weight:bold">
                            @if (count($pilihan)>1)
                                @php
                                if (isset($eval[$v->id]))
                                {
                                    $saran=$eval[$v->id]->saran;
                                }
                                else {
                                    $saran='';
                                }
                                @endphp
                                <textarea name="saran[{{$v->id}}]" style="height:35px" class="form-control">{{$saran}}</textarea>
                            @endif
                        </td>
                    </tr>
                    @if (isset($item[$v->id]))
                        @php
                            $x='a';
                        @endphp
                        @foreach ($item[$v->id] as $it)
                        <tr>
                            @php
                                $pilihan=explode('/',$it->pilihan);
                            @endphp

                            <td class="text-right" style="font-size:10px;">{{$x}}</td>
                            <td class="text-left" style="font-size:10px;">{{$it->indikator}}</td>
                            @if (count($pilihan)>1)
                                @foreach ($pilihan as $ii)                            
                                <td class="text-center">
                                    @php
                                    if (isset($eval[$it->id]))
                                    {
                                        if($eval[$it->id]->pilihan==$ii)
                                        {
                                            $check='checked="checked"';
                                        }
                                        else
                                            $check='';
                                    }    
                                    else
                                    {
                                        $check='';
                                    }
                                    @endphp

                                    <div style="height:35px;font-size:10px;">{{str_replace('__','/',$ii)}}</div>
                                    <input type="radio" name="pilihan[{{$it->id}}]" value="{{$ii}}" {{$check}}>
                                </td>
                                @endforeach
                            @else
                                <td class="text-center" colspan="5"></td>
                            @endif                        
                            <td class="text-center" style="font-size:10px;">
                                @if (count($pilihan)>1)
                                    @php
                                    if (isset($eval[$it->id]))
                                    {
                                        $saran=$eval[$it->id]->saran;
                                    }
                                    else {
                                        $saran='';
                                    }
                                    @endphp
                                    <textarea name="saran[{{$it->id}}]" style="height:35px" class="form-control">{{$saran}}</textarea>
                                @endif
                            </td>
                            @php
                                $x++;
                            @endphp
                        </tr>
                        @endforeach
                    @endif
                @php
                    $no++;
                @endphp
                @endforeach
                
            
        </tbody>
    </table>
    @if (count($eval)==0)
        <button class="btn btn-md btn-success pull-right" type="button" onclick="endevaluasipenyelenggara('{{ucwords($jenis)}}','{{$idfasil}}')"><i class="fa fa-save"></i> &nbsp;&nbsp;Simpan Evaluasi</button>
    @endif
</form>