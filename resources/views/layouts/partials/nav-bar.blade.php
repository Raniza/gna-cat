<nav class="navbar navbar-expand-lg bg-primary py-0 sticky-top navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GNA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('tools*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catalogue
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item fs-8 disabled" href="#">Tools</a></li>
                        <li><a class="dropdown-item" href="#">Tools Catalogue</a></li>
                        <li><a class="dropdown-item" href="{{ route('tools.master.index') }}">Tools Master</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item fs-8 disabled" href="#">Jigs</a></li>
                        <li><a class="dropdown-item disabled" href="#">Jigs Catalogue</a></li>
                        <li><a class="dropdown-item disabled" href="#">Jigs Master</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item fs-8 disabled" href="#">Measurings</a></li>
                        <li><a class="dropdown-item disabled" href="#">Measurings Catalogue</a></li>
                        <li><a class="dropdown-item disabled" href="#">Measurings Master</a></li>
                    </ul>
                </li>
                @if (Auth::user()->isAdmin)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin Menu
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">User</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('admin.department') ? 'active' : '' }}" href="{{ route('admin.department') }}">Department & Section</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('admin.model.index') ? 'active' : '' }}" href="{{ route('admin.model.index') }}">Master Part</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('admin.process.index') ? 'active' : '' }}" href="{{ route('admin.process.index') }}">Master Process</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('admin.part-process.index') ? 'active' : '' }}" href="{{ route('admin.part-process.index') }}">Part Structure</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="d-flex justify-content-end me-2">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userProfileModal">User Information</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changeUserPassModal">Change Pass</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <form action="{{ route('logout') }}" method="GET">
                            @csrf
                            <li><input type="submit" class="dropdown-item fw-bolder" value="Logout"></li>
                        </form>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>