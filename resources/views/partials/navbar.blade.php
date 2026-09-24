<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Menu Sidebar -->
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>

    </ul>

    <!-- Right navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">

                <i class="fas fa-user mr-1"></i>

                @if(Auth::check())
    {{ Auth::user()->name }}
@else
    Guest
@endif

            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <span class="dropdown-item dropdown-header">

                    Login sebagai

                    <strong>{{ ucfirst(Auth::user()->role) }}</strong>

                </span>

                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit" class="dropdown-item">

                        <i class="fas fa-sign-out-alt mr-2"></i>

                        Logout

                    </button>

                </form>

            </div>

        </li>

    </ul>

</nav>