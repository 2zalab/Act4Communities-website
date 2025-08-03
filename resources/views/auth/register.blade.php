@extends('layouts.auth')

@section('title', 'Inscription')
@section('description', 'Créez votre compte administrateur Act for Communities')

@section('page-title', 'Inscription')
@section('page-subtitle', 'Créez votre compte administrateur')

@section('content')
    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <!-- Name Field -->
        <div class="form-group">
            <label for="name" class="form-label">{{ __('Nom complet') }}</label>
            <div class="input-container">
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                </div>
                <input id="name"
                       class="form-input @error('name') border-red-500 @enderror"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       placeholder="{{ __('Votre nom et prénom') }}">
            </div>
            @error('name')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

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
                       autocomplete="new-password"
                       placeholder="{{ __('Minimum 8 caractères') }}">
                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="input-error">{{ $message }}</div>
            @enderror
            <div class="password-strength mt-2" id="passwordStrength" style="display: none;">
                <div class="strength-bar">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
                <small class="strength-text" id="strengthText"></small>
            </div>
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
            <div class="input-container">
                <div class="input-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <input id="password_confirmation"
                       class="form-input @error('password_confirmation') border-red-500 @enderror"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="{{ __('Confirmer votre mot de passe') }}">
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation')
                <div class="input-error">{{ $message }}</div>
            @enderror
            <div class="password-match mt-2" id="passwordMatch" style="display: none;">
                <small class="match-text" id="matchText"></small>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="form-group-checkbox">
            <label for="terms" class="checkbox-label">
                <input id="terms" type="checkbox" class="checkbox-input" name="terms" required>
                <div class="checkbox-custom">
                    <i class="fas fa-check"></i>
                </div>
                <span class="checkbox-text">
                    {{ __('J\'accepte les') }}
                    <a href="#" class="auth-link" onclick="showTermsModal()">{{ __('conditions d\'utilisation') }}</a>
                    {{ __('et la') }}
                    <a href="#" class="auth-link" onclick="showPrivacyModal()">{{ __('politique de confidentialité') }}</a>
                </span>
            </label>
            @error('terms')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn-auth btn-primary" id="registerBtn">
                <i class="fas fa-user-plus"></i>
                {{ __('Créer mon compte') }}
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-4">
            <a class="auth-link" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i>
                {{ __('Déjà inscrit ? Se connecter') }}
            </a>
        </div>
    </form>
@endsection

@push('styles')
<style>
/* Styles spécifiques à l'inscription */
.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    width: 100%;
    height: 4px;
    background: var(--border-color);
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-fill {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-weak {
    background: var(--error-color);
    width: 25%;
}

.strength-fair {
    background: var(--warning-color);
    width: 50%;
}

.strength-good {
    background: var(--info-color);
    width: 75%;
}

.strength-strong {
    background: var(--success-color);
    width: 100%;
}

.strength-text {
    font-size: 0.8rem;
    font-weight: 500;
}

.password-match {
    margin-top: 0.5rem;
}

.match-text {
    font-size: 0.8rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.match-success {
    color: var(--success-color);
}

.match-error {
    color: var(--error-color);
}

.checkbox-text a {
    text-decoration: underline;
    font-weight: 600;
}

/* Animation pour les champs qui apparaissent */
.form-group {
    animation: slideInUp 0.6s ease-out;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
.form-group-checkbox { animation-delay: 0.5s; }

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const strengthIndicator = document.getElementById('passwordStrength');
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');
    const matchIndicator = document.getElementById('passwordMatch');
    const matchText = document.getElementById('matchText');
    const registerBtn = document.getElementById('registerBtn');

    // Validation du mot de passe en temps réel
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);

        if (password.length > 0) {
            strengthIndicator.style.display = 'block';
            updateStrengthIndicator(strength);
        } else {
            strengthIndicator.style.display = 'none';
        }

        checkPasswordMatch();
    });

    // Validation de la confirmation du mot de passe
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);

    function checkPasswordStrength(password) {
        let score = 0;
        let feedback = [];

        if (password.length >= 8) score++;
        else feedback.push('8 caractères minimum');

        if (/[a-z]/.test(password)) score++;
        else feedback.push('une minuscule');

        if (/[A-Z]/.test(password)) score++;
        else feedback.push('une majuscule');

        if (/[0-9]/.test(password)) score++;
        else feedback.push('un chiffre');

        if (/[^A-Za-z0-9]/.test(password)) score++;
        else feedback.push('un caractère spécial');

        return { score, feedback };
    }

    function updateStrengthIndicator(strength) {
        const { score, feedback } = strength;

        // Supprimer les classes précédentes
        strengthFill.classList.remove('strength-weak', 'strength-fair', 'strength-good', 'strength-strong');

        let className, text;

        switch (score) {
            case 0:
            case 1:
                className = 'strength-weak';
                text = 'Faible';
                break;
            case 2:
                className = 'strength-fair';
                text = 'Moyen';
                break;
            case 3:
            case 4:
                className = 'strength-good';
                text = 'Bon';
                break;
            case 5:
                className = 'strength-strong';
                text = 'Excellent';
                break;
        }

        strengthFill.classList.add(className);
        strengthText.textContent = `${text}${feedback.length > 0 ? ' - Manque: ' + feedback.join(', ') : ''}`;
        strengthText.className = `strength-text ${className.replace('strength-', 'text-')}`;
    }

    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (confirmPassword.length > 0) {
            matchIndicator.style.display = 'block';

            if (password === confirmPassword) {
                matchText.innerHTML = '<i class="fas fa-check"></i> Les mots de passe correspondent';
                matchText.className = 'match-text match-success';
            } else {
                matchText.innerHTML = '<i class="fas fa-times"></i> Les mots de passe ne correspondent pas';
                matchText.className = 'match-text match-error';
            }
        } else {
            matchIndicator.style.display = 'none';
        }
    }

    // Validation du formulaire avant soumission
    document.querySelector('.auth-form').addEventListener('submit', function(e) {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const terms = document.getElementById('terms').checked;

        if (password !== confirmPassword) {
            e.preventDefault();
            showStatusMessage('Les mots de passe ne correspondent pas', 'error');
            return false;
        }

        if (!terms) {
            e.preventDefault();
            showStatusMessage('Vous devez accepter les conditions d\'utilisation', 'error');
            return false;
        }

        const strength = checkPasswordStrength(password);
        if (strength.score < 3) {
            e.preventDefault();
            showStatusMessage('Le mot de passe doit être plus sécurisé', 'warning');
            return false;
        }

        // Afficher le loader
        const restoreButton = showButtonLoader(registerBtn);

        // Restaurer le bouton en cas d'erreur (après 10 secondes max)
        setTimeout(restoreButton, 10000);
    });
});

// Fonctions pour les modales (à implémenter)
function showTermsModal() {
    alert('Modal des conditions d\'utilisation à implémenter');
}

function showPrivacyModal() {
    alert('Modal de la politique de confidentialité à implémenter');
}
</script>
@endpush
