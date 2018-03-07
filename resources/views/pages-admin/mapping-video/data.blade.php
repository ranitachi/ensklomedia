<table class="table table-bordered table-hover table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Kontributor</th>
                                    <th>Aktifasi Oleh</th>
                                    <th>Tanggal Aktifasi</th>
                                    <th>Reviewer</th>
                                    <th style="width:80px;">Aksi</th>
                                </tr>             
                            </thead>
                            <tbody>
                                @foreach ($videos as $key => $item)
                                    <tr>
                                        <td>{{ $key = $key+1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><span class="label label-primary">{{ $item->category->name }}</span></td>
                                        <td>{!!(!isset($item->user->profile->name)) ? '<span class="label label-warning">n/a</span>' : '<span class="label label-success"><i class="fa fa-user"></i>&nbsp;'.$item->user->profile->name.'</span>'!!}</td>
                                        <td>
                                            {{ (!isset($item->activated->profile->name)) ? 'n/a' : $item->activated->profile->name }}
                                        </td>
                                        <td>{{ $item->flag_active }}</td>
                                        <td>
                                            {!!(!isset($item->reviewer->profile->name)) ? '<span class="label label-warning">n/a</span>' : '<span class="label label-info"><i class="fa fa-user"></i>&nbsp;'.$item->reviewer->profile->name.'</span>'!!}
                                        </td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-target="#modalConfirm" data-value="{{ $item->id }}" class="btn btn-xs btn-primary simpan"><i class="fa fa-edit text-white"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>