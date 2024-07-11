<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Biblioteca</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo2.jpeg') }}" type="image/png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <h4>Biblioteca Municipal</h4>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <!-- Columna fija para las tarjetas -->
                @auth
                <div class="col-md-2 sidebar">
                    <div class="scrollable-div overflow-auto" style="height: 100vh;">
                        <div class="card mt-2 d-flex flex-column justify-content-center align-items-center py-2 card-hover">
                            <h5 class="card-title"><i class="bi bi-people-fill"></i> Estudiantes</h5>
                            <a href="{{ route('estudiantes.index') }}" class="stretched-link"></a>
                        </div>

                        <div class="card mt-2 d-flex flex-column justify-content-center align-items-center py-2 bg-secondary-subtle card-hover">
                            <h5 class="card-title"><i class="bi bi-person-vcard-fill"></i> Prestamos</h5>
                            <a href="{{ route('prestamos.index') }}" class="stretched-link"></a>
                        </div>

                        <div class="card mt-2 d-flex flex-column justify-content-center align-items-center py-2 bg-secondary-subtle card-hover">
                            <h5 class="card-title"><i class="bi bi-book-fill"></i> Libros</h5>
                            <a href="{{ route('libros.index') }}" class="stretched-link"></a>
                        </div>

                        <div class="card mt-2 d-flex flex-column justify-content-center align-items-center py-2 bg-secondary-subtle card-hover">
                            <h5 class="card-title"><i class="bi bi-person-lines-fill"></i> Autor</h5>
                            <a href="{{ route('autors.index') }}" class="stretched-link"></a>
                        </div>

                        <div class="card mt-2 d-flex flex-column justify-content-center align-items-center py-2 bg-secondary-subtle card-hover">
                            <h5 class="card-title"><i class="bi bi-list-task"></i> Detalle Permiso</h5>
                            <a href="{{ route('detalle-permisos.index') }}" class="stretched-link"></a>
                        </div>

                        <div class="card mt-2 d-flex flex-column justify-content-center align-items-center py-2 bg-secondary-subtle card-hover">
                            <h5 class="card-title"><i class="bi bi-building-fill"></i> Editoriales</h5>
                            <a href="{{ route('editoriales.index') }}" class="stretched-link"></a>
                        </div>

                        <div class="card mt-2 d-flex flex-column justify-content-center align-items-center py-2 bg-secondary-subtle card-hover">
                            <h5 class="card-title"><i class="bi bi-collection-fill"></i> Materias</h5>
                            <a href="{{ route('materia.index') }}" class="stretched-link"></a>
                        </div>
                        <!-- Agrega la imagen aquí -->
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="img-fluid mt-10 ms-0">
                    </div>
                </div>
                @endauth
                <!-- Columna principal para el contenido -->
                <main class="col-md-10 py-4">
                @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dropdownToggle = document.getElementById('navbarDropdown');
            if (dropdownToggle) {
                dropdownToggle.addEventListener('click', function (event) {
                    event.preventDefault();
                    var dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu) {
                        if (dropdownMenu.classList.contains('show')) {
                            dropdownMenu.classList.remove('show');
                        } else {
                            dropdownMenu.classList.add('show');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
