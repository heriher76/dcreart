<form action="{{(!empty($data))?route('admin.category.update', $data->id):route('admin.category.store')}}" method="post" class="form-submit" enctype="multipart/form-data">
    @if(!empty($data))
    @method('PUT')
    @endif
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="alert alert-warning fade in hide" id="alert-validation">
                <b>Warning :</b>
                <ul></ul>
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" value="{{!empty($data)?$data->name:null}}">
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea class="form-control" name="description">{{ (!empty($data))?$data->description:null }}</textarea>
            </div>
        </div>
        <div class="panel-footer container-fluid">
            <button type="submit" class="btn btn-success btn-submit pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
        </div>
    </div>
</form>