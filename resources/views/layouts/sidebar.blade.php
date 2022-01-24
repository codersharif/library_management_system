<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
        <a href="{{route('dashboard')}}" class="brand-link">
        <!-- <img src="{{ asset('public/img/logo.png') }}" alt="MMS" class="brand-image img-circle elevation-3"
             style="opacity: .8"> -->
             <span class="brand-text font-weight-light">Library Management System</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('public/img/defaut.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('dashboard')}}" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div> -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link">
                            <!-- <i class="nav-icon fas fa-tachometer-alt blue"></i> -->
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <!-- <li class="nav-item {{Helper::menuOpen(Request::path())}}"> -->
                        <!-- <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog yellow"></i>
                            <p>
                                Management
                                <i class="right fas fa-angle-left purple"></i>
                            </p>
                        </a> -->
                        <!-- <ul class="nav nav-treeview"> -->
                             <li class="nav-item">
                                <a href="{{URL::to('userGroup')}}" class="nav-link {{Helper::currentPath('userGroup')}}">
                                    <!-- <i class="fas fa-users nav-icon"></i> -->
                                    <p>Manage User Group</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('users')}}" class="nav-link {{Helper::currentPath('users')}}">
                                    <!-- <i class="fas fa-users nav-icon"></i> -->
                                    <p>Manage User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('student')}}" class="nav-link {{Helper::currentPath('student')}}">
                                    <!-- <i class="fas fa-rocket"></i> -->
                                    <p>Manage Student</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('bookshelf')}}" class="nav-link {{Helper::currentPath('bookshelf')}}">
                                    <!-- <i class="fas fa-rocket"></i> -->

                                    <p>Manage Bookshelf</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('book')}}" class="nav-link {{Helper::currentPath('book')}}">
                                    <!-- <i class="fas fa-rocket"></i> -->

                                    <p>Manage Book</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('bookIssue')}}" class="nav-link {{Helper::currentPath('bookIssue')}}">
                                    <!-- <i class="fas fa-rocket"></i> -->

                                    <p>Manage Book Issue & Return</p>
                                </a>
                            </li>
                        <!-- </ul> -->
                    <!-- </li> -->
                    <!-- <li class="nav-item">
                    <router-link to="/profile" class="nav-link">
                        <i class="nav-icon fas fa-user purple"></i>
                        <p>
                            Profile
                        </p>
                    </router-link>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <!-- <i class="nav-icon fas fa-power-off red"></i> -->
                            <p>
                                {{ __('Logout') }}

                            </p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>
