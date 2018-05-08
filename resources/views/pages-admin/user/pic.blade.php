<div class="col-md-12">
    <label>Tugas PIC</label>
    <select name="users__pic" class="form-control" data-placeholder="PIC">
        <option value="0"></option>
        @if ($id!=-1)
            <option value="1" {{$det->pic=='1' ? 'selected="selected"' : ''}}>Ya</option>
            <option value="0" {{$det->pic=='0' ? 'selected="selected"' : ''}}>Tidak</option>
        @else
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
        @endif
    </select>
</div>