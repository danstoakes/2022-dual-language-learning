<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Dual Language Learning</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('dist/main.js') }}" defer></script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body> <!-- class='dark' -->
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">Dual Language Learning</a>
                <button class="navbar-dark navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Request::is('home'))
                                @if(Gate::check("user-list") || Gate::check("role-list") || Gate::check("permission-list") || Gate::check("language-list"))
                                    <li><a class="nav-link text-white" href="{{ route('portal') }}">Portal</a></li>
                                @else
                                    <li><a class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
                                @endif
                            @elseif (Request::is('admin-portal'))
                                <li><a class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
                            @else
                                @if(Gate::check("user-list") || Gate::check("role-list") || Gate::check("permission-list") || Gate::check("language-list"))
                                    <li><a class="nav-link text-white" href="{{ route('portal') }}">Portal</a></li>
                                @else
                                    <li><a class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
                                @endif
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <small class="dropdown-item form-text text-black dropdown-label">Manage Account</small>
                                    {{-- <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Profile') }}
                                    </a> --}}
                                    <a class="dropdown-item text-primary dropdown-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pt-4 mb-6">
            @yield('content')
        </main>
        <footer class="navbar footer fixed-bottom bg-white shadow">
            <div class="container">
                <span class="text-muted">© {{ date("Y") }} Dan Stoakes. All rights reserved.</span>
            </div>
        </footer>
    </div>
</body>
</html>
