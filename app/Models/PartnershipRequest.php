<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_name',
        'org_type',
        'website',
        'contact_name',
        'contact_position',
        'contact_email',
        'contact_phone',
        'partnership_type',
        'description',
        'status',
        'admin_notes',
        'partner_id',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec les catégories
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'partnership_request_categories');
    }

    /**
     * Relation avec le partenaire créé (si approuvé)
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Relation avec l'utilisateur qui a traité la demande
     */
    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Accesseur pour le type d'organisation
     */
    public function getOrgTypeNameAttribute(): string
    {
        return match($this->org_type) {
            'ngo' => 'ONG/Association',
            'company' => 'Entreprise privée',
            'institution' => 'Institution publique',
            'university' => 'Université/Recherche',
            'foundation' => 'Fondation',
            'other' => 'Autre',
            default => $this->org_type,
        };
    }

    /**
     * Accesseur pour le type de partenariat
     */
    public function getPartnershipTypeNameAttribute(): string
    {
        return match($this->partnership_type) {
            'financial' => 'Partenariat financier',
            'technical' => 'Partenariat technique',
            'strategic' => 'Partenariat stratégique',
            'academic' => 'Partenariat académique',
            default => $this->partnership_type,
        };
    }

    /**
     * Accesseur pour le statut
     */
    public function getStatusNameAttribute(): string
    {
        return match($this->status) {
            'pending' => 'En attente',
            'under_review' => 'En cours d\'examen',
            'approved' => 'Approuvé',
            'rejected' => 'Rejeté',
            default => $this->status,
        };
    }

    /**
     * Accesseur pour le badge du statut
     */
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending' => 'badge bg-warning',
            'under_review' => 'badge bg-info',
            'approved' => 'badge bg-success',
            'rejected' => 'badge bg-danger',
            default => 'badge bg-secondary',
        };
    }

    /**
     * Vérifier si la demande peut être approuvée
     */
    public function canBeApproved(): bool
    {
        return in_array($this->status, ['pending', 'under_review']);
    }

    /**
     * Vérifier si la demande peut être rejetée
     */
    public function canBeRejected(): bool
    {
        return in_array($this->status, ['pending', 'under_review']);
    }

    /**
     * Approuver la demande et créer un partenaire
     */
    public function approve(User $user, array $partnerData = []): Partner
    {
        if (!$this->canBeApproved()) {
            throw new \Exception('Cette demande ne peut pas être approuvée.');
        }

        // Créer le partenaire
        $partner = Partner::create([
            'name' => $partnerData['name'] ?? $this->org_name,
            'website' => $partnerData['website'] ?? $this->website,
            'description' => $partnerData['description'] ?? $this->description,
            'type' => $partnerData['type'] ?? $this->getPartnerTypeFromOrgType(),
            'is_active' => $partnerData['is_active'] ?? true,
            'sort_order' => $partnerData['sort_order'] ?? 0,
        ]);

        // Mettre à jour la demande
        $this->update([
            'status' => 'approved',
            'partner_id' => $partner->id,
            'processed_by' => $user->id,
            'processed_at' => now(),
        ]);

        return $partner;
    }

    /**
     * Rejeter la demande
     */
    public function reject(User $user, string $reason = null): void
    {
        if (!$this->canBeRejected()) {
            throw new \Exception('Cette demande ne peut pas être rejetée.');
        }

        $this->update([
            'status' => 'rejected',
            'admin_notes' => $reason ? ($this->admin_notes ? $this->admin_notes . "\n\n" . $reason : $reason) : $this->admin_notes,
            'processed_by' => $user->id,
            'processed_at' => now(),
        ]);
    }

    /**
     * Convertir le type d'organisation en type de partenaire
     */
    private function getPartnerTypeFromOrgType(): string
    {
        return match($this->org_type) {
            'ngo' => 'ong',
            'company' => 'entreprise',
            'institution' => 'institution',
            'university' => 'academique',
            'foundation' => 'fondation',
            'other' => 'autre',
            default => 'autre',
        };
    }

    /**
     * Scope pour filtrer par statut
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope pour filtrer par type de partenariat
     */
    public function scopeByPartnershipType($query, $type)
    {
        return $query->where('partnership_type', $type);
    }

    /**
     * Scope pour filtrer par type d'organisation
     */
    public function scopeByOrgType($query, $type)
    {
        return $query->where('org_type', $type);
    }

    /**
     * Scope pour les demandes en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope pour les demandes approuvées
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope pour recherche
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('org_name', 'like', "%{$search}%")
              ->orWhere('contact_name', 'like', "%{$search}%")
              ->orWhere('contact_email', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }
}
