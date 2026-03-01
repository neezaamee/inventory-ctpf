<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Inventory CTPF</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <!-- AdminLTE API -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    
    <style>
        .login-page {
            align-items: center;
            background-color: #e9ecef;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: center;
        }
        .login-box {
            width: 400px;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</head>
<body class="login-page">
<div class="login-box">
  <div class="login-logo text-center mb-3">
    <a href="/" class="h1 text-decoration-none text-dark fw-bold"><b>Wardi</b> Godown</a>
    <div class="h5 mt-2 text-muted">City Traffic Police Faisalabad</div>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary shadow-sm">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-center mb-4 text-muted">Sign in to start your session</p>

      <!-- Session Status -->
      @if (session('status'))
          <div class="alert alert-success mb-4 text-sm text-center">
              {{ session('status') }}
          </div>
      @endif

      <form action="{{ route('login') }}" method="post">
        @csrf
        
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="username">
          <div class="input-group-text">
            <span class="bi bi-envelope"></span>
          </div>
          @error('email')
             <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="input-group mb-4">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
          <div class="input-group-text">
            <span class="bi bi-lock-fill"></span>
          </div>
          @error('password')
             <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="row align-items-center">
          <div class="col-8">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
              <label class="form-check-label" for="remember_me">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary d-block w-100">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="mt-4 text-center">
        @if (Route::has('password.request'))
            <p class="mb-1">
                <a href="{{ route('password.request') }}" class="text-decoration-none">I forgot my password</a>
            </p>
        @endif
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
</body>
</html>
