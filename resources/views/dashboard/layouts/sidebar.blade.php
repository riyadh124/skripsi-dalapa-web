<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary min-vh-100">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Rydhdev - DALAPA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active' : 'text-dark' }}" aria-current="page" href="/dashboard">
                <i class="bi bi-house-door-fill"></i> 
                Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/workorder*') ? 'active' : 'text-dark' }}" href="/dashboard/workorder">
                <i class="bi bi-layout-text-sidebar-reverse"></i> 
                Workorders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/material*') ? 'active' : 'text-dark' }}" href="/dashboard/material">
                <i class="bi bi-box"></i> 
                Materials
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/user*') ? 'active' : 'text-dark' }}" href="/dashboard/user">
                <i class="bi bi-person"></i> 
                Users
            </a>
          </li>
        </ul>

        {{-- <hr class="my-3">

        <ul class="nav flex-column mb-auto">
          <li class="nav-item">
              <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="nav-link d-flex align-items-center gap-2 text-danger">
                    <i class="bi bi-box-arrow-right" style="color: red"></i> Logout
                  </button>
                </form>
          </li>
        </ul> --}}
      </div>
    </div>
  </div>