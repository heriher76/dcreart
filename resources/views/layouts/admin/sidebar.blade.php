<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/')}}/assets/AdminLTE/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p id="admin_name">{{Str::limit(Auth::guard('admin')->user()->name, 13, '...')}}</p>
          <a href="#" id="admin_email" title="{{Auth::guard('admin')->user()->email}}">{{Str::limit(Auth::guard('admin')->user()->email, 30, '...')}}</a>
        </div>
      </div>
      <!-- search form -->
      {{--<form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="q" class="form-control" placeholder="Search...">
                          <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                          </span>
                    </div>
                  </form>--}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <li><a href="{{route('admin.post.index')}}"><i class="fa fa-edit"></i> <span>Posts</span></a></li>
        <li><a href="{{route('admin.project.index')}}"><i class="fa fa-edit"></i> <span>Projects</span></a></li>
        <li><a href="{{route('admin.category.index')}}"><i class="fa fa-edit"></i> <span>Categorys</span></a></li>
        <li><a href="{{route('admin.accounts.index')}}"><i class="fa fa-users"></i> <span>Accounts</span></a></li>
        <li><a href="{{route('admin.settings.index')}}"><i class="fa fa-cogs"></i> <span>Settings</span></a></li>
        <li class="header">Account</li>
        <li><a href="{{route('admin.settings.index')}}#settings-account"><i class="fa fa-user"></i> <span>Account</span></a></li>
        <li>
        <form action="{{route('admin.auth.logout')}}" method="post" class="container-fluid">
          @csrf
          <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-sign-out"></i> <span>Logout</span></button>  
        </form>
        </li>
        <li class="treeview">
          {{-- <a href="#">
            <i class="fa fa-table"></i> <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.admin.index')}}"><i class="fa fa-user"></i> Admin</a></li>
            <li><a href="{{route('admin.pemesan.index')}}"><i class="fa fa-users"></i> Booking</a></li>
          </ul>
        </li>
        <li><a href="{{route('admin.sesi.index')}}"><i class="fa fa-clock-o"></i> <span>Sesi</span></a></li> --}}
        {{--<li><a href="" onclick="redirect('{{route('admin.settings.index')}}')"><i class="fa fa-gears"></i> <span>Pengaturan</span></a></li>--}}
        {{-- <li><a href="{{route('admin.logout')}}" id="btn-logout"><i class="fa fa-sign-out text-danger"></i> <span>Sign-out</span></a></li> --}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>