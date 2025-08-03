@extends('layouts.auth')

@section('title', 'Connexion')
@section('description', 'Connexion à l\'espace administrateur d\'Act for Communities')

@section('page-title', 'Connexion')
@section('page-subtitle', 'Accédez à votre espace administrateur')

@section('content')
    <!-- Session Status -->
    @if (session('status'))
        <div class="status-message status-success">
            <i class="fas fa-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email Field -->
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Adresse email') }}</label>
            <div class="input-container">
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <input id="email"
                       class="form-input @error('email') border-red-500 @enderror"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="{{ __('votre@email.com') }}">
            </div>
            @error('email')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
            <div class="input-container">
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <input id="password"
                       class="form-input @error('password') border-red-500 @enderror"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="{{ __('••••••••') }}">
                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group-checkbox">
            <label for="remember_me" class="checkbox-label">
                <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                <div class="checkbox-custom">
                    <i class="fas fa-check"></i>
                </div>
                <span class="checkbox-text">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn-auth btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                {{ __('Se connecter') }}
            </button>
        </div>

        <!-- Forgot Password Link -->
        @if (Route::has('password.request'))
        <div class="text-center mt-4">
            <a class="auth-link" href="{{ route('password.request') }}">
                <i class="fas fa-key"></i>
                {{ __('Mot de passe oublié ?') }}
            </a>
        </div>
        @endif
    </form>

    <!-- Register Link -->
    @if (Route::has('register'))
    <!--div class="auth-divider">
        <span>{{ __('Nouveau sur la plateforme ?') }}</span>
    </div-->

    <!--div class="text-center">
        <a href="{{ route('register') }}" class="btn-auth btn-secondary">
            <i class="fas fa-user-plus"></i>
            {{ __('Créer un compte') }}
        </a>
    </div-->
    @endif
@endsection
