<nav id="sidebar" class="bg-dark navbar-dark">
    <a href="/" class="nav-link text-white">
        <h2 class="p-2">
            <i class="fa-solid fa-square-rss"></i> Boolfolio
        </h2>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white {{Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}" href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{Route::currentRouteName() == 'admin.projects.index' ? 'active' : ''}}" href="{{route('admin.projects.index')}}">Projects</a>
        </li>
    </ul>
</nav>