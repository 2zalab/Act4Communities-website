@extends('layouts.auth')

@section('title', 'Mot de passe oublié')
@section('description', 'Réinitialisation du mot de passe Act for Communities')

@section('page-title', 'Mot de passe oublié')
@section('page-subtitle', 'Récupérez l\'accès à votre compte')

@section('content')
    <!-- Information Message -->
    <div class="status-message status-info mb-6">
        <i class="fas fa-info-circle"></i>
        {{ __('Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.') }}
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="status-message status-success">
            <i class="fas fa-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    <!-- Reset Form -->
    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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
                       autocomplete="email"
                       placeholder="{{ __('votre@email.com') }}">
            </div>
            @error('email')
                <div class="input-error">{{ $message }}</div>
            @enderror
            <div class="input-help mt-2">
                <small class="text-muted">
                    <i class="fas fa-lightbulb me-1"></i>
                    {{ __('Utilisez l\'adresse email associée à votre compte administrateur') }}
                </small>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn-auth btn-primary" id="resetBtn">
                <i class="fas fa-paper-plane"></i>
                {{ __('Envoyer le lien de réinitialisation') }}
            </button>
        </div>

        <!-- Back to Login -->
        <div class="text-center mt-4">
            <a class="auth-link" href="{{ route('login') }}">
                <i class="fas fa-arrow-left"></i>
                {{ __('Retour à la connexion') }}
            </a>
        </div>
    </form>

    <!-- Additional Help -->
    <div class="auth-divider">
        <span>{{ __('Besoin d\'aide ?') }}</span>
    </div>

    <div class="help-section text-center">
        <div class="help-grid">
            <div class="help-item">
                <div class="help-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h6 class="help-title">{{ __('Délai de réception') }}</h6>
                <p class="help-text">{{ __('Le lien arrive généralement en quelques minutes') }}</p>
            </div>

            <div class="help-item">
                <div class="help-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h6 class="help-title">{{ __('Sécurité') }}</h6>
                <p class="help-text">{{ __('Le lien expire après 60 minutes') }}</p>
            </div>

            <div class="help-item">
                <div class="help-icon">
                    <i class="fas fa-spam"></i>
                </div>
                <h6 class="help-title">{{ __('Pas reçu ?') }}</h6>
                <p class="help-text">{{ __('Vérifiez vos spams') }}</p>
            </div>
        </div>

        <div class="contact-support mt-4">
            <p class="text-muted">
                {{ __('Toujours des difficultés ?') }}
                <a href="{{ route('contact.index') }}" class="auth-link">
                    <i class="fas fa-headset"></i>
                    {{ __('Contactez le support') }}
                </a>
            </p>
        </div>
    </div>
@endsection

@push('styles')
<style>
/* Styles spécifiques à la réinitialisation */
.input-help {
    margin-top: 0.5rem;
}

.text-muted {
    color: var(--text-light);
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.help-section {
    margin-top: 2rem;
    padding: 1.5rem;
    background: rgba(5, 150, 105, 0.05);
    border-radius: 12px;
    border: 1px solid rgba(5, 150, 105, 0.1);
}

.help-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.help-item {
    text-align: center;
}

.help-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    color: white;
    font-size: 1rem;
}

.help-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.help-text {
    font-size: 0.8rem;
    color: var(--text-light);
    margin: 0;
    line-height: 1.4;
}

.contact-support {
    padding-top: 1rem;
    border-top: 1px solid rgba(5, 150, 105, 0.1);
}

.contact-support p {
    margin: 0;
    font-size: 0.9rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

/* Animation pour les éléments d'aide */
.help-item {
    animation: fadeInUp 0.6s ease-out;
}

.help-item:nth-child(1) { animation-delay: 0.1s; }
.help-item:nth-child(2) { animation-delay: 0.2s; }
.help-item:nth-child(3) { animation-delay: 0.3s; }

/* Responsive */
@media (max-width: 640px) {
    .help-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .help-section {
        padding: 1rem;
    }

    .contact-support p {
        flex-direction: column;
        text-align: center;
    }
}

/* États du bouton de soumission */
#resetBtn.loading {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.7), rgba(16, 185, 129, 0.7));
}

/* Animation de succès */
.success-animation {
    animation: successPulse 0.6s ease-out;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.auth-form');
    const emailInput = document.getElementById('email');
    const resetBtn = document.getElementById('resetBtn');

    // Validation email en temps réel
    emailInput.addEventListener('input', function() {
        const email = this.value.trim();
        const isValid = isValidEmail(email);

        if (email.length > 0 && !isValid) {
            this.style.borderColor = 'var(--error-color)';
        } else {
            this.style.borderColor = '';
        }
    });

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', function(e) {
        const email = emailInput.value.trim();

        if (!isValidEmail(email)) {
            e.preventDefault();
            showStatusMessage('Veuillez entrer une adresse email valide', 'error');
            emailInput.focus();
            return false;
        }

        // Afficher le loader
        const restoreButton = showButtonLoader(resetBtn);

        // Changer le texte du bouton
        setTimeout(() => {
            resetBtn.innerHTML = `
                <span class="spinner"></span>
                Envoi en cours...
            `;
        }, 100);

        // Simuler un délai de traitement
        setTimeout(() => {
            if (!form.querySelector('.status-success')) {
                // Si pas de message de succès, restaurer le bouton
                restoreButton();
            }
        }, 5000);
    });

    // Animation de succès si message de statut présent
    const statusSuccess = document.querySelector('.status-success');
    if (statusSuccess) {
        statusSuccess.classList.add('success-animation');

        // Afficher des confettis virtuels (optionnel)
        setTimeout(() => {
            showSuccessAnimation();
        }, 500);
    }

    // Function pour validation email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Animation de succès
    function showSuccessAnimation() {
        // Créer des particules de succès
        for (let i = 0; i < 6; i++) {
            setTimeout(() => {
                createSuccessParticle();
            }, i * 100);
        }
    }

    function createSuccessParticle() {
        const particle = document.createElement('div');
        particle.innerHTML = '✨';
        particle.style.cssText = `
            position: fixed;
            top: 20%;
            left: ${Math.random() * 100}%;
            font-size: 1.5rem;
            pointer-events: none;
            z-index: 9999;
            animation: successFloat 2s ease-out forwards;
        `;

        document.body.appendChild(particle);

        setTimeout(() => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
            }
        }, 2000);
    }

    // Ajouter l'animation CSS pour les particules
    const style = document.createElement('style');
    style.textContent = `
        @keyframes successFloat {
            0% {
                opacity: 1;
                transform: translateY(0) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translateY(-100px) rotate(360deg);
            }
        }
    `;
    document.head.appendChild(style);

    // Auto-focus sur le champ email si vide
    if (emailInput.value.trim() === '') {
        setTimeout(() => {
            emailInput.focus();
        }, 500);
    }
});
</script>
@endpush
