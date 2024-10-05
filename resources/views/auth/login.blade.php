@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-lg-4 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">{{ __('Inicia Sesión') }}</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email">{{ __('Usuario') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Ingresa') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-2">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <small>&copy; 2024 Sistema biblioteca Sanarate</small>
            </div>
        </div>
    </div>


    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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


        @media (min-width: 1200px) {
            .col-lg-4 {
                max-width: 600px;
            }
        }
    </style>
@endsection
