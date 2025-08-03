{{-- resources/views/frontend/volunteer.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Devenir bénévole')
@section('description', 'Rejoignez l\'équipe de bénévoles d\'Act for Communities et contribuez au développement des communautés locales')

@section('content')
<!-- Header -->
<section class="py-5 bg-success text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">{{ __('Devenir Bénévole') }}</h1>
                <p class="lead">
                    {{ __('Rejoignez notre équipe et contribuez concrètement au développement des communautés') }}
                </p>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-hand-holding-heart fa-5x opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<!-- Why Volunteer -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-title fw-bold mb-4">{{ __('Pourquoi devenir bénévole ?') }}</h2>
                <div class="mb-4">
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-heart fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>{{ __('Impact Direct') }}</h5>
                            <p>{{ __('Contribuez directement à l\'amélioration des conditions de vie des communautés locales') }}</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>{{ __('Expérience Enrichissante') }}</h5>
                            <p>{{ __('Développez vos compétences tout en vivant une expérience humaine unique') }}</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-globe fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>{{ __('Réseau Professionnel') }}</h5>
                            <p>{{ __('Élargissez votre réseau et rencontrez des personnes engagées') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/volunteers.jpg') }}" alt="Bénévoles" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Volunteer Opportunities -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold mb-5">{{ __('Opportunités de Bénévolat') }}</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-seedling fa-3x text-success mb-3"></i>
                        <h5 class="card-title">{{ __('Agriculture Durable') }}</h5>
                        <p class="card-text">{{ __('Accompagnez les producteurs dans l\'adoption de pratiques agroécologiques') }}</p>
                        <ul class="list-unstyled small text-start">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Formation des producteurs') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Suivi des cultures') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Sensibilisation environnementale') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-female fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">{{ __('Autonomisation des Femmes') }}</h5>
                        <p class="card-text">{{ __('Participez aux programmes d\'autonomisation économique des femmes rurales') }}</p>
                        <ul class="list-unstyled small text-start">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Animation d\'ateliers') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Accompagnement individuel') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Développement d\'AGR') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-graduation-cap fa-3x text-info mb-3"></i>
                        <h5 class="card-title">{{ __('Éducation & Formation') }}</h5>
                        <p class="card-text">{{ __('Contribuez à l\'éducation et au renforcement des capacités des communautés') }}</p>
                        <ul class="list-unstyled small text-start">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Alphabétisation') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Formation technique') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Sensibilisation citoyenne') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-laptop fa-3x text-warning mb-3"></i>
                        <h5 class="card-title">{{ __('Communication & TIC') }}</h5>
                        <p class="card-text">{{ __('Aidez-nous à communiquer et à développer nos outils numériques') }}</p>
                        <ul class="list-unstyled small text-start">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Gestion réseaux sociaux') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Création de contenu') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Support technique') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">{{ __('Suivi & Évaluation') }}</h5>
                        <p class="card-text">{{ __('Participez au suivi et à l\'évaluation de l\'impact de nos projets') }}</p>
                        <ul class="list-unstyled small text-start">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Collecte de données') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Analyse d\'impact') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Rédaction de rapports') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-hands-helping fa-3x text-secondary mb-3"></i>
                        <h5 class="card-title">{{ __('Support Administratif') }}</h5>
                        <p class="card-text">{{ __('Apportez votre expertise en gestion administrative et financière') }}</p>
                        <ul class="list-unstyled small text-start">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Gestion administrative') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Comptabilité') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Recherche de financements') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Requirements -->
<section class="py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-center section-title fw-bold mb-5">{{ __('Conditions et Prérequis') }}</h2>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h4><i class="fas fa-user-check text-primary me-2"></i>{{ __('Profil recherché') }}</h4>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Motivation et engagement') }}</li>
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Esprit d\'équipe') }}</li>
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Adaptabilité') }}</li>
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Respect des communautés') }}</li>
                        </ul>
                    </div>

                    <div class="col-md-6 mb-4">
                        <h4><i class="fas fa-clock text-primary me-2"></i>{{ __('Engagement') }}</h4>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Minimum 3 mois') }}</li>
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Disponibilité flexible') }}</li>
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Formation initiale obligatoire') }}</li>
                            <li><i class="fas fa-arrow-right text-primary me-2"></i>{{ __('Suivi régulier') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Form -->
<section class="py-5 bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="mx-auto px-5">
                <div class="card shadow border-0">
                    <div class="card-header bg-success text-white">
                        <h2 class="text-center mb-0">{{ __('Candidature de Bénévolat') }}</h2>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('contact.volunteer.store') }}">
                            @csrf
                            <input type="hidden" name="type" value="volunteer">
                            <input type="hidden" name="subject" value="Candidature de bénévolat">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Nom complet') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">{{ __('Téléphone') }} <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="age" class="form-label">{{ __('Âge') }}</label>
                                    <input type="number" class="form-control" id="age" name="age" min="18" max="65">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="skills" class="form-label">{{ __('Compétences et expériences') }}</label>
                                <textarea class="form-control" id="skills" name="skills" rows="3"
                                          placeholder="{{ __('Décrivez vos compétences, formations et expériences pertinentes...') }}"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="domains" class="form-label">{{ __('Domaines d\'intérêt') }} <span class="text-danger">*</span></label>
                                <select class="form-select" id="domains" name="domains" required>
                                    <option value="">{{ __('Sélectionnez un domaine') }}</option>
                                    <option value="agriculture">{{ __('Eau, hygiène et assainissement') }}</option>
                                    <option value="women">{{ __('Réduction des risques de catastrophe') }}</option>
                                    <option value="education">{{ __('Promotion et protection des droits humains et du genre') }}</option>
                                    <option value="communication">{{ __('Gouvernance et gestion durable et inclusive des ressources naturelles') }}</option>
                                    <option value="monitoring">{{ __('Conservation de la biodiversité') }}</option>
                                    <option value="admin">{{ __('Changements climatiques et efficacité énergétique') }}</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="availability" class="form-label">{{ __('Disponibilité') }}</label>
                                <textarea class="form-control" id="availability" name="availability" rows="2"
                                          placeholder="{{ __('Indiquez votre disponibilité (jours, heures, période...)') }}"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">{{ __('Motivation') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="4" required
                                          placeholder="{{ __('Expliquez votre motivation pour rejoindre notre équipe de bénévoles...') }}"></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>{{ __('Envoyer ma candidature') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Next Steps -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center section-title fw-bold mb-5">{{ __('Prochaines étapes') }}</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">1</span>
                    </div>
                </div>
                <h5>{{ __('Candidature') }}</h5>
                <p class="text-muted">{{ __('Envoyez votre candidature via le formulaire') }}</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">2</span>
                    </div>
                </div>
                <h5>{{ __('Entretien') }}</h5>
                <p class="text-muted">{{ __('Rencontre pour mieux vous connaître') }}</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">3</span>
                    </div>
                </div>
                <h5>{{ __('Formation') }}</h5>
                <p class="text-muted">{{ __('Formation initiale sur nos méthodes') }}</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                         style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3">4</span>
                    </div>
                </div>
                <h5>{{ __('Mission') }}</h5>
                <p class="text-muted">{{ __('Début de votre mission de bénévolat') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
