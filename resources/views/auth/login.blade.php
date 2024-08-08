@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12" style="margin-right:auto;margin-left:auto">
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            @error('email')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <x-jet-validation-errors class="mb-4" />
            </div>
            @enderror

            @error('password')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <x-jet-validation-errors class="mb-4" />
            </div>
            @enderror

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card-group mb-0">
                            <div class="card p-0">
                                <div class="card-body">
                                <img src="{{ asset('img/LogoHorizontalWEB.png') }}" alt="" style="width:70%">
                                <br>

                                    <!-- <p class="text-muted">SisGe-Gasquil - Gestion de Estaciones</p> -->
                                    <div class="input-group mb-3">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input type="email" name="email" id="email" class="form-control" :value="old('email')" required autofocus placeholder="Correo Electrónico">
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-addon"><i class="icon-lock"></i></span>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary px-4">Acceder</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">Olvidaste tu password?</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="block mt-4">
                                        <label for="remember_me" class="flex items-center">
                                            <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
            {{-- <a href="{{ route('auth.register')   }}" class="ml-4 text-sm text-gray-700 underline">Register</a> --}}
        </div>
    </div>
</div>
@endsection
