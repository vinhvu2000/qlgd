<div class="page-header">
  <div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
      <div class="mb-3 w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Tìm kiếm .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Đang tìm kiếm...</span></div>
            <i class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper"><a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt=""></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
      <ul class="horizontal-menu">
      </ul>
    </div>
    <div class="nav-right col-8 pull-right right-header p-0">
      <ul class="nav-menus">
        <li>                         <span class="header-search"><i data-feather="search"></i></span></li>
        <li class="onhover-dropdown">
          <div class="notification-box"><i data-feather="bell"> </i><span class="badge rounded-pill badge-secondary">4                                </span></div>
          <ul class="notification-dropdown onhover-show-div">
            <li>
              <i data-feather="bell"></i>
              <h6 class="f-18 mb-0">Thông báo</h6>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-primary"> </i>Delivery processing <span class="pull-right">10 min.</span></p>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-danger"></i>Delivery Complete<span class="pull-right">6 hr</span></p>
            </li>
            <li><a class="btn btn-primary" href="#">Đánh dấu tất cả là đã đọc</a></li>
          </ul>
        </li>
        <li>
          <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>
        <li class="onhover-dropdown">
          <i data-feather="message-square"></i>
          <ul class="chat-dropdown onhover-show-div">
            <li>
              <i data-feather="message-square"></i>
              <h6 class="f-18 mb-0">Hộp thư</h6>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/1.jpg')}}" alt="">
                <div class="status-circle online"></div>
                <div class="media-body">
                  <span>Erica Hughes</span>
                  <p>Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12 font-success">58 mins ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/2.jpg')}}" alt="">
                <div class="status-circle online"></div>
                <div class="media-body">
                  <span>Kori Thomas</span>
                  <p>Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12 font-success">1 hr ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/4.jpg')}}" alt="">
                <div class="status-circle offline"></div>
                <div class="media-body">
                  <span>Ain Chavez</span>
                  <p>Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12 font-danger">32 mins ago</p>
              </div>
            </li>
            <li class="text-center"> <a class="btn btn-primary" href="#">Xem tất cả</a></li>
          </ul>
        </li>
        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="profile-nav onhover-dropdown p-0 me-0">
          <div class="media profile-media">
            <img class="b-r-10" src="{{asset('assets/images/dashboard/profile.jpg')}}" alt="">
            <div class="media-body">
              <span>Quản trị hệ thống</span>
              <p class="mb-0 font-roboto">Super Admin <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li><a href="#"><i data-feather="user"></i><span>Tài khoản</span></a></li>
            <li><a href="#"><i data-feather="mail"></i><span>Hộp thư</span></a></li>
            {{-- <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li> --}}
            <li><a href="#"><i data-feather="settings"></i><span>Cài đặt</span></a></li>
            <li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-in"></i><span>Đăng xuất</span></a>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">                        
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">@{{name}}</div>
      </div>
      </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Tìm kiếm của bạn cho ra 0 kết quả. Điều này rất có thể có nghĩa là chương trình phụ trợ đã ngừng hoạt động!</div></script>
  </div>
</div>
