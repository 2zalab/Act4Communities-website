<?php
// routes/web.php
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PartnershipRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\PartnerController;
use Illuminate\Support\Facades\Route;
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes avec localisation
//Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {

    // Routes Frontend
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Routes À propos
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/team', [AboutController::class, 'team'])->name('team');

    // Routes Projets
    Route::prefix('projects')->name('projects.')->group(function() {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/ongoing', [ProjectController::class, 'ongoing'])->name('ongoing');
        Route::get('/completed', [ProjectController::class, 'completed'])->name('completed');
        Route::get('/{slug}', [ProjectController::class, 'show'])->name('show');
    });

    // Routes Blog/Actualités
    Route::prefix('blog')->name('posts.')->group(function() {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{slug}', [PostController::class, 'show'])->name('show');
    });

    // Routes Contact
    Route::prefix('contact')->name('contact.')->group(function() {
        // Route pour afficher le formulaire de contact
        Route::get('/', [ContactController::class, 'index'])->name('index');
        // Route pour soumettre le formulaire de contact
        Route::post('/', [ContactController::class, 'store'])->name('store');

        // Route pour afficher le formulaire de bénévolat
        Route::get('/volunteer', [ContactController::class, 'volunteer'])->name('volunteer');
        // Route pour afficher le formulaire de partenariat
        Route::get('/partnership', [ContactController::class, 'partnership'])->name('partnership');

        Route::post('/partnership', [ContactController::class, 'storePartnership'])->name('storepartnership');

        // Route pour soumettre le formulaire de bénévolat
        Route::post('/volunteer', [ContactController::class, 'storeVolunteer'])->name('volunteer.store');
    });


    // Routes d'authentification Breeze
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    });

    // Routes Admin
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Gestion des projets
        Route::resource('projects', AdminProjectController::class);

        // Gestion des articles/actualités
        Route::resource('posts', AdminPostController::class);

        // Gestion des catégories
        Route::resource('categories', CategoryController::class);

        // Gestion des contacts
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
        Route::patch('contacts/{contact}/mark-read', [AdminContactController::class, 'markAsRead'])->name('contacts.mark-read');
        Route::patch('contacts/{contact}/mark-replied', [AdminContactController::class, 'markAsReplied'])->name('contacts.mark-replied');
        // Gestion des partenaires
        Route::resource('partners', PartnerController::class);
         // Routes supplémentaires pour les partenaires
        Route::prefix('partners')->name('partners.')->group(function () {
            Route::patch('{partner}/toggle-status', [PartnerController::class, 'toggleStatus'])
                ->name('toggle-status');

            Route::post('update-order', [PartnerController::class, 'updateOrder'])
                ->name('update-order');
        });

        // Routes pour les demandes de partenariat
        Route::resource('partnership-requests', PartnershipRequestController::class)
            ->except(['create', 'store']);

        // Actions spéciales pour les demandes de partenariat
        Route::prefix('partnership-requests')->name('partnership-requests.')->group(function () {
            Route::patch('{partnershipRequest}/approve', [PartnershipRequestController::class, 'approve'])
                ->name('approve');

            Route::patch('{partnershipRequest}/reject', [PartnershipRequestController::class, 'reject'])
                ->name('reject');

            Route::patch('{partnershipRequest}/under-review', [PartnershipRequestController::class, 'setUnderReview'])
                ->name('under-review');

            Route::get('export', [PartnershipRequestController::class, 'export'])
                ->name('export');

            Route::post('bulk-action', [PartnershipRequestController::class, 'bulkAction'])
                ->name('bulk-action');
        });

        // Gestion des pages
        Route::resource('volunteers', VolunteerController::class);

        // Gestion des médias
        Route::prefix('media')->name('media.')->group(function() {
            Route::get('/', [MediaController::class, 'index'])->name('index');
            Route::post('/upload', [MediaController::class, 'upload'])->name('upload');
            Route::delete('/{media}', [MediaController::class, 'destroy'])->name('destroy');
        });

        /* Gestion des utilisateurs
        Route::prefix('users')->name('users.')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::patch('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });
        */
       //Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
        Route::resource('users', UserController::class)->only([
            'index', 'create', 'store', 'show', 'destroy'
        ]);
        Route::patch('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
   // });


        // Paramètres du site
        Route::prefix('settings')->name('settings.')->group(function() {
            Route::get('/', [SettingsController::class, 'index'])->name('index');
            Route::patch('/', [SettingsController::class, 'update'])->name('update');
        });
    });
//});

// Routes API pour recherche (optionnel)
Route::prefix('api')->group(function() {
    Route::get('search/projects', [ProjectController::class, 'search'])->name('api.projects.search');
    Route::get('search/posts', [PostController::class, 'search'])->name('api.posts.search');
});

// Route pour changer de langue
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
