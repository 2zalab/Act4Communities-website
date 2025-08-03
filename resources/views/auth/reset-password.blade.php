@extends('layouts.auth')

@section('title', 'Réinitialiser le mot de passe')
@section('description', 'Créez un nouveau mot de passe pour votre compte Act for Communities')

@section('page-title', 'Nouveau mot de passe')
@section('page-subtitle', 'Choisissez un mot de passe sécurisé')

@section('content')
    <!-- Information Message -->
    <div class="status-message status-info mb-6">
        <i class="fas fa-shield-alt"></i>
        {{ __('Votre lien de réinitialisation est valide. Créez un nouveau mot de passe sécurisé pour votre compte.') }}
    </div>

    <!-- Reset Password Form -->
    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Field (Read-only) -->
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
                       value="{{ old('email', $request->email) }}"
                       required
                       readonly
                       autocomplete="username">
                <div class="input-readonly-indicator">
                    <i class="fas fa-lock text-muted"></i>
                </div>
            </div>
            @error('email')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- New Password Field -->
        <div class="form-group">
            <label for="password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
            <div class="input-container">
                <div class="input-icon">
                    <i class="fas fa-key"></i>
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
            <label for="password_confirmation" class="form-label">{{ __('Confirmer le nouveau mot de passe') }}</label>
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
                       placeholder="{{ __('Confirmez votre nouveau mot de passe') }}">
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

        <!-- Security Tips -->
        <div class="security-tips mb-4">
            <h6 class="tips-title">
                <i class="fas fa-lightbulb me-2"></i>{{ __('Conseils pour un mot de passe sécurisé') }}
            </h6>
            <ul class="tips-list">
                <li id="tip-length">
                    <i class="fas fa-circle"></i>
                    {{ __('Au moins 8 caractères') }}
                </li>
                <li id="tip-lowercase">
                    <i class="fas fa-circle"></i>
                    {{ __('Une lettre minuscule (a-z)') }}
                </li>
                <li id="tip-uppercase">
                    <i class="fas fa-circle"></i>
                    {{ __('Une lettre majuscule (A-Z)') }}
                </li>
                <li id="tip-number">
                    <i class="fas fa-circle"></i>
                    {{ __('Un chiffre (0-9)') }}
                </li>
                <li id="tip-special">
                    <i class="fas fa-circle"></i>
                    {{ __('Un caractère spécial (!@#$...)') }}
                </li>
            </ul>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn-auth btn-primary" id="resetBtn">
                <i class="fas fa-lock"></i>
                {{ __('Réinitialiser le mot de passe') }}
            </button>
        </div>

        <!-- Security Notice -->
        <div class="security-notice">
            <div class="notice-content">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>{{ __('Note de sécurité') }}</strong>
                    <p>{{ __('Après la réinitialisation, vous serez automatiquement connecté. Ce lien ne pourra plus être utilisé.') }}</p>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
<style>
/* Styles spécifiques à la réinitialisation */
.input-readonly-indicator {
    position: absolute;
    right: 3.5rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.9rem;
}

.form-input[readonly] {
    background: rgba(243, 244, 246, 0.8);
    cursor: not-allowed;
    color: var(--text-light);
}

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

.strength-weak { background: var(--error-color); width: 25%; }
.strength-fair { background: var(--warning-color); width: 50%; }
.strength-good { background: var(--info-color); width: 75%; }
.strength-strong { background: var(--success-color); width: 100%; }

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

.match-success { color: var(--success-color); }
.match-error { color: var(--error-color); }

/* Security Tips */
.security-tips {
    background: rgba(5, 150, 105, 0.05);
    border: 1px solid rgba(5, 150, 105, 0.1);
    border-radius: 12px;
    padding: 1rem;
}

.tips-title {
    color: var(--primary-color);
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.5rem;
}

.tips-list li {
    font-size: 0.85rem;
    color: var(--text-light);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s ease;
}

