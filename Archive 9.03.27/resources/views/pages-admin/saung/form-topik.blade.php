<div id="modal_besar" class="modal fade">
	<div class="modal-dialog modal-lg">
        <form class="form-horizontal" id="form-topik-turunan" method="POST" action="{{$idtopik==-1 ? URL::to('topik-turunan') : URL::to('topik-turunan/'.$idtopik) }}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title-lg"></h5>
                </div>

			    <div class="modal-body">
				
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="slug" value="{{ $video->slug }}">
                    <input type="hidden" name="video_id" value="{{ $video->id }}">
                    <input type="hidden" name="saung_id" value="{{ $idsaung }}">
                    @if ($idtopik!=-1)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <label>Topik Turunan</label>
                            <input type="text" class="form-control " name="topik" placeholder="Topik Turunan" id="topik" value="{{$idtopik!=-1 ? $det->topik : ''}}">
                        </div>
                        <div class="col-md-12">
                            <label>Pertanyaan</label>
                                <textarea class="form-control"  placeholder="Penjelasan" name="penjelasan" id="penjelasan">{{($idtopik!=-1 ? $det->penjelasan : '')}}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label>Aktif</label>
                            <select name="flag" class="form-control" data-placeholder="Aktif">
                                @if ($idtopik==-1)
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                @else
                                    <option value="1" {{ $idtopik==1 ? 'selected="selected"' : '' }}>Aktif</option>
                                    <option value="0" {{ $idtopik==0 ? 'selected="selected"' : '' }}>Non Aktif</option>
                                @endif
                                
                            </select>
                        </div>

                        </div>
                    </div>
                    
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
                    <button type="button" class="btn btn-success" id="ok-lg"><i class="fa fa-save"></i>&nbsp;OK</button>
                </div>
            </form>
		</div>
	</div>
</div>
