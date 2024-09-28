<nav class="navbar navbar-expand-lg navbar-dark " style="background: #25476A">
  <div class="container">
    <a class="navbar-brand" href="/" style="font-size:24px">
      <img src="{{ asset('storage/images/logo.png') }}" style="height:48px;border-radius:8px;margin-right:10px;" alt="" srcset="">
     DALAPA
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
 
  
      <ul class="navbar-nav ms-auto">
 
        @auth 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome back, {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
           </li>
          </ul>
        </li>
        @else
 
        <li class="nav-item">
          <a class="nav-link {{ Request::is('login') ? 'active' : 'text-light' }}" href="/login">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
          </a>
        </li>
 
        @endauth
      </ul>
      

    </div>
  </div>
</nav>