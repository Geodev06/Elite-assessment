  <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
          <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="sidebarMenuLabel">Elite Sofware</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto" style="min-height: 100vh;">
              <ul class="nav flex-column">
                  <li class="nav-item">
                      <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
                          <i class="bx bx-home"></i>
                          Dashboard
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('crew/*') ? 'active' : '' }}" href="{{ route('crew.create') }}">
                          <i class="bx bx-plus"></i>
                          Add Crews
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link d-flex align-items-center gap-2" href="{{ route('logout') }}">
                          <i class="bx bx-log-out"></i>
                          logout
                      </a>
                  </li>

              </ul>
          </div>
      </div>
  </div>