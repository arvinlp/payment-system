<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route(getPrefixُTheme() . 'profile') }}">
                    <i data-feather="user"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.logout') }}">
                    <i data-feather="log-out"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
