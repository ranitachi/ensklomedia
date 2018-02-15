 @foreach ($category as $i => $v)
    <div class="col-md-6">
        <div class="chanel-item">
            <div class="row">
                <div class="col-md-3">
                    <div class="chanel-thumb">
                        <a href="#"><img src="{{asset('assets/img/category-icon-24234.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="chanel-info" style="margin-top:-5px;">
                        <span class="subscribers">436,414 subscribers</span>
                        <a class="title" href="#">{{$v->category}}</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <a href="javascript:hapus('{{$v->id}}')" style="text-transform:capitalize !important;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="pull-right">
                        <a href="javascript:loadform('{{$v->id}}')" style="text-transform:capitalize !important;" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                        <a href="#" style="text-transform:capitalize !important;" class="btn btn-xs btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach