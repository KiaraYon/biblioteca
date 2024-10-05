@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-lg-4 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">{{ __('Registrar') }}</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">{{ __('Nombre') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <small>&copy; 2024 Sistema biblioteca Sanarate</small>
            </div>
        </div>
    </div>

    <!-- Estilos en el mismo archivo -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Asegura que el contenedor ocupe todo el alto de la pantalla */
        }

        .card {
            border-radius: 10px;
            border: none;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-radius: 20px;
            border: none;
        }

        /* Ajustes para pantallas más grandes */
        @media (min-width: 1200px) {
            .col-lg-4 {
                max-width: 600px; /* Limitar el ancho en pantallas grandes */
            }
        }
    </style>
@endsection
