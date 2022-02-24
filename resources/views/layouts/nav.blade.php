<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
<div class="container">
    <a class="navbar-brand" href="{{ !Auth::check() || Auth::user()->isAdmin == 1 ? url('/admin') : url('/gpro') }}">
        {{-- {{ config('app.name', 'Laravel') }} --}}
        Production System
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @auth
        <ul class="navbar-nav me-auto">
            <li class="mx-2"><a href="{{ Auth::user()->isAdmin == 1 ? route('admin.home') : route('gpro.home') }}">{{ __('Home') }}</a></li>
            @if (Auth::user()->isAdmin)
                <li class="mx-2"><a href="{{ route('admin.user') }}">{{ __('Manage Users') }}</a></li>
                <li class="mx-2"><a href="{{ route('admin.styles') }}">{{ __('Manage Styles') }}</a></li>
                <li class="mx-2"><a href="{{ route('admin.group') }}">{{ __('Manage Group') }}</a></li>
            @endif
        </ul>
        @endauth
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @auth
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endauth
        </ul>
    </div>
</div>
</nav>