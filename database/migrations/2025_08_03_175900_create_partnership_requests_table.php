<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partnership_requests', function (Blueprint $table) {
            $table->id();

            // Informations organisation
            $table->string('org_name');
            $table->enum('org_type', ['ngo', 'company', 'institution', 'university', 'foundation', 'other']);
            $table->string('website')->nullable();

            // Personne de contact
            $table->string('contact_name');
            $table->string('contact_position')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();

            // Type de partenariat
            $table->enum('partnership_type', ['financial', 'technical', 'strategic', 'academic']);

            // Description du projet
            $table->text('description');

            // Statut de la demande
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])->default('pending');

            // Notes internes (pour l'admin)
            $table->text('admin_notes')->nullable();

            // Référence vers le partenaire créé (si approuvé)
            $table->foreignId('partner_id')->nullable()->constrained()->onDelete('set null');

            // Utilisateur qui a traité la demande
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('processed_at')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnership_requests');
    }
};
