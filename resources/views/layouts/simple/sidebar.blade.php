<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/light-mode.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/dark-mode.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Quay lại</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span class="lan-3">Trang chủ</span>
						</a>
					</li>
					@if (Auth::user()->role != "user")
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{Route::currentRouteName() == 'admin.room' ? 'active' : '' }}" href="{{ route('admin.room') }}">
							<i data-feather="box"></i><span>Quản lí phòng học</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{Route::currentRouteName() == 'admin.device' ? 'active' : '' }}" href="{{ route('admin.device') }}">
							<i data-feather="monitor"></i><span>Quản lí thiết bị</span>
						</a>
					</li>
						@if (Auth::user()->role == "superadmin")
						<li class="sidebar-list">
							<a class="sidebar-link sidebar-title {{Route::currentRouteName() == 'admin.user' ? 'active' : '' }}" href="{{ route('admin.user') }}">
								<i data-feather="users"></i><span>Quản lí người dùng</span>
							</a>
						</li>
						@endif
					@else
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{Route::currentRouteName() == 'admin.room' ? 'active' : '' }}" href="{{ route('admin.room') }}">
							<i data-feather="box"></i><span>Mượn phòng học</span>
						</a>
					</li>
					@endif
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{Route::currentRouteName() == 'admin.chat' ? 'active' : '' }}" href="{{ route('admin.chat') }}">
							<i data-feather="message-circle"></i><span>Hộp thư</span>
						</a>
					</li>
					 <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.support' ? 'active' : '' }}" href="{{ route('admin.support') }}"><i data-feather="help-circle"> </i><span>Hỗ trợ</span></a></li>
					 <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}"><i data-feather="settings"> </i><span>Cài đặt</span></a></li>
					 <li class="sidebar-list">
						 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					  </form>
					  <a class="sidebar-link sidebar-title link-nav" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-in"></i><span>Đăng xuất</span></a>
				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>