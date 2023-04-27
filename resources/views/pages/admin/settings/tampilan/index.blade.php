<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-eye"></i> Tampilan</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-angle-down"></i>
            </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-photo"></i> Header (Homepage)</h3>
                </div>
                <div class="panel-body">
                    <div class="row container-fluid">
                        <a href="{{route('admin.settings.tampilan.addSlide')}}" class="btn btn-success btn-xs" id="btn_add_slide"><i class="fa fa-plus"></i> Tambah Slide</a>
                    </div>
                    @if(count($dataSlides) > 0)
                    @for($i=0; $i < count($dataSlides) ;$i++)
                    <div class="form-group panel panel-default slide-upload">
                        <div class="panel-heading">
                            <h3 class="panel-title">Slide {{$i+1}}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-6">
                                <form action="{{route('admin.settings.tampilan.saveSlide', $dataSlides[$i]->id)}}" method="post" class="formSaveSlide" title="Slide {{$i+1}}" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="title" class="form-control" value="{{$dataSlides[$i]->title}}" placeholder="Masukkan Judul">
                                    </div>
                                    <div class="form-group">
                                        <label for="file_upload">New Image Upload: </label>
                                        <input type="file" name="imgSlide" class="form-control imgSlide">
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="gambar">Gambar: </label>
                                @if($dataSlides[$i]->path != null)
                                <img src="{{Storage::url($dataSlides[$i]->path)}}" alt="{{$dataSlides[$i]->title}}" class="img-responsive">
                                @else
                                <div class="alert alert-warning"><i class="fa fa-info-circle"></i> Gambar belum diupload</div>
                                @endif
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="javascript:void(o)" class="btn btn-danger btn-flat btn_delete" data-url="{{route('admin.settings.tampilan.deleteSlide', $dataSlides[$i]->id)}}" title="Slide {{$i+1}}"><i class="fa fa-trash"></i> Hapus</a>
                            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>
                            </form>
                        </div>
                    </div>
                    @endfor
                    @else
                    <div class="alert alert-warning">
                        <h3 class="panel-title">Silahkan tambah data slide !</h3>
                    </div>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i> Konten (About Us)</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('admin.settings.tampilan.about_us.konten.store')}}" method="post" id="formStoreContentAboutUs" title="Konten (About Us)">
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" name="title" class="form-control" value="{{!empty($aboutUsKonten)?$aboutUsKonten->title:env('APP_NAME')}}">
                        </div>
                        <div class="form-group">
                            <label for="">Konten</label>
                            <textarea id="input-content" name="description">{{!empty($aboutUsKonten)?$aboutUsKonten->content:null}}</textarea>
                        </div>
                    
                </div>
                <div class="panel-footer">
                    <div class="container-fluid">
                        <a href="{{route('guest.about_us.index')}}" target="_blank" class="btn btn-info btn-flat pull-left"><i class="fa fa-eye"></i> Lihat Perubahan</a>
                        <button type="submit" class="btn btn-success btn-flat pull-right"><i class="fa fa-save"></i> Save</button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default" id="ourClients-panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i> Our Clients (Homepage & About Us)</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('admin.settings.tampilan.ourClients.store')}}" method="post" id="formStoreOurClient" title="Our Client (Homepage & About Us)" data-formtype="store" enctype="multipart/form-data">
                        <div class="container-fluid">
                            <div class="row panel panel-default panel-body">
                                <div class="form-group col-sm-6">
                                    <label for="">Nama Client</label>
                                    <input type="text" name="nama_client" class="form-control" value="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Upload Gambar:</label>
                                    <input type="file" name="imgClient" id="imgClient" class="form-control">
                                </div>
                                <div class="container-fluid btnGroup">
                                    {{--<a href="{{route('guest.about_us.index')}}" target="_blank" class="btn btn-info btn-flat pull-left"><i class="fa fa-eye"></i> Lihat Perubahan</a>--}}
                                    <button type="submit" class="btn btn-success btn-flat pull-right btn-submit-form-ourclient"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <button class="btn btn-info" id="btnRefreshDataOurClient"><i class="glyphicon glyphicon-refresh"></i> Refresh Data</button>
                        <table class="table table-bordered table-hover" style="width: 100%!important;" id="datatables-ourClients">
                            <thead class="bg-black">
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Client</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot class="bg-black">
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Client</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>