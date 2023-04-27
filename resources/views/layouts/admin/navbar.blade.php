<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo bg-black">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{asset('/')}}assets/images/logo-dcreartdesign.png" width="40px"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg text-md"><img src="{{asset('/')}}assets/images/logo-dcreartdesign.png" width="40px"><b> {{explode(' ', trim( env('APP_NAME') ))[0]}}</b> {{explode(' ', trim( env('APP_NAME') ))[1]}}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top bg-black">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
         {{--<li class="dropdown notifications-menu">
                              <a href="{{route('getPemesan')}}" class="dropdown-toggle" data-toggle="dropdown" id="btnNotifications">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-danger">*</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                  <!-- inner menu: contains the actual data -->
                                  <ul class="menu" id="notifications">
                                    
                                  </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                              </ul>
                            </li>--}}
          <!-- Control Sidebar Toggle Button -->
          {{--<li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                              </li>--}}
        </ul>
      </div>
    </nav>
  </header>