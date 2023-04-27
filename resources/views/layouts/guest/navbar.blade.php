<section data-bs-version="5.1" class="menu menu2 cid-tqwOnHtJaq" once="menu" id="menu2-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="{{url('/')}}">
                        <img src="{{asset('/')}}assets/images/logo-dcreartdesign.png" alt="" style="height: 4.7rem;">
                    </a>
                </span>
                
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="{{route('guest.home')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="{{route('guest.project.index')}}">Projects</a></li>
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="{{route('guest.post.index')}}">Posts</a>
                    </li>
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="{{route('guest.contact.index')}}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="{{route('guest.about_us.index')}}">About Us</a></li>
                    @if(Auth::guard('admin')->check())
                    <li class="nav-item dropdown"><a class="nav-link link text-white dropdown-toggle display-4" href="https://mobiri.se" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span>Admin</a><div class="dropdown-menu" aria-labelledby="dropdown-756"><a class="text-white dropdown-item display-4" href="{{route('admin.post.index')}}">Admin Page</a>
                    <form action="{{route('admin.auth.logout')}}" method="post">
                    @csrf
                    <button class="text-white dropdown-item display-4 btn-block">Logout</button>
                    </form></div></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</section>