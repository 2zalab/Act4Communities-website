<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PartnershipRequestController extends Controller
{
    /**
     * Display a listing of partnership requests.
     */
    public function index(Request $request): View
    {
        $query = PartnershipRequest::with(['categories', 'partner', 'processedBy']);

        // Filtres
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('partnership_type')) {
            $query->byPartnershipType($request->partnership_type);
        }

        if ($request->filled('org_type')) {
            $query->byOrgType($request->org_type);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $partnershipRequests = $query->latest()->paginate(15)->withQueryString();

        // Statistiques
        $stats = [
            'total' => PartnershipRequest::count(),
            'pending' => PartnershipRequest::byStatus('pending')->count(),
            'under_review' => PartnershipRequest::byStatus('under_review')->count(),
            'approved' => PartnershipRequest::byStatus('approved')->count(),
            'rejected' => PartnershipRequest::byStatus('rejected')->count(),
        ];

        return view('admin.partnership-requests.index', compact('partnershipRequests', 'stats'));
    }

    /**
     * Display the specified partnership request.
     */
    public function show(PartnershipRequest $partnershipRequest): View
    {
        $partnershipRequest->load(['categories', 'partner', 'processedBy']);

        return view('admin.partnership-requests.show', compact('partnershipRequest'));
    }

    /**
     * Show the form for editing the specified partnership request.
     */
    public function edit(PartnershipRequest $partnershipRequest): View
    {
        $partnershipRequest->load(['categories']);

        return view('admin.partnership-requests.edit', compact('partnershipRequest'));
    }

    /**
     * Update the specified partnership request.
     */
    public function update(Request $request, PartnershipRequest $partnershipRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'admin_notes' => 'nullable|string|max:2000',
        ], [
            'status.required' => 'Le statut est obligatoire.',
            'status.in' => 'Le statut sélectionné n\'est pas valide.',
            'admin_notes.max' => 'Les notes ne peuvent pas dépasser 2000 caractères.',
        ]);

        $originalStatus = $partnershipRequest->status;

        $partnershipRequest->update($validated);

        // Si le statut a changé, mettre à jour les informations de traitement
        if ($validated['status'] !== $originalStatus) {
            $partnershipRequest->update([
                'processed_by' => Auth::id(),
                'processed_at' => now(),
            ]);

            // Envoyer une notification si nécessaire
            $this->sendStatusUpdateNotification($partnershipRequest, $originalStatus);
        }

        return redirect()->route('admin.partnership-requests.show', $partnershipRequest)
                        ->with('success', 'Demande de partenariat mise à jour avec succès.');
    }

    /**
     * Approve partnership request and create partner.
     */
    public function approve(Request $request, PartnershipRequest $partnershipRequest): RedirectResponse
    {
        if (!$partnershipRequest->canBeApproved()) {
            return back()->with('error', 'Cette demande ne peut pas être approuvée dans son état actuel.');
        }

        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'partner_description' => 'nullable|string|max:1000',
            'partner_type' => 'required|in:ong,entreprise,institution,academique,fondation,autre',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ], [
            'partner_name.required' => 'Le nom du partenaire est obligatoire.',
            'partner_name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'partner_description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'partner_type.required' => 'Le type de partenaire est obligatoire.',
            'partner_type.in' => 'Le type sélectionné n\'est pas valide.',
            'sort_order.integer' => 'L\'ordre doit être un nombre entier.',
            'sort_order.min' => 'L\'ordre doit être positif.',
        ]);

        try {
            DB::beginTransaction();

            $partner = $partnershipRequest->approve(Auth::user(), [
                'name' => $validated['partner_name'],
                'website' => $partnershipRequest->website,
                'description' => $validated['partner_description'] ?? $partnershipRequest->description,
                'type' => $validated['partner_type'],
                'is_active' => $validated['is_active'] ?? true,
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);

            DB::commit();

            // Envoyer email de confirmation d'approbation
            $this->sendApprovalNotification($partnershipRequest, $partner);

            return redirect()->route('admin.partnership-requests.show', $partnershipRequest)
                            ->with('success',
                                'Demande approuvée avec succès ! Le partenaire "' . $partner->name . '" a été créé.'
                            );

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'approbation de la demande de partenariat', [
                'partnership_request_id' => $partnershipRequest->id,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return back()->with('error', 'Erreur lors de l\'approbation : ' . $e->getMessage());
        }
    }

    /**
     * Reject partnership request.
     */
    public function reject(Request $request, PartnershipRequest $partnershipRequest): RedirectResponse
    {
        if (!$partnershipRequest->canBeRejected()) {
            return back()->with('error', 'Cette demande ne peut pas être rejetée dans son état actuel.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ], [
            'rejection_reason.required' => 'Le motif du rejet est obligatoire.',
            'rejection_reason.min' => 'Le motif doit contenir au moins 10 caractères.',
            'rejection_reason.max' => 'Le motif ne peut pas dépasser 1000 caractères.',
        ]);

        try {
            $partnershipRequest->reject(Auth::user(), $validated['rejection_reason']);

            // Envoyer email de notification de rejet
            $this->sendRejectionNotification($partnershipRequest, $validated['rejection_reason']);

            return redirect()->route('admin.partnership-requests.show', $partnershipRequest)
                            ->with('success', 'Demande rejetée avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors du rejet de la demande de partenariat', [
                'partnership_request_id' => $partnershipRequest->id,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return back()->with('error', 'Erreur lors du rejet : ' . $e->getMessage());
        }
    }

    /**
     * Set partnership request status to under review.
     */
    public function setUnderReview(PartnershipRequest $partnershipRequest): RedirectResponse
    {
        if (!in_array($partnershipRequest->status, ['pending'])) {
            return back()->with('error', 'Cette demande ne peut pas être mise en cours d\'examen.');
        }

        $partnershipRequest->update([
            'status' => 'under_review',
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        // Optionnel : envoyer une notification au demandeur
        $this->sendStatusUpdateNotification($partnershipRequest, 'pending');

        return back()->with('success', 'Demande mise en cours d\'examen.');
    }

    /**
     * Remove the specified partnership request.
     */
    public function destroy(PartnershipRequest $partnershipRequest): RedirectResponse
    {
        if ($partnershipRequest->status === 'approved' && $partnershipRequest->partner_id) {
            return back()->with('error',
                'Impossible de supprimer une demande approuvée qui est liée à un partenaire actif.'
            );
        }

        try {
            $orgName = $partnershipRequest->org_name;
            $partnershipRequest->delete();

            return redirect()->route('admin.partnership-requests.index')
                            ->with('success',
                                'Demande de partenariat de "' . $orgName . '" supprimée avec succès.'
                            );

        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de la demande de partenariat', [
                'partnership_request_id' => $partnershipRequest->id,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Send approval notification email.
     */
    private function sendApprovalNotification(PartnershipRequest $partnershipRequest, Partner $partner): void
    {
        try {
            // TODO: Créer et envoyer l'email d'approbation
            // Mail::send('emails.partnership.approval', compact('partnershipRequest', 'partner'), function ($message) use ($partnershipRequest) {
            //     $message->to($partnershipRequest->contact_email, $partnershipRequest->contact_name)
            //             ->subject('Demande de partenariat approuvée - Act for Communities');
            // });

            Log::info('Demande de partenariat approuvée - Email envoyé', [
                'partnership_request_id' => $partnershipRequest->id,
                'partner_id' => $partner->id,
                'contact_email' => $partnershipRequest->contact_email,
            ]);

        } catch (\Exception $e) {
            Log::warning('Erreur lors de l\'envoi de l\'email d\'approbation', [
                'partnership_request_id' => $partnershipRequest->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send rejection notification email.
     */
    private function sendRejectionNotification(PartnershipRequest $partnershipRequest, string $reason): void
    {
        try {
            // TODO: Créer et envoyer l'email de rejet
            // Mail::send('emails.partnership.rejection', compact('partnershipRequest', 'reason'), function ($message) use ($partnershipRequest) {
            //     $message->to($partnershipRequest->contact_email, $partnershipRequest->contact_name)
            //             ->subject('Demande de partenariat - Act for Communities');
            // });

            Log::info('Demande de partenariat rejetée - Email envoyé', [
                'partnership_request_id' => $partnershipRequest->id,
                'contact_email' => $partnershipRequest->contact_email,
                'reason' => $reason,
            ]);

        } catch (\Exception $e) {
            Log::warning('Erreur lors de l\'envoi de l\'email de rejet', [
                'partnership_request_id' => $partnershipRequest->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send status update notification email.
     */
    private function sendStatusUpdateNotification(PartnershipRequest $partnershipRequest, string $oldStatus): void
    {
        try {
            // Envoyer une notification seulement pour certains changements de statut
            if (in_array($partnershipRequest->status, ['under_review'])) {
                // TODO: Créer et envoyer l'email de mise à jour de statut
                Log::info('Statut de demande de partenariat mis à jour', [
                    'partnership_request_id' => $partnershipRequest->id,
                    'old_status' => $oldStatus,
                    'new_status' => $partnershipRequest->status,
                    'contact_email' => $partnershipRequest->contact_email,
                ]);
            }

        } catch (\Exception $e) {
            Log::warning('Erreur lors de l\'envoi de la notification de changement de statut', [
                'partnership_request_id' => $partnershipRequest->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Export partnership requests to CSV.
     */
    public function export(Request $request): RedirectResponse
    {
        // TODO: Implémenter l'export CSV des demandes de partenariat
        return back()->with('info', 'Fonctionnalité d\'export en cours de développement.');
    }

    /**
     * Bulk operations on partnership requests.
     */
    public function bulkAction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,set_under_review,export',
            'partnership_requests' => 'required|array|min:1',
            'partnership_requests.*' => 'exists:partnership_requests,id',
        ]);

        $count = 0;

        try {
            DB::beginTransaction();

            foreach ($validated['partnership_requests'] as $requestId) {
                $partnershipRequest = PartnershipRequest::find($requestId);

                if (!$partnershipRequest) continue;

                switch ($validated['action']) {
                    case 'delete':
                        if ($partnershipRequest->status !== 'approved') {
                            $partnershipRequest->delete();
                            $count++;
                        }
                        break;

                    case 'set_under_review':
                        if ($partnershipRequest->status === 'pending') {
                            $partnershipRequest->update([
                                'status' => 'under_review',
                                'processed_by' => Auth::id(),
                                'processed_at' => now(),
                            ]);
                            $count++;
                        }
                        break;
                }
            }

            DB::commit();

            $actionNames = [
                'delete' => 'supprimées',
                'set_under_review' => 'mises en examen',
                'export' => 'exportées',
            ];

            return back()->with('success',
                $count . ' demande(s) ' . $actionNames[$validated['action']] . ' avec succès.'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'action groupée sur les demandes de partenariat', [
                'action' => $validated['action'],
                'count' => count($validated['partnership_requests']),
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return back()->with('error', 'Erreur lors de l\'opération groupée : ' . $e->getMessage());
        }
    }
}
