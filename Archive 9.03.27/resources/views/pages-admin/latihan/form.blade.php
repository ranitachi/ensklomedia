<form class="form-horizontal" id="form-latihan-test">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	
        <h4>Pertanyaan</h4>
        <textarea class="form-control"  placeholder="Pertanyaan" name="pertanyaan" id="pertanyaan">{{($id!=-1 ? $question : '')}}</textarea>
        <h4>Jawaban Benar</h4>
        <textarea class="form-control"  placeholder="Jawaban" name="jawaban[1]" id="jawaban1">{{($id!=-1 ? $det[0]->answer : '')}}</textarea>
        <h4>Jawaban Lainnya</h4>
        <textarea class="form-control"  placeholder="Jawaban" name="jawaban[2]" id="jawaban2">{{($id!=-1 ? $det[1]->answer : '')}}</textarea>
        <h4>Jawaban Lainnya</h4>
        <textarea class="form-control"  placeholder="Jawaban" name="jawaban[3]" id="jawaban3">{{($id!=-1 ? $det[2]->answer : '')}}</textarea>
        <h4>Jawaban Lainnya</h4>
        <textarea class="form-control"  placeholder="Jawaban" name="jawaban[4]" id="jawaban4">{{($id!=-1 ? $det[3]->answer : '')}}</textarea>
        <div class="row">

            <div class="col-md-6 text-right" style="padding-top:10px;">&nbsp;</div>
            <div class="col-md-6 text-right" style="padding-top:10px;">
                <button type="button" class="btn btn-sm btn-primary pull-right" onclick="simpantest({{$id}},{{$idsaung}})"><i class="fa fa-save"></i>&nbsp;Simpan Latihan</i></button>
            </div>
    </div>
</form>