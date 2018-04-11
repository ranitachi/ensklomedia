@if ($idsaung!=-1)
    @if (Auth::user()->id == $saung->created_user_id || Auth::user()->id == $saung->reviewer_id)
        <div class="row">
            <div class="col-md-5">
                <div id="data"></div>
            </div>
            <div class="col-md-7">
                <div id="form"></div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div id="data"></div>
            </div>
            <div class="col-md-4">
                <div id="info"></div>
            </div>
        </div>   
    @endif
@else    
    <div class="row">
        <div class="col-md-12"><h1>Halaman Latihan Tidak Dapat Diakses</h1></div>
    </div>
@endif