  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('home') }}" class="brand-link">
          <img src="/images/admin_images/project.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">Test</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="/images/admin_images/man.png" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="" class="d-block">{{ ucfirst(Auth::user()->name) }}</a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">

              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  @if(Auth::user()->role == 'customer')
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active">
                        <i class="fas fa-star"></i>
                          <p>
                              Points
                          </p>
                          <span class="badge badge-pill badge-danger ml-1" id="points">{{Auth::user()->points ? Auth::user()->points->points : 0}}</span>
                      </a>
                  </li>
                  @endif
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ Auth::user()->role == 'admin' ? route('home.admin') : route('home') }}"
                          class="nav-link">
                          <i class="fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  @if(Auth::user()->role == 'customer')
                  <li class="nav-item">
                      <a href="{{ route('fetch.order') }}" class="nav-link">
                          <i class="fas fa-shopping-bag"></i>
                          <p>
                              Order
                          </p>
                      </a>
                  </li>
                  @endif
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
