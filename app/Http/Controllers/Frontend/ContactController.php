<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnershipRequestFormRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\PartnershipRequest;
use App\Models\Volunteer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Log;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = [
            'phones' => ['+237 696 740 438', '+237 698 288 072'],
            'office' => '+237 222 271 205',
            'email' => 'contact@act4communities.org',
            'address' => 'Garoua / Marouaré, Cameroun'
        ];

        return view('frontend.contact', compact('contactInfo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'type' => 'required|in:general,volunteer,partnership'
        ]);

        $contact = Contact::create($validated);

        // Envoyer un email de notification (optionnel)
        try {
            // Mail::to('contact@actforcommunities.org')->send(new ContactNotification($contact));
        } catch (\Exception $e) {
            // Log l'erreur mais ne pas faire échouer la requête
            \Log::error('Erreur envoi email contact: ' . $e->getMessage());
        }

        return redirect()->back()->with('success',
            'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    public function volunteer()
    {
        return view('frontend.volunteer');
    }
    public function storeVolunteer(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'skills' => 'nullable|string',
            'domains' => 'required|string|max:255',
            'availability' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $volunteer = Volunteer::create($validatedData);

        return redirect()->back()->with('success', 'Votre candidature a été envoyée avec succès!');
    }

    public function partnership()
    {
         $categories = Category::all();
        return view('frontend.partnership',compact('categories'));
    }

    /**
     * Traiter le formulaire de demande de partenariat
     */
    public function storePartnership(PartnershipRequestFormRequest $request): RedirectResponse
    {
        try {
            // Créer la demande de partenariat
            $partnershipRequest = PartnershipRequest::create([
                'org_name' => $request->org_name,
                'org_type' => $request->org_type,
                'website' => $request->website,
                'contact_name' => $request->name,
                'contact_position' => $request->position,
                'contact_email' => $request->email,
                'contact_phone' => $request->phone,
                'partnership_type' => $request->partnership_type,
                'description' => $request->message,
                'status' => 'pending',
            ]);

            // Associer les domaines d'intervention (catégories)
            if ($request->has('domains') && is_array($request->domains)) {
                $partnershipRequest->categories()->attach($request->domains);
            }

            // Envoyer les notifications email
            //$this->sendPartnershipNotifications($partnershipRequest);

            return back()->with('success',
                'Votre proposition de partenariat a été envoyée avec succès. ' .
                'Notre équipe l\'examinera et vous contactera dans les 5 jours ouvrables.'
            );

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de la demande de partenariat', [
                'error' => $e->getMessage(),
                'data' => $request->validated()
            ]);

            return back()->with('error',
                'Une erreur est survenue lors de l\'envoi de votre proposition. ' .
                'Veuillez réessayer ou nous contacter directement.'
            );
        }
    }
}
