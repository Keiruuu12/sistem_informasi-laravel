<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Informasi Project</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<!-- NAVBAR -->
<nav id="main-navbar" class="navbar navbar-expand-lg mt-4">
    <div class="container pb-3">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="d-none">Sistem Informasi Project</span>
            <h1 class="h3">Sistem Informasi</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item ">
                    <a class="nav-link px-4" href="{{ route('jurusans.index') }}">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4" href="{{ route('dosens.index') }}">Dosen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4" href="{{ route('mahasiswas.index') }}">Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4" href="{{ route('matakuliahs.index') }}">MataKuliah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4" href="{{ url('/pencarian') }}">Search</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link px-4" href="{{ route('login') }}">
                            {{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle px-4" href="#" role="button"
                            data-bs-toggle="dropdown" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item px-4" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-3" style="min-height:550px">
    <div class="row">
        <div class="col-12">
            @yield('content')
        </div>
    </div>
</div>

    @include('sweetalert::alert')
</body>

</html>
