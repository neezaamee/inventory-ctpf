<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wardi Godown | CTPF</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <!-- AdminLTE API -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    
    <style>
        .welcome-page {
            align-items: center;
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: center;
        }
        .welcome-box {
            width: 100%;
            max-width: 500px;
            padding: 15px;
        }
        .hero-icon {
            font-size: 5rem;
            color: #0d6efd;
        }
    </style>
</head>
<body class="welcome-page">
<div class="welcome-box text-center">
    
    <div class="mb-4">
        <i class="bi bi-shield-check hero-icon"></i>
    </div>
    
    <h1 class="display-5 fw-bold text-dark mb-2">Wardi Godown</h1>
    <h3 class="text-secondary fw-normal mb-4">City Traffic Police Faisalabad</h3>
    <p class="lead text-muted mb-5">
        Secure Inventory Management System for official uniforms, hardware, and seasonal items distribution.
    </p>

    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-4 gap-3">Return to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">Secure Login</a>
            @endauth
        @endif
    </div>

</div>

<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
