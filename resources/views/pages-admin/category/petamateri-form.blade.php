<form class="form-horizontal" id="form-petamateri">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	
    <div class="row">
        <div class="col-md-12">
            <label>Kategori</label>
            <input type="text" class="form-control" placeholder="Judul Kategori" name="category" value="{{(count($cat)!=0 ? $cat->name : '')}}" readonly>
            <input type="hidden" class="form-control" placeholder="Judul Kategori" name="category_id" value="{{(count($cat)!=0 ? $cat->id : '')}}" readonly>
        </div>
        <div class="col-md-12">
            <label>Mata Pelajaran</label>
            <input type="text" class="form-control" placeholder="Mata Pelajaran" name="title" value="{{($id!=-1 ? $petamateri->title : '')}}">
        </div>
        <div class="col-md-12">
            <label>Deskripsi</label>
                 <textarea class="form-control" rows="4"  placeholder="Deskripsi" name="desc">{{($id!=-1 ? $petamateri->desc : '')}}</textarea>
        </div>
     </form>