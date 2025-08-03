{{-- resources/views/admin/categories/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Créer une nouvelle catégorie')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Créer une nouvelle catégorie</h1>
</div>

<div class="row py-2">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Informations de la catégorie
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.store') }}" id="categoryForm">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">
                            <i class="fas fa-tag me-2 text-primary"></i>Nom de la catégorie
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Ex: Agriculture durable"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Le nom sera automatiquement converti en URL (slug)</div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">
                            <i class="fas fa-align-left me-2 text-primary"></i>Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Décrivez brièvement cette catégorie...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="charCount">0</span>/500 caractères
                        </div>
                    </div>

                    <!-- Couleur -->
                    <div class="mb-4">
                        <label for="color" class="form-label fw-bold">
                            <i class="fas fa-palette me-2 text-primary"></i>Couleur
                        </label>
                        <div class="color-selector">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="color"
                                           class="form-control form-control-color @error('color') is-invalid @enderror"
                                           id="color"
                                           name="color"
                                           value="{{ old('color', '#059669') }}"
                                           required>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="color-preview" id="colorPreview">
                                        <div class="preview-text">Aperçu</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Couleurs prédéfinies -->
                            <div class="predefined-colors mt-3">
                                <label class="form-label small">Couleurs suggérées :</label>
                                <div class="color-palette">
                                    <div class="color-option" data-color="#059669" title="Vert primaire"></div>
                                    <div class="color-option" data-color="#10B981" title="Vert accent"></div>
                                    <div class="color-option" data-color="#F59E0B" title="Orange"></div>
                                    <div class="color-option" data-color="#EF4444" title="Rouge"></div>
                                    <div class="color-option" data-color="#3B82F6" title="Bleu"></div>
                                    <div class="color-option" data-color="#8B5CF6" title="Violet"></div>
                                    <div class="color-option" data-color="#EC4899" title="Rose"></div>
                                    <div class="color-option" data-color="#6B7280" title="Gris"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sélecteur d'icône -->
                    <div class="mb-4">
                        <label for="icon" class="form-label fw-bold">
                            <i class="fas fa-icons me-2 text-primary"></i>Icône
                        </label>
                        <div class="icon-selector">
                            <!-- Champ caché pour l'icône sélectionnée -->
                            <input type="hidden" id="icon" name="icon" value="{{ old('icon', 'fas fa-tag') }}" required>

                            <!-- Aperçu de l'icône sélectionnée -->
                            <div class="selected-icon-preview mb-3">
                                <div class="preview-container">
                                    <i id="selectedIcon" class="fas fa-tag"></i>
                                    <span id="selectedIconText">fas fa-tag</span>
                                    <button type="button" class="btn btn-outline-primary btn-sm ms-3" id="changeIconBtn">
                                        Changer l'icône
                                    </button>
                                </div>
                            </div>

                            <!-- Recherche d'icônes -->
                            <div class="icon-search-container" style="display: none;">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control"
                                           id="iconSearch"
                                           placeholder="Rechercher une icône...">
                                </div>

                                <!-- Catégories d'icônes -->
                                <div class="icon-categories mb-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter active" data-category="all">
                                        Toutes
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="business">
                                        Business
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="nature">
                                        Nature
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="social">
                                        Social
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="tech">
                                        Tech
                                    </button>
                                </div>

                                <!-- Grille d'icônes -->
                                <div class="icons-grid" id="iconsGrid">
                                    <!-- Les icônes seront générées par JavaScript -->
                                </div>
                            </div>
                        </div>
                        @error('icon')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">
                                <i class="fas fa-toggle-on me-2 text-success"></i>Catégorie active
                            </label>
                            <div class="form-text">Une catégorie inactive ne sera pas visible sur le site</div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Créer la catégorie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Aperçu en temps réel -->
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                    <i class="fas fa-eye me-2"></i>Aperçu
                </h5>
            </div>
            <div class="card-body">
                <div class="category-preview" id="categoryPreview">
                    <div class="preview-item">
                        <div class="preview-icon">
                            <i id="previewIcon" class="fas fa-tag"></i>
                        </div>
                        <div class="preview-content">
                            <h6 id="previewName">Nom de la catégorie</h6>
                            <p id="previewDescription" class="text-muted small">Description de la catégorie</p>
                        </div>
                    </div>
                </div>

                <div class="preview-info mt-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Cet aperçu montre comment la catégorie apparaîtra sur le site
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour le sélecteur de couleur */
.color-selector .color-preview {
    height: 38px;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    background: #059669;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
}

.color-palette {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.color-option {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #dee2e6;
    transition: all 0.3s ease;
    position: relative;
}

.color-option:hover {
    transform: scale(1.1);
    border-color: #495057;
}

.color-option.selected {
    border-color: #0d6efd;
    box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
}

/* Styles pour le sélecteur d'icône */
.selected-icon-preview {
    padding: 1rem;
    border: 2px dashed #dee2e6;
    border-radius: 0.5rem;
    background: #f8f9fa;
}

.preview-container {
    display: flex;
    align-items: center;
}

.preview-container i {
    font-size: 2rem;
    margin-right: 1rem;
    color: var(--bs-primary);
}

.icon-search-container {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    padding: 1rem;
    background: #f8f9fa;
}

.icon-categories {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.category-filter.active {
    background-color: var(--bs-primary);
    color: white;
    border-color: var(--bs-primary);
}

.icons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    gap: 0.5rem;
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    background: white;
}

.icon-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.icon-item:hover {
    border-color: var(--bs-primary);
    background: rgba(13, 110, 253, 0.1);
    transform: translateY(-2px);
}

.icon-item.selected {
    border-color: var(--bs-primary);
    background: var(--bs-primary);
    color: white;
}

.icon-item i {
    font-size: 1.5rem;
    margin-bottom: 0.25rem;
}

.icon-item span {
    font-size: 0.7rem;
    text-align: center;
    word-break: break-all;
}

/* Aperçu de la catégorie */
.category-preview {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    padding: 1rem;
    background: white;
}

.preview-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.preview-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #059669;
    color: white;
    flex-shrink: 0;
}

.preview-icon i {
    font-size: 1.5rem;
}

.preview-content {
    flex: 1;
}

.preview-content h6 {
    margin: 0 0 0.25rem 0;
    color: #495057;
}

.preview-content p {
    margin: 0;
    font-size: 0.85rem;
}

/* Responsive */
@media (max-width: 768px) {
    .icons-grid {
        grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
    }

    .color-palette {
        justify-content: center;
    }

    .icon-categories {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Liste des icônes par catégorie
    const iconsByCategory = {
        business: [
            'fas fa-briefcase', 'fas fa-chart-line', 'fas fa-handshake', 'fas fa-building',
            'fas fa-coins', 'fas fa-calculator', 'fas fa-clipboard-list', 'fas fa-cogs',
            'fas fa-bullseye', 'fas fa-trophy', 'fas fa-rocket', 'fas fa-lightbulb'
        ],
        nature: [
            'fas fa-leaf', 'fas fa-tree', 'fas fa-seedling', 'fas fa-mountain',
            'fas fa-water', 'fas fa-sun', 'fas f-cloud', 'fas fa-globe-americas',
            'fas fa-recycle', 'fas fa-paw', 'fas fa-fish', 'fas fa-dove'
        ],
        social: [
            'fas fa-users', 'fas fa-user-friends', 'fas fa-hands-helping', 'fas fa-heart',
            'fas fa-home', 'fas fa-graduation-cap', 'fas fa-medical-kit', 'fas fa-balance-scale',
            'fas fa-gavel', 'fas fa-shield-alt', 'fas fa-church', 'fas fa-pray'
        ],
        tech: [
            'fas fa-laptop', 'fas fa-mobile-alt', 'fas fa-wifi', 'fas fa-database',
            'fas fa-cloud', 'fas fa-server', 'fas fa-code', 'fas fa-bug',
            'fas fa-robot', 'fas fa-microchip', 'fas fa-plug', 'fas fa-satellite'
        ]
    };

    // Tous les icônes
    const allIcons = Object.values(iconsByCategory).flat();

    // Éléments DOM
    const iconInput = document.getElementById('icon');
    const selectedIcon = document.getElementById('selectedIcon');
    const selectedIconText = document.getElementById('selectedIconText');
    const changeIconBtn = document.getElementById('changeIconBtn');
    const iconSearchContainer = document.querySelector('.icon-search-container');
    const iconSearch = document.getElementById('iconSearch');
    const iconsGrid = document.getElementById('iconsGrid');
    const categoryFilters = document.querySelectorAll('.category-filter');

    // Éléments pour l'aperçu
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const colorInput = document.getElementById('color');
    const previewIcon = document.getElementById('previewIcon');
    const previewName = document.getElementById('previewName');
    const previewDescription = document.getElementById('previewDescription');
    const colorPreview = document.getElementById('colorPreview');
    const charCount = document.getElementById('charCount');

    // Initialiser les icônes
    let currentCategory = 'all';

    function renderIcons(icons) {
        iconsGrid.innerHTML = '';
        icons.forEach(iconClass => {
            const iconItem = document.createElement('div');
            iconItem.className = 'icon-item';
            iconItem.dataset.icon = iconClass;

            const iconName = iconClass.split(' ').pop().replace('fa-', '');

            iconItem.innerHTML = `
                <i class="${iconClass}"></i>
                <span>${iconName}</span>
            `;

            iconItem.addEventListener('click', function() {
                selectIcon(iconClass);
            });

            iconsGrid.appendChild(iconItem);
        });
    }

    function selectIcon(iconClass) {
        iconInput.value = iconClass;
        selectedIcon.className = iconClass;
        selectedIconText.textContent = iconClass;
        previewIcon.className = iconClass;

        // Mettre à jour la sélection visuelle
        document.querySelectorAll('.icon-item').forEach(item => {
            item.classList.remove('selected');
        });
        document.querySelector(`[data-icon="${iconClass}"]`).classList.add('selected');

        // Masquer le sélecteur
        iconSearchContainer.style.display = 'none';
    }

    function filterIcons() {
        const searchTerm = iconSearch.value.toLowerCase();
        let iconsToShow = currentCategory === 'all' ? allIcons : iconsByCategory[currentCategory];

        if (searchTerm) {
            iconsToShow = iconsToShow.filter(icon =>
                icon.toLowerCase().includes(searchTerm)
            );
        }

        renderIcons(iconsToShow);
    }

    // Event listeners
    changeIconBtn.addEventListener('click', function() {
        iconSearchContainer.style.display = iconSearchContainer.style.display === 'none' ? 'block' : 'none';
        if (iconSearchContainer.style.display === 'block') {
            renderIcons(currentCategory === 'all' ? allIcons : iconsByCategory[currentCategory]);
        }
    });

    iconSearch.addEventListener('input', filterIcons);

    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            categoryFilters.forEach(f => f.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.category;
            filterIcons();
        });
    });

    // Sélecteur de couleur
    const colorOptions = document.querySelectorAll('.color-option');
    colorOptions.forEach(option => {
        const color = option.dataset.color;
        option.style.backgroundColor = color;

        option.addEventListener('click', function() {
            colorInput.value = color;
            updateColorPreview();
            colorOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    function updateColorPreview() {
        const color = colorInput.value;
        colorPreview.style.backgroundColor = color;
        document.querySelector('.preview-icon').style.backgroundColor = color;
    }

    // Mise à jour de l'aperçu en temps réel
    nameInput.addEventListener('input', function() {
        previewName.textContent = this.value || 'Nom de la catégorie';
    });

    descriptionInput.addEventListener('input', function() {
        const text = this.value || 'Description de la catégorie';
        previewDescription.textContent = text;
        charCount.textContent = this.value.length;

        // Changer la couleur si limite dépassée
        if (this.value.length > 500) {
            charCount.style.color = '#dc3545';
        } else {
            charCount.style.color = '#6c757d';
        }
    });

    colorInput.addEventListener('change', updateColorPreview);

    // Initialisation
    renderIcons(allIcons);
    updateColorPreview();

    // Marquer l'icône par défaut comme sélectionnée
    setTimeout(() => {
        const defaultIcon = document.querySelector('[data-icon="fas fa-tag"]');
        if (defaultIcon) {
            defaultIcon.classList.add('selected');
        }
    }, 100);
});
</script>
@endsection
