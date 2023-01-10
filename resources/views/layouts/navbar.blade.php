<!-- ============================================================== -->
<!-- toggle and nav items -->
<!-- ============================================================== -->
<ul class="navbar-nav me-auto">
  <!-- This is  -->
  <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
  <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
</ul>
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
          <!-- text-->
          <a href="{{route('perfil.show')}}" class="dropdown-item"><i class="ti-user"></i>Perfil</a>
          <div class="dropdown-divider"></div>
          <!-- text-->
          <a href="{{route('signout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> Salir</a>
          <!-- text-->
      </div>
  </li>
  <!-- ============================================================== -->
  <!-- End User Profile -->
  <!-- ============================================================== -->
  {{-- <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li> --}}
</ul>
