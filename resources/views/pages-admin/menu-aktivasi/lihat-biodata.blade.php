<form id="add-user" class="form-horizontal">
<div class="row" style="margin-top:10px;" id="upload">
    <div class="col-md-6" >
            
            <div class="row">
                <div class="col-md-12">
                    <label>Nama</label>
                    <input type="text" readonly="readonly" class="form-control" placeholder="Nama" name="profile__name" value="{{$id!=-1 ? $profile->name : ''}}">
                </div>
                <div class="col-md-6">
                    <label>Tempat Lahir</label>
                    <input type="text" readonly="readonly" class="form-control" placeholder="Tempat Lahir" name="profile__place_of_birth" value="{{$id!=-1 ? $profile->place_of_birth : ''}}">
                </div>
                <div class="col-md-6">
                    <label>Tanggal Lahir</label>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker1'>
                            <input readonly="readonly" type="text" class="form-control" placeholder="Tanggal Lahir" name="profile__date_of_birth" value="{{$id!=-1 ? date('d/m/Y',strtotime($profile->date_of_birth)) : ''}}">
                            <span class="input-group-addon btn btn-primary">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label>NPWP</label>
                    <input type="text" readonly="readonly" class="form-control" name="profile__npwp" placeholder="NPWP" id="npwp" value="{{$id!=-1 ? $profile->npwp : ''}}">
                </div>
                <div class="col-md-12">
                    <label>NIP</label>
                    <input type="text" readonly="readonly" class="form-control" name="profile__nip" placeholder="NIP" id="nip" value="{{$id!=-1 ? $profile->nip : ''}}">
                </div>
                <div class="col-md-6">
                    <label>Pangkat </label>
                    <input type="text" readonly="readonly" class="form-control" name="profile__pangkat" placeholder="Pangkat" id="pangkat" value="{{$id!=-1 ? $profile->pangkat : ''}}"> 
                </div>
                <div class="col-md-6">
                    <label>Golongan </label>
                    <input type="text" readonly="readonly" class="form-control " name="profile__golongan" placeholder="Golongan" id="golongan" value="{{$id!=-1 ? $profile->golongan : ''}}">

                </div>
                <div class="col-md-12">
                    <label>Bidang Studi </label>
                    <input type="text" readonly="readonly" class="form-control " name="profile__bidang_studi" placeholder="Bidang Studi" id="bidang_studi" value="{{$id!=-1 ? $profile->bidang_studi : ''}}">
                </div>
                <div class="col-md-12">
                    <label>Nama Unit Kerja </label>
                    <input type="text" readonly="readonly" class="form-control " name="profile__nama_unit_kerja" placeholder="Nama Unit Kerja" id="nama_unit_kerja" value="{{$id!=-1 ? $profile->nama_unit_kerja : ''}}">
                </div>
                <div class="col-md-12">
                    <label>Pendidikan Terakhir </label>
                    <input type="text" readonly="readonly" class="form-control " name="profile__educational_level" placeholder="Pendidikan Terakhir" id="educational_level" value="{{$id!=-1 ? $profile->educational_level : ''}}">
                </div>
                
            </div>
        </div><!-- // row -->
        <div class="col-md-6" >
            <div class="row">
                <div class="col-md-12">
                    <label>Alamat Unit Kerja</label>
                    <textarea readonly="readonly" class="form-control" rows="4"  placeholder="Alamat" name="profile__alamat_unit_kerja">{{$id!=-1 ? $profile->alamat_unit_kerja : ''}}</textarea>
                </div>
                
                <div class="col-md-12">
                    <label>Nomor Telp</label>
                    <input type="text" readonly="readonly" class="form-control" placeholder="Nomor Telp/HP" name="profile__telepon_unit_kerja" value="{{$id!=-1 ? $profile->telepon_unit_kerja : ''}}">
                </div>
                <div class="col-md-12">
                    <label>Nomor FAX</label>
                    <input type="text" readonly="readonly" class="form-control" placeholder="Nomor FAX" name="profile__fax_unit_kerja" value="{{$id!=-1 ? $profile->fax_unit_kerja : ''}}">
                </div>

                
                
               <div class="col-md-12">
                    <label>Alamat Rumah</label>
                    <textarea readonly="readonly" class="form-control" rows="4"  placeholder="Alamat" name="profile__address">{{$id!=-1 ? $profile->address : ''}}</textarea>
                </div>
                <div class="col-md-12">
                    <label>Nomor Telp/HP</label>
                    <input type="text" readonly="readonly" class="form-control" placeholder="Nomor Telp/HP" name="profile__phone_number" value="{{$id!=-1 ? $profile->phone_number : ''}}">
                </div>
                <div class="col-md-12">
                    <label>Email</label>
                    <input type="email" readonly="readonly" class="form-control" name="users__email" placeholder="Email" id="email" value="{{$id!=-1 ? $user->email : ''}}">
                </div>

              
        </div>
    </div>
</form> 
<style>
    .table td,
    .table th
    {
        font-size:13px !important;
    }
    .chosen-container
    {
        width:100% !important;
    }
    input,textarea
    {
        border:1px solid #eee !important;
    }
</style>