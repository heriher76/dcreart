<form action="{{(!empty($data))?route('admin.post.update', $data->slug):route('admin.post.store')}}" method="post" class="form-submit" enctype="multipart/form-data">
    @if(!empty($data))
    @method('PUT')
    @endif
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" name="title" class="form-control" value="{{!empty($data)?$data->title:null}}">
            </div>
            <div class="form-group">
                <label for="">Konten</label>
                <textarea class="input-content" name="description">{{ (!empty($data))?$data->description:null }}</textarea>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control multiple" multiple="multiple" data-placeholder="{{count($categorys)>0?'Pilih Kategori':'Tidak ada data'}}" style="width: 100%;" name="category[]">
                @if(!empty($data))
                  @foreach($data->detail_posts as $dp)
                    @foreach($categorys as $category)
                        <option value="{{$category->id}}" {{($dp->category_id == $category->id?"selected":null)}}>{{$category->name}}</option>
                    @endforeach
                  @endforeach
                  @if(empty($dp))
                  <option disabled>Pilih Kategori</option>
                  @foreach($categorys as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  @endif
                @else
                <option disabled>Pilih Kategori</option>
                  @foreach($categorys as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                @endif
                </select>
            </div>
            <div class="form-group">
                <label for="">{{!empty($data->path_thumbnail)?"Ganti Thumbnail":"Thumbnail"}}</label>
                <input type="file" name="path_thumbnail" id="uploadFile" class="form-control">
            </div>
            @if(!empty($data->path_thumbnail))
            <div class="form-group">
                <label for="">Thumbnail</label>
                <div>
                    <a href="{{Storage::url($data->path_thumbnail)}}" class="btn btn-primary"><i class="glyphicon glyphicon-picture"></i> Lihat gambar</a>
                </div>
            </div>
            @endif
            @if(!empty($data))
            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{!empty($data)?$data->slug:null}}" readonly>
            </div>
            @endif
        </div>
        <div class="panel-footer container-fluid">
            <div class="row">
                <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="btn btn-flat btn-info">
                                <input type="checkbox" name="publish" class="minimal" @if(!empty($data) && $data->published) checked @endif> Publish 
                            </label>
                        </div>
                        <div class="col-lg-7">
                        @if(!empty($data) && $data->published)
                        <label for="">Publish: </label>
                        <p>{{Carbon\Carbon::parse($data->published_at)->format('l, d/m/Y H:i:s')}}</p>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <button type="submit" class="btn btn-success btn-submit col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>