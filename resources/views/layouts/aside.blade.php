
<aside class="left-sidebar">
<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
             {{-- <li class="user-pro"> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle">{{auth()->user()->name}}</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul> 
            </li> --}}
            {{-- <li class="nav-small-cap">--- PERSONAL</li> --}}
            <li> <a class="waves-effect waves-dark {{ request()->routeIs('home.*') ? 'active' : '' }}" href="{{route('home')}}"  aria-expanded="false"><i class="fas fa-home"></i><span class="hide-menu">Home</span></a></li>
            <li> <a class="waves-effect waves-dark {{ request()->routeIs('usuarios.*') ? 'active' : '' }}" href="{{route('usuarios.index')}}" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu">Usuarios</span></a></li>
            <li> <a class="waves-effect waves-dark {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{route('clientes.index')}}" aria-expanded="false"><i class="fas fa-building"></i><span class="hide-menu">Clientes</span></a></li>
            <li> <a class="waves-effect waves-dark {{ request()->routeIs('asterisk.*') ? 'active' : '' }}" href="{{route('asterisk.index')}}" aria-expanded="false"><i class="fas fa-hdd"></i><span class="hide-menu"> Serv. Asterisk</span></a></li>
            <li> <a class="waves-effect waves-dark {{ request()->routeIs('cuentas.*') ? 'active' : '' }}" href="{{route('cuentas.index')}}" aria-expanded="false"><i class="fas fa-list"></i><span class="hide-menu"> Cuentas</span></a></li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
