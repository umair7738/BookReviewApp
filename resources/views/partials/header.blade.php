<header>
    <div class="container d-flex justify-content-between align-items-center py-3">
        <!-- Logo on the left -->
        <div class="logo">
            <a href="{{ url('/') }}">
                {{-- <img src="{{ asset('path/to/logo.png') }}" alt="Logo" class="logo-img" style="max-width: 150px;"> --}}
            Logo
            </a>
        </div>

        <!-- Login/Register buttons on the right -->
        <div class="auth-links">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            @else
                <span class="text-muted">Welcome, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" class="btn btn-danger ms-2"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</header>