.tips-list li i {
    font-size: 0.5rem;
    color: var(--border-color);
    transition: color 0.3s ease;
}

.tips-list li.valid {
    color: var(--success-color);
}

.tips-list li.valid i {
    color: var(--success-color);
}

/* Security Notice */
.security-notice {
    margin-top: 1.5rem;
    padding: 1rem;
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.2);
    border-radius: 12px;
}

.notice-content {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.notice-content i {
    color: var(--warning-color);
    font-size: 1.2rem;
    margin-top: 0.125rem;
    flex-shrink: 0;
}

.notice-content strong {
    color: var(--warning-color);
    display: block;
    margin-bottom: 0.25rem;
}

.notice-content p {
    color: var(--text-light);
    font-size: 0.85rem;
    margin: 0;
    line-height: 1.4;
}

/* Animations */
.form-group {
    animation: slideInUp 0.6s ease-out;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
.security-tips { animation-delay: 0.5s; }

/* Responsive */
@media (max-width: 640px) {
    .tips-list {
        grid-template-columns: 1fr;
    }

    .notice-content {
        flex-direction: column;
        gap: 0.5rem;
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
    const resetBtn = document.getElementById('resetBtn');

    // Validation du mot de passe en temps réel
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);

        if (password.length > 0) {
            strengthIndicator.style.display = 'block';
            updateStrengthIndicator(strength);
            updateSecurityTips(password);
        } else {
            strengthIndicator.style.display = 'none';
            resetSecurityTips();
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
                text = 'Très faible';
                break;
            case 2:
                className = 'strength-fair';
                text = 'Faible';
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
        strengthText.textContent = text;
        strengthText.className = `strength-text ${className.replace('strength-', 'text-')}`;
    }

    function updateSecurityTips(password) {
        const tips = [
            { id: 'tip-length', test: password.length >= 8 },
            { id: 'tip-lowercase', test: /[a-z]/.test(password) },
            { id: 'tip-uppercase', test: /[A-Z]/.test(password) },
            { id: 'tip-number', test: /[0-9]/.test(password) },
            { id: 'tip-special', test: /[^A-Za-z0-9]/.test(password) }
        ];

        tips.forEach(tip => {
            const element = document.getElementById(tip.id);
            if (tip.test) {
                element.classList.add('valid');
                element.querySelector('i').classList.remove('fa-circle');
                element.querySelector('i').classList.add('fa-check-circle');
            } else {
                element.classList.remove('valid');
                element.querySelector('i').classList.remove('fa-check-circle');
                element.querySelector('i').classList.add('fa-circle');
            }
        });
    }

    function resetSecurityTips() {
        const tipElements = document.querySelectorAll('.tips-list li');
        tipElements.forEach(element => {
            element.classList.remove('valid');
            element.querySelector('i').classList.remove('fa-check-circle');
            element.querySelector('i').classList.add('fa-circle');
        });
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

        if (password !== confirmPassword) {
            e.preventDefault();
            showStatusMessage('Les mots de passe ne correspondent pas', 'error');
            return false;
        }

        const strength = checkPasswordStrength(password);
        if (strength.score < 3) {
            e.preventDefault();
            showStatusMessage('Le mot de passe doit être plus sécurisé', 'warning');
            return false;
        }

        // Afficher le loader
        const restoreButton = showButtonLoader(resetBtn);

        // Changer le texte du bouton
        setTimeout(() => {
            resetBtn.innerHTML = `
                <span class="spinner"></span>
                Réinitialisation en cours...
            `;
        }, 100);

        // Simuler un succès après quelques secondes
        setTimeout(() => {
            showStatusMessage('Mot de passe réinitialisé avec succès ! Redirection...', 'success');
        }, 2000);
    });

    // Focus automatique sur le premier champ de mot de passe
    setTimeout(() => {
        passwordInput.focus();
    }, 500);
});
</script>
@endpush
