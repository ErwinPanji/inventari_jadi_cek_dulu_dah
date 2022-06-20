@extends('layouts.auth')

@section('login')
<div class="login-box">
    <div class="login-logo">
      <a href="{{ url('/') }}">
        <img src="{{asset('img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image elevation-3" style=" height: 70px;">
      </a><br>
      <b>SMKN 4 JAKARTA</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="login-logo">
            
        </div>
        
        <form action="{{ route('login') }}" method="post" id="loginForm">
        @csrf
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
                <span class="invalid-feedback is-invalid">Username tidak terdaftar atau Password Salah</span>
            @enderror
            
          </div>
          <div class="input-group mb-3">
            {{-- invalid-feedback @error('password') is-invalid @enderror --}}
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
                <span class="invalid-feedback is-invalid">Username tidak terdaftar atau Password Salah</span>
            @enderror
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
    
@endsection
