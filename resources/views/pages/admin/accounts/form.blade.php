<form action="{{(!empty($data))?route('admin.accounts.admin.update', $data->id):route('admin.accounts.admin.store')}}" method="post" class="form-submit" enctype="multipart/form-data">
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
                <label for="">Email</label>
                <input type="email" name="email" id="email" value="{{ (!empty($data))?$data->email:null }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">{{ (!empty($data))?"Ubah ":null }}Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>
        <div class="panel-footer container-fluid">
            <button type="submit" class="btn btn-success btn-submit pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
        </div>
    </div>
</form>