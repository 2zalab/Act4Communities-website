{{-- resources/views/frontend/partnership.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Partenariat')
@section('description', 'Découvrez les opportunités de partenariat avec Act for Communities pour amplifier notre impact')

@section('content')
<!-- Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('Accueil') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contact.index') }}" class="text-white">{{ __('Contact') }}</a></li>
                        <li class="breadcrumb-item active text-white">{{ __('Partenariat') }}</li>
                    </ol>
                </nav>

                <h1 class="display-5 fw-bold mb-3">{{ __('Partenariat') }}</h1>
                <p class="lead">
                    {{ __('Collaborons ensemble pour amplifier l\'impact de nos actions en faveur des communautés locales') }}
                </p>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-handshake fa-5x opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<!-- Messages d'alerte -->
@if(session('success') || session('error') || session('warning') || session('info') || $errors->any())
<section class="py-3">
    <div class="container">
        <!-- Message de succès -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Succès !</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Message d'erreur -->
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Erreur !</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Message d'avertissement -->
        @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Attention !</strong> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Message d'information -->
        @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Information :</strong> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Erreurs de validation -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Erreurs de validation :</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
</section>
@endif

<!-- Pourquoi partenaire avec nous -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('Pourquoi collaborer avec nous ?') }}</h2>
            <p class="text-muted">{{ __('Des raisons concrètes de nous choisir comme partenaire') }}</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-map-marked-alt fa-3x text-primary mb-3"></i>
                        <h5>{{ __('Ancrage local fort') }}</h5>
                        <p class="text-muted">
                            {{ __('Plus de 10 ans d\'expérience sur le terrain avec une connaissance approfondie des communautés du Nord Cameroun') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h5>{{ __('Équipe expérimentée') }}</h5>
                        <p class="text-muted">
                            {{ __('Une équipe multidisciplinaire avec des compétences reconnues en développement communautaire et gestion de projet') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                        <h5>{{ __('Résultats mesurables') }}</h5>
                        <p class="text-muted">
                            {{ __('Approche basée sur les preuves avec suivi-évaluation rigoureux et rapportage transparent de nos interventions') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
                        <h5>{{ __('Réseau établi') }}</h5>
                        <p class="text-muted">
                            {{ __('Partenariats existants avec institutions locales, ONG internationales et organisations communautaires') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                        <h5>{{ __('Approche durable') }}</h5>
                        <p class="text-muted">
                            {{ __('Focus sur la durabilité environnementale et sociale avec transfert de compétences aux communautés') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-shield-alt fa-3x text-danger mb-3"></i>
                        <h5>{{ __('Gestion transparente') }}</h5>
                        <p class="text-muted">
                            {{ __('Gouvernance rigoureuse avec audit externe et publication régulière de nos rapports d\'activités') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Types de partenariat -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('Types de partenariat') }}</h2>
            <p class="text-muted">{{ __('Différentes modalités de collaboration selon vos objectifs') }}</p>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-coins fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="mb-1">{{ __('Partenariat financier') }}</h5>
                                <small class="text-muted">{{ __('Financement de projets') }}</small>
                            </div>
                        </div>
                        <p class="mb-3">{{ __('Financement direct ou co-financement de nos projets de développement communautaire.') }}</p>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Subventions de projets') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Financement institutionnel') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Appui budgétaire') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-cogs fa-2x text-success me-3"></i>
                            <div>
                                <h5 class="mb-1">{{ __('Partenariat technique') }}</h5>
                                <small class="text-muted">{{ __('Expertise et savoir-faire') }}</small>
                            </div>
                        </div>
                        <p class="mb-3">{{ __('Mise à disposition d\'expertise technique et renforcement mutuel des capacités.') }}</p>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Assistance technique') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Formation du personnel') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Échange d\'expertises') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-network-wired fa-2x text-info me-3"></i>
                            <div>
                                <h5 class="mb-1">{{ __('Partenariat stratégique') }}</h5>
                                <small class="text-muted">{{ __('Alliance long terme') }}</small>
                            </div>
                        </div>
                        <p class="mb-3">{{ __('Collaboration stratégique pour maximiser l\'impact et développer des synergies.') }}</p>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Programmation conjointe') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Mise en réseau') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Plaidoyer commun') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-university fa-2x text-warning me-3"></i>
                            <div>
                                <h5 class="mb-1">{{ __('Partenariat académique') }}</h5>
                                <small class="text-muted">{{ __('Recherche et innovation') }}</small>
                            </div>
                        </div>
                        <p class="mb-3">{{ __('Collaboration avec universités et centres de recherche pour l\'innovation sociale.') }}</p>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Recherche-action') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Stages et mémoires') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Publications conjointes') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos partenaires actuels -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('Ils nous font confiance') }}</h2>
            <p class="text-muted">{{ __('Nos partenaires institutionnels et techniques') }}</p>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-flag fa-2x text-primary"></i>
                        </div>
                        <h6 class="fw-bold">Union Européenne</h6>
                        <small class="text-muted">{{ __('Bailleur de fonds') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-globe-americas fa-2x text-info"></i>
                        </div>
                        <h6 class="fw-bold">USAID</h6>
                        <small class="text-muted">{{ __('Coopération technique') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-building fa-2x text-success"></i>
                        </div>
                        <h6 class="fw-bold">GIZ</h6>
                        <small class="text-muted">{{ __('Partenaire technique') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-question fa-2x text-warning"></i>
                        </div>
                        <h6 class="fw-bold">{{ __('Votre organisation') }}</h6>
                        <small class="text-muted">{{ __('Futur partenaire ?') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Processus de partenariat -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('Comment devenir partenaire ?') }}</h2>
            <p class="text-muted">{{ __('Un processus simple et transparent') }}</p>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">1</span>
                    </div>
                    <h5 class="fw-bold">{{ __('Contact initial') }}</h5>
                    <p class="text-muted">{{ __('Envoyez-nous votre demande via notre formulaire ou contactez-nous directement') }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">2</span>
                    </div>
                    <h5 class="fw-bold">{{ __('Échange et évaluation') }}</h5>
                    <p class="text-muted">{{ __('Rencontre pour discuter de vos objectifs et évaluer les synergies possibles') }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">3</span>
                    </div>
                    <h5 class="fw-bold">{{ __('Élaboration commune') }}</h5>
                    <p class="text-muted">{{ __('Co-construction de la proposition de partenariat et définition des modalités') }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">4</span>
                    </div>
                    <h5 class="fw-bold">{{ __('Mise en œuvre') }}</h5>
                    <p class="text-muted">{{ __('Signature de l\'accord et lancement effectif de notre collaboration') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de contact -->
<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="px-5 mx-auto">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">{{ __('Proposer un partenariat') }}</h3>
                        <p class="mb-0 opacity-75">{{ __('Décrivez votre projet de collaboration') }}</p>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('contact.storepartnership') }}">
                            @csrf
                            <input type="hidden" name="type" value="partnership">
                            <input type="hidden" name="subject" value="Proposition de partenariat">

                            <!-- Informations organisation -->
                            <h5 class="mb-3">{{ __('Votre organisation') }}</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="org_name" class="form-label">{{ __('Nom de l\'organisation') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('org_name') is-invalid @enderror"
                                           id="org_name" name="org_name" value="{{ old('org_name') }}" required>
                                    @error('org_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="org_type" class="form-label">{{ __('Type d\'organisation') }} <span class="text-danger">*</span></label>
                                    <select class="form-select @error('org_type') is-invalid @enderror" id="org_type" name="org_type" required>
                                        <option value="">{{ __('Sélectionnez...') }}</option>
                                        <option value="ngo" {{ old('org_type') == 'ngo' ? 'selected' : '' }}>{{ __('ONG/Association') }}</option>
                                        <option value="company" {{ old('org_type') == 'company' ? 'selected' : '' }}>{{ __('Entreprise privée') }}</option>
                                        <option value="institution" {{ old('org_type') == 'institution' ? 'selected' : '' }}>{{ __('Institution publique') }}</option>
                                        <option value="university" {{ old('org_type') == 'university' ? 'selected' : '' }}>{{ __('Université/Recherche') }}</option>
                                        <option value="foundation" {{ old('org_type') == 'foundation' ? 'selected' : '' }}>{{ __('Fondation') }}</option>
                                        <option value="other" {{ old('org_type') == 'other' ? 'selected' : '' }}>{{ __('Autre') }}</option>
                                    </select>
                                    @error('org_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Personne de contact') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="position" class="form-label">{{ __('Fonction') }}</label>
                                    <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">{{ __('Téléphone') }}</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="website" class="form-label">{{ __('Site web') }}</label>
                                <input type="url" class="form-control" id="website" name="website" value="{{ old('website') }}">
                            </div>

                            <hr class="my-4">

                            <!-- Détails du partenariat -->
                            <h5 class="mb-3">{{ __('Votre proposition') }}</h5>

                            <div class="mb-3">
                                <label for="partnership_type" class="form-label">{{ __('Type de partenariat souhaité') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('partnership_type') is-invalid @enderror"
                                        id="partnership_type" name="partnership_type" required>
                                    <option value="">{{ __('Sélectionnez...') }}</option>
                                    <option value="financial" {{ old('partnership_type') == 'financial' ? 'selected' : '' }}>{{ __('Partenariat financier') }}</option>
                                    <option value="technical" {{ old('partnership_type') == 'technical' ? 'selected' : '' }}>{{ __('Partenariat technique') }}</option>
                                    <option value="strategic" {{ old('partnership_type') == 'strategic' ? 'selected' : '' }}>{{ __('Partenariat stratégique') }}</option>
                                    <option value="academic" {{ old('partnership_type') == 'academic' ? 'selected' : '' }}>{{ __('Partenariat académique') }}</option>
                                </select>
                                @error('partnership_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Domaines d\'intervention') }}</label>
                                <div class="row">
                                    @foreach ($categories->chunk(ceil($categories->count() / 2)) as $chunk)
                                        <div class="col-md-6">
                                            @foreach ($chunk as $category)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="category-{{ $category->id }}"
                                                        name="domains[]"
                                                        value="{{ $category->id }}">
                                                    <label class="form-check-label" for="category-{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">{{ __('Description de votre proposition') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror"
                                          id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                                <div class="form-text">{{ __('Décrivez votre projet de partenariat, vos objectifs et les bénéfices mutuels attendus') }}</div>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>{{ __('Envoyer la proposition') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact direct -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h3 class="fw-bold mb-3">{{ __('Discutons de votre projet') }}</h3>
        <p class="mb-4">{{ __('Préférez-vous un échange direct ? Contactez-nous') }}</p>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="tel:+237696740438" class="btn btn-light btn-lg w-100">
                            <i class="fas fa-phone me-2"></i>{{ __('Appeler') }}
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="mailto:contact@actforcommunities.org" class="btn btn-outline-light btn-lg w-100">
                            <i class="fas fa-envelope me-2"></i>{{ __('Email') }}
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg w-100">
                            <i class="fas fa-comments me-2"></i>{{ __('Échanger') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
