<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnershipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->paginate(15);
        // Statistiques pour les demandes de partenariat
        $partnershipRequestsCount = PartnershipRequest::count();
        $pendingRequestsCount = PartnershipRequest::where('status', 'pending')->count();

        return view('admin.partners.index', compact(
            'partners',
            'partnershipRequestsCount',
            'pendingRequestsCount'
        ));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'type' => 'required|in:partner,donor,sponsor',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Partner::create($validated);

        return redirect()->route('admin.partners.index')
                        ->with('success', 'Partenaire créé avec succès.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'type' => 'required|in:partner,donor,sponsor',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $partner->update($validated);

        return redirect()->route('admin.partners.index')
                        ->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
                        ->with('success', 'Partenaire supprimé avec succès.');
    }

    
}
