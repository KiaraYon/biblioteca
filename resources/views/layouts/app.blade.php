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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        /* General */
        body {
            background-color: #f4f4f4;
            font-family: 'Nunito', sans-serif;
            margin: 0;
        }

        /* Barra Superior */
        .topbar {
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar .nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .topbar .nav-item {
            margin-left: 20px;
        }

        .topbar .nav-link {
            text-decoration: none;
            color: #555;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .topbar .nav-link:hover {
            color: #007bff;
        }

        /* Sidebar */
        .sidebar {
            background-color: #fff;
            width: 240px; /* Ajuste de tamaño del sidebar */
            height: 100vh;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 60px;
            left: -240px; /* Oculto inicialmente */
            transition: left 0.3s ease;
            overflow-y: auto;
            z-index: 1040;
        }

        .sidebar.open {
            left: 0; /* Mostrar sidebar */
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .menu li {
            margin-bottom: 10px; /* Reducir espacio entre botones */
        }

        .sidebar .menu a {
            display: flex;
            align-items: center;
            padding: 8px 12px; /* Reducir tamaño de los botones */
            font-size: 14px; /* Reducir tamaño de texto */
            color: #555;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar .menu a:hover {
            background-color: #f0f4ff;
            color: #007bff;
        }

        .sidebar .menu a .icon {
            width: 40px; /* Reducir tamaño del ícono */
            height: 40px; /* Reducir tamaño del ícono */
            background-color: #eef3f9;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px; /* Ajuste para íconos más pequeños */
            margin-right: 10px; /* Espaciado más pequeño */
            font-size: 18px; /* Reducir tamaño de ícono */
            color: #555;
        }

        .sidebar .menu a:hover .icon {
            background-color: #dce9ff;
            color: #007bff;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 0;
            margin-top: 60px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: 240px; /* Ajuste según el nuevo ancho del sidebar */
        }

        .toggle-sidebar {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .menu a.active {
            font-weight: bold; /* Texto en negrita */
            background-color: #dce9ff;
            color: #007bff;
        }

        .menu a.active .icon {

            background-color: #dce9ff;
            color: #007bff;
        }

        /* Estilos Responsivos */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%; /* Sidebar ocupa toda la pantalla */
                left: -100%; /* Oculto inicialmente */
            }

            .sidebar.open {
                left: 0; /* Mostrar sidebar */
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.shifted {
                margin-left: 0; /* Sin margen en pantallas pequeñas */
            }

        }
    </style>
</head>
<body>
<div id="app">
    <!-- Barra superior -->
    <div class="topbar rounded-3">
        @if(Auth::check())
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
        @endif

        <ul class="nav">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            {{ __('Editar Perfil') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>

    @if(Auth::check())
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ asset('images/logo2.jpeg') }}" alt="Logo">
                    <h5>Biblioteca Municipal</h5>
                </a>
            </div>
            <ul class="menu">
                @if(Auth::user()->hasPermission('ver-estudiantes'))
                    <li>
                        <a href="{{ route('estudiantes.index') }}"
                           class="{{ Route::is('estudiantes.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-people-fill"></i></span> Estudiantes
                        </a>
                    </li>
                @endif

                @if(Auth::user()->hasPermission('ver-prestamos'))
                    <li>
                        <a href="{{ route('prestamos.index') }}" class="{{ Route::is('prestamos.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-person-vcard-fill"></i></span> Préstamos
                        </a>
                    </li>
                @endif

                @if(Auth::user()->hasPermission('ver-libros'))
                    <li>
                        <a href="{{ route('libros.index') }}" class="{{ Route::is('libros.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-book-fill"></i></span> Libros
                        </a>
                    </li>
                @endif

                @if(Auth::user()->hasPermission('ver-autores'))
                    <li>
                        <a href="{{ route('autors.index') }}" class="{{ Route::is('autors.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-person-lines-fill"></i></span> Autor
                        </a>
                    </li>
                @endif

                    @if(Auth::user()->hasPermission('ver-roles'))
                    <li>
                        <a href="{{ route('roles.index') }}"
                           class="{{ Route::is('roles.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-list-task"></i></span> Roles
                        </a>
                    </li>
                    @endif

                @if(Auth::user()->hasPermission('ver-editoriales'))
                    <li>
                        <a href="{{ route('editoriales.index') }}"
                           class="{{ Route::is('editoriales.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-building-fill"></i></span> Editoriales
                        </a>
                    </li>
                @endif

                @if(Auth::user()->hasPermission('ver-materias'))
                    <li>
                        <a href="{{ route('materia.index') }}" class="{{ Route::is('materia.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-collection-fill"></i></span> Materias
                        </a>
                    </li>
                @endif

                @if(Auth::user()->hasPermission('ver-usuarios'))
                    <li>
                        <a href="{{ route('users.index') }}" class="{{ Route::is('users.*') ? 'active' : '' }}">
                            <span class="icon"><i class="bi bi-people-fill"></i></span> Usuarios
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    @endif

    <!-- Contenido Principal -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const menuLinks = document.querySelectorAll('.sidebar .menu a');

        var dropdownToggle = document.getElementById('navbarDropdown');
        if (dropdownToggle) {
            dropdownToggle.addEventListener('click', function (event) {
                event.preventDefault();
                var dropdownMenu = this.nextElementSibling;
                if (dropdownMenu) {
                    dropdownMenu.classList.toggle('show');
                }
            });
        }

        // Restaurar el estado del sidebar desde localStorage
        if (localStorage.getItem('sidebarOpen') === 'true' && window.innerWidth > 768) {
            sidebar.classList.add('open');
            mainContent.classList.add('shifted');
        }

        // Manejar clic en el botón de alternar
        if (toggleButton) {
            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('open');
                mainContent.classList.toggle('shifted');
                // Guardar el estado en localStorage solo para pantallas grandes
                if (window.innerWidth > 768) {
                    localStorage.setItem('sidebarOpen', sidebar.classList.contains('open'));
                }
            });
        }

        // Cerrar el sidebar automáticamente en pantallas pequeñas al hacer clic en un enlace
        menuLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('open');
                    mainContent.classList.remove('shifted');
                }
            });
        });

        // Escuchar cambios en el tamaño de la ventana
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                // Restaurar el estado del sidebar en pantallas grandes
                if (localStorage.getItem('sidebarOpen') === 'true') {
                    sidebar.classList.add('open');
                    mainContent.classList.add('shifted');
                }
            } else {
                // Ocultar el sidebar automáticamente en pantallas pequeñas
                sidebar.classList.remove('open');
                mainContent.classList.remove('shifted');
            }
        });
    });


</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

