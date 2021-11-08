<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Cuba - Premium Admin Template</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }} ">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login.jpg') }}" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
            <div>
              <div><a class="logo text-start" href="index.html"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.png') }}" alt="looginpage"></a></div>
              <div class="login-main"> 
                <form class="theme-form" action="{{ route('check') }}" method="post">
                  
                  @csrf
                  <h4>Đăng nhập</h4>
                  <p>Nhập địa chỉ email và mật khẩu để đăng nhập</p>
                  @if (Session::get('fail'))
                      <div class="alert alert-danger">{{Session::get('fail')}}</div>
                  @endif
                  <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input class="form-control" type="email" required="" name="email" placeholder="qlgd@hnue.edu.vn" value="{{ old('email') }}">
                    <span class="text-danger">@error('email')
                        {{$message}}
                    @enderror</span>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Mật khẩu</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="*********" value="{{ old('password') }}">
                    </div>
                    <span class="text-danger">@error('password')
                      {{$message}}
                  @enderror</span>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox" checked>
                      <label class="text-muted" for="checkbox1">Nhớ mật khẩu</label>
                    </div>
                    <button class="btn btn-primary btn-block w-100" type="submit">Đăng nhập</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
      <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
      <!-- feather icon js-->
      <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
      <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="{{ asset('assets/js/config.js') }}"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{ asset('assets/js/script.js') }}"></script>
      <!-- login js-->
      <!-- Plugin used-->
    </div>
  </body>
</html>