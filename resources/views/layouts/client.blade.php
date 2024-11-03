<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jendela Literasi') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/assets/css/main.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
      <header id="header" class="header d-flex align-items-center shadow-sm">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center text-decoration-none">
                <h1 class="sitename mb-0 ms-2"><span style="color:#388da8;font-size:35px;">J</span>endela Literasi</h1>
            </a>
    
            <nav class="navbar navbar-expand-md navbar-light bg-white">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenuContent"
                        aria-controls="navmenuContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navmenuContent">
                        <ul class="navbar-nav me-auto mt-2">
                            <li class="nav-item">
                                <a href="/" class="nav-link px-3">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('client.test') }}" class="nav-link px-3">Test</a>
                            </li>
                        </ul>
    
                        <ul class="navbar-nav ms-auto">
                            @auth
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}" class="nav-link px-3"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard.index') }}" class="nav-link px-3">{{ auth()->user()->name }}</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
    
                <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </nav>
        </div>
    </header>
    


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
