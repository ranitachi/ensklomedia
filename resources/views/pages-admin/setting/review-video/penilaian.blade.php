@php
    if(count($pn)!=0)
    {
        echo '<h2 class="text-center">Total Penilaian : '.array_sum($pn).'</h2>';
    }
@endphp
<form class="form-horizontal" method="POST" action="{{url('simpan-penilaian',$video->id)}}">
    <input type="hidden" name="reviewer_id" value="{{Auth::user()->id}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table class="table table-bordered table-hover table-striped" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Pernyataan</th>
                <th class="text-center">1</th>
                <th class="text-center">2</th>
                <th class="text-center">3</th>
                <th class="text-center">4</th>
                <th class="text-center">5</th>
            </tr>             
        </thead>
        <tbody>
        @foreach ($instrumen as $idx=>$item)
            <tr>
                <td class="text-center">{{++$idx}}</td>
                <td class="text-left">{{$item->pertanyaan}}</td>
                @php
                    $nilai=($item->bobot / 5);
                @endphp
                @for ($i = 1; $i <= 5; $i++)
                    @php
                        $nl=($i*$nilai);
                        if(isset($pn[$item->id]))
                        {
                            // if($pn[$item->id]==$nl)
                            // {
                            if (abs(($pn[$item->id]-$nl)/$nl) < 0.00001) {
                                $checked='checked';
                            }
                            else 
                            {
                                $checked='';
                            }
                        }
                        else 
                        {
                            $checked='';
                        }
                        
                    @endphp
                    <td class="text-center">
                        <input type="radio" name="nilai[{{$item->id}}]" value="{{$nl}}" {{$checked}}>
                    </td>
                @endfor
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right">
        <button type="submit" id="nilai_save" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan Penilaian</button>
    </div>
</form>