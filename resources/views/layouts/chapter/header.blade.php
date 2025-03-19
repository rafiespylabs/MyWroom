<div class="main-header">
    <div class="main-header-logo">
    <div class="logo-header" data-background-color="dark">
        <a href="{{route('chapter.dashboard')}}" class="logo">
        <img src="{{asset('admin1/assets/img/logo/veekshanam.jpg')}}" alt="navbar brand" class="navbar-brand" height="20" />
        </a>
        <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
        </button>
        </div>
        <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
        </button>
    </div>
    </div>
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <!-- <div class="input-group">
                <div class="input-group-prepend">
                <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control" />
            </div> -->
        </nav>
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li>
                <button class="btn btn-primary btn-border btn-round">
                    <i class="fa fa-star"></i> {{Session::get('selected_chapter_name')}}
                </button>
            </li>
        <li class="nav-item topbar-user dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm">
                <img src="{{asset('admin1/assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle" />
            </div>
            <span class="profile-username">
                <span class="op-7">Hi,</span>
                <span class="fw-bold">{{auth()->user()->name}} </span>
            </span>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                    <div class="user-box">
                        <div class="avatar-lg">
                        <img src="{{asset('admin1/assets/img/profile.jpg')}}" alt="image profile" class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                        <h4>{{auth()->user()->name}}</h4>
                        <p class="text-muted">{{auth()->user()->email}}</p>
                        <a href="{{route('getChapter')}}">Change Chapter</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
            </div>
            </ul>
        </li>
        </ul>
    </div>
    </nav>
</div>