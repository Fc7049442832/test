<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Company</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="container">
    {{-- header section --}}
    <div class="row justify-content-center bg-primary">
        <div class="col-md-10 col-12">
        <nav class="navbar ">
            <div class="container-fluid">
               <a class="navbar-brand" href="{{route('index')}}">
                <h1><img src="{{asset('images/logo.png')}}" alt="" srcset=""> 
                  @if(Auth::check())
                  Dashboard
                  @else
                  Company
                  @endif
                </h1>
                </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <h4 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="{{route('index')}}">Home</a>
                    </li>
                    
                    @if(Auth::check())
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('companies.index')}}">Companies</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('employees.index')}}">Employees</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('logout')}}">Logout</a>
                      </li>

                    @else
                      {{-- <li class="nav-item">
                        <a class="nav-link" href="{{route('showForm')}}">Register</a>
                      </li> --}}
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('showLoginForm')}}">Login</a>
                      </li>
                    @endif                    
                  </ul>
                 
                </div>
              </div>
            </div>
          </nav>
        </div>
    </div>
    {{-- Hero Content section --}}
    <section class="main">
       @yield('content')
    </section>
    {{-- footer --}}
    <div class="row footer justify-content-center">
      <div class="col-12 text-center">
        <strong>Laravel Developer Hiring Test Solution 2024</strong>
      </div>
    </div>

</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
