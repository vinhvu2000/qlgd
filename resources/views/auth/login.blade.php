@extends('layouts.authentication.master')
@section('title', 'Đăng nhập')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/login.jpg')}}" alt="looginpage"></div>
      <div class="col-xl-5 p-0">
         <div class="login-card">
            <div>
               <div class="login-main">
                  <form class="theme-form" action="{{ route('login') }}" method="POST">
                     @csrf
                     <div>
                        <a class="logo text-start" href="{{ route('login') }}">
                           <img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt="looginpage">
                        </a>
                     </div>
                      @if (Session::get('error'))
                        <div class="alert alert-danger">
                              {{Session::get('error')}}
                        </div>
                     @endif
                     @error('error')
                        <div class="alert alert-danger">
                           <strong>{{ $message }}</strong>
                        </div>                         
                     @enderror
                     <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror"  type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                        @error('password')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <div class="form-group mb-0">
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                           <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                       </div>
                        <button class="btn btn-primary btn-block" type="submit">Đăng nhập</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection