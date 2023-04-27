<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box box-default" id="settings-account">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user"></i> Akun</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-angle-down"></i>
                </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-user"></i> Data Akun</h3>
                            </div>
                            <div class="panel-body">
                                <form action="{{route('admin.settings.updateDataAccount')}}" method="post" id="form-update-data-account">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" value="{{Auth::guard('admin')->user()->name}}" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" name="email" id="email" value="{{Auth::guard('admin')->user()->email}}" class="form-control" required>
                                    </div>
                            </div>
                            <div class="panel-footer">
                                <div class="container-fluid">
                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-lock"></i> Ubah Password</h3>
                            </div>
                            <div class="panel-body">
                                <form action="{{route('admin.settings.changePassword')}}" method="post" id="form-change-password">
                                    @csrf
                                    <div class="form-group">
                                        <label for="old_password">Password Lama</label>
                                        <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Masukkan Password Lama Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">Password Baru</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Masukkan Password Baru Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Konfirmasi Password Baru</label>
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Masukkan Konfirmasi Password Baru Anda" required>
                                    </div>
                            </div>
                            <div class="panel-footer">
                                <div class="container-fluid">
                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.box-body -->
        </div>
    </div>