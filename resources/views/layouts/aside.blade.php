        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
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