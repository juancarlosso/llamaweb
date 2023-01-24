        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
          <nav class="navbar top-navbar navbar-expand-md navbar-dark">
              <!-- ============================================================== -->
              <!-- Logo -->
              <!-- ============================================================== -->
              <div class="navbar-header">
                  <a class="navbar-brand" href="{{route('home')}}">
                      <!-- Logo icon --><b>
                          <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                          <!-- Dark Logo icon -->
                          <img src="{{asset('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                          <!-- Light Logo icon -->
                          <img src="{{asset('assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                      </b>
                      <!--End Logo icon -->
                      <!-- Logo text --><span>
                      <!-- dark Logo text -->
                      <img src="{{asset('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                      <!-- Light Logo text -->
                      <img src="{{asset('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /></span>
              </div>
              <!-- ============================================================== -->
              <!-- End Logo -->
              <!-- ============================================================== -->
              <div class="navbar-collapse">
                  <!-- ============================================================== -->
                  <!-- toggle and nav items -->
                  <!-- ============================================================== -->
                  <ul class="navbar-nav me-auto">
                      <!-- This is  -->
                      <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                      <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                  </ul>
                  <!-- ============================================================== -->
                  <!-- User profile and search -->
                  <!-- ============================================================== -->
                  <ul class="navbar-nav my-lg-0">

                      <!-- ============================================================== -->
                      <!-- User Profile -->
                      <!-- ============================================================== -->
                      <li class="nav-item dropdown u-pro">
                          <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img src="{{asset('assets/images/users/1.jpg')}}" alt="user" class=""> 
                              <span class="hidden-md-down">{{auth()->user()->name}} &nbsp;
                                <i class="fa fa-angle-down"></i>
                              </span> 
                            </a>
                          <div class="dropdown-menu dropdown-menu-end animated flipInY">
                              <a href="{{route('perfil.show')}}" class="dropdown-item"><i class="ti-user"></i>Perfil</a>
                              <div class="dropdown-divider"></div>
                              <!-- text-->
                              {{-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-password"></i> Cambiar Contraseña</a>
                             <!-- text--> --}}
                              <a href="{{route('signout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> Salir</a>
                              <!-- text-->
                          </div>
                      </li>
                      <!-- ============================================================== -->
                      <!-- End User Profile -->
                      <!-- ============================================================== -->    
                  </ul>
              </div>
          </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->