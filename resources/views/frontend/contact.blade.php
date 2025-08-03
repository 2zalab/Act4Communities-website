{{-- resources/views/frontend/contact.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Nous contacter')
@section('description', 'Contactez Act for Communities pour vos questions, propositions de partenariat ou pour devenir bénévole')

@section('content')
<!-- Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">{{ __('Contactez-nous') }}</h1>
                <p class="lead">
                    {{ __('Nous sommes à votre écoute pour toute question, suggestion ou collaboration') }}
                </p>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-envelope fa-5x opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 text-center border-0 shadow">
                    <div class="card-body">
                        <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">{{ __('Téléphones') }}</h5>
                        @foreach($contactInfo['phones'] as $phone)
                        <p class="card-text mb-1">
                            <a href="tel:{{ $phone }}" class="text-decoration-none">{{ $phone }}</a>
                        </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 text-center border-0 shadow">
                    <div class="card-body">
                        <i class="fas fa-building fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">{{ __('Bureau') }}</h5>
                        <p class="card-text">
                            <a href="tel:{{ $contactInfo['office'] }}" class="text-decoration-none">
                                {{ $contactInfo['office'] }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 text-center border-0 shadow">
                    <div class="card-body">
                        <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">{{ __('Email') }}</h5>
                        <p class="card-text">
                            <a href="mailto:{{ $contactInfo['email'] }}" class="text-decoration-none">
                                {{ $contactInfo['email'] }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 text-center border-0 shadow">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">{{ __('Adresse') }}</h5>
                        <p class="card-text">{{ $contactInfo['address'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="mx-auto">
                <div class="card shadow border-0">
                    <div class="card-header bg-white">
                        <h2 class="text-center mb-0">{{ __('Envoyez-nous un message') }}</h2>
                    </div>
                    <div class="card-body p-5">
                        @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Nom complet') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">{{ __('Adresse email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">{{ __('Téléphone') }}</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">{{ __('Type de demande') }} <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="">{{ __('Sélectionnez...') }}</option>
                                        <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>{{ __('Question générale') }}</option>
                                        <option value="volunteer" {{ old('type') == 'volunteer' ? 'selected' : '' }}>{{ __('Bénévolat') }}</option>
                                        <option value="partnership" {{ old('type') == 'partnership' ? 'selected' : '' }}>{{ __('Partenariat') }}</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">{{ __('Sujet') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                       id="subject" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">{{ __('Message') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror"
                                          id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>{{ __('Envoyer le message') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Actions -->
<section class="py-5">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold mb-5">{{ __('Comment pouvez-vous nous aider ?') }}</h2>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center border-0 shadow">
                    <div class="card-body">
                        <i class="fas fa-hand-holding-heart fa-4x text-primary mb-3"></i>
                        <h4 class="card-title">{{ __('Devenir Bénévole') }}</h4>
                        <p class="card-text">
                            {{ __('Rejoignez notre équipe de bénévoles et contribuez directement à nos missions sur le terrain') }}
                        </p>
                        <a href="{{ route('contact.volunteer') }}" class="btn btn-primary">
                            {{ __('En savoir plus') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center border-0 shadow">
                    <div class="card-body">
                        <i class="fas fa-handshake fa-4x text-primary mb-3"></i>
                        <h4 class="card-title">{{ __('Partenariat') }}</h4>
                        <p class="card-text">
                            {{ __('Collaborez avec nous pour amplifier l\'impact de nos actions en faveur des communautés') }}
                        </p>
                        <a href="{{ route('contact.partnership') }}" class="btn btn-primary">
                            {{ __('Découvrir') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center border-0 shadow">
                    <div class="card-body">
                        <i class="fas fa-donate fa-4x text-primary mb-3"></i>
                        <h4 class="card-title">{{ __('Nous Soutenir') }}</h4>
                        <p class="card-text">
                            {{ __('Soutenez financièrement nos projets ou contribuez par d\'autres moyens à nos actions') }}
                        </p>
                        <a href="{{ route('contact.index') }}" class="btn btn-primary">
                            {{ __('Contribuer') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold mb-5">{{ __('Nous situer') }}</h2>
        <div class="row">
            <div class=" mx-auto">
                <div class="card shadow border-0">
                    <div class="card-body p-0">
                        <!-- Placeholder pour la carte - à remplacer par une vraie carte -->
                         <div class="bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 400px;">
                                <div style="width: 100%; height: 100%;">
                                    <iframe
                                        src="https://www.google.com/maps?q=9.309742,13.393472&hl=fr&z=15&output=embed"
                                        width="100%"
                                        height="100%"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
